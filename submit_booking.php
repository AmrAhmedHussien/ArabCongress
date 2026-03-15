<?php
/* Submit Booking – Arab Congress: saves to DB and sends email notification */

require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/mailer.php';

header('Content-Type: application/json; charset=utf-8');

/* --- Allow only POST --- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

/* --- Sanitize input --- */
$full_name      = isset($_POST['full_name'])   ? trim(strip_tags($_POST['full_name']))   : '';
$mobile         = isset($_POST['mobile'])      ? trim(strip_tags($_POST['mobile']))      : '';
$email          = isset($_POST['email'])       ? trim($_POST['email'])                   : '';
$date           = isset($_POST['date'])        ? trim($_POST['date'])                    : '';
$notes          = isset($_POST['notes'])       ? trim(strip_tags($_POST['notes']))       : '';
$destination    = isset($_POST['destination']) ? trim(strip_tags($_POST['destination'])) : 'Cairo';
$type           = isset($_POST['type'])        ? trim(strip_tags($_POST['type']))        : 'ordinary';

/* selected_tours is an array for spouses_program */
$selected_tours_arr = [];
if (isset($_POST['selected_tours']) && is_array($_POST['selected_tours'])) {
    foreach ($_POST['selected_tours'] as $t) {
        $selected_tours_arr[] = trim(strip_tags($t));
    }
}
$selected_tours = !empty($selected_tours_arr) ? implode(' | ', $selected_tours_arr) : '';

/* --- Date: use today if empty --- */
if (empty($date)) {
    $date = date('Y-m-d');
}

/* --- Validate required fields --- */
if (empty($full_name) || empty($mobile) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    echo json_encode(['success' => false, 'message' => 'Invalid date format.']);
    exit;
}

/* --- Allowed type values --- */
$allowed_types = ['ordinary', 'spouses_program', 'conference_tour'];
if (!in_array($type, $allowed_types, true)) {
    $type = 'ordinary';
}

/* --- Database connection --- */
$booking_id = 0;

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    /* Create table with all columns from the start */
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS bookings (
            id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            full_name       VARCHAR(255)  NOT NULL,
            mobile          VARCHAR(60)   NOT NULL,
            email           VARCHAR(255)  NOT NULL,
            booking_date    DATE          NOT NULL,
            destination     VARCHAR(100)  NOT NULL DEFAULT 'Cairo',
            notes           TEXT,
            type            VARCHAR(30)   NOT NULL DEFAULT 'ordinary',
            selected_tours  TEXT,
            created_at      TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    /* Silently add new columns for existing tables that lack them */
    try { $pdo->exec("ALTER TABLE bookings ADD COLUMN type VARCHAR(30) NOT NULL DEFAULT 'ordinary'"); } catch (PDOException $e) {}
    try { $pdo->exec("ALTER TABLE bookings ADD COLUMN selected_tours TEXT"); } catch (PDOException $e) {}

    /* --- Duplicate check for conference_tour --- */
    if ($type === 'conference_tour') {
        $dupCheck = $pdo->prepare(
            "SELECT id FROM bookings WHERE email = ? AND type = 'conference_tour' LIMIT 1"
        );
        $dupCheck->execute([$email]);
        if ($dupCheck->fetch()) {
            echo json_encode([
                'success' => false,
                'message' => 'This email has already been registered for the Conference Tour.',
            ]);
            exit;
        }
    }

    /* --- Insert record --- */
    $stmt = $pdo->prepare(
        "INSERT INTO bookings (full_name, mobile, email, booking_date, destination, notes, type, selected_tours)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$full_name, $mobile, $email, $date, $destination, $notes, $type, $selected_tours ?: null]);
    $booking_id = (int) $pdo->lastInsertId();

} catch (PDOException $e) {
    error_log('[Arab Congress] DB Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Unable to save your booking. Please try again or contact us directly.']);
    exit;
}

/* --- Build notification email --- */
$formatted_date  = date('l, F j, Y', strtotime($date));
$e_name          = htmlspecialchars($full_name,     ENT_QUOTES, 'UTF-8');
$e_mobile        = htmlspecialchars($mobile,        ENT_QUOTES, 'UTF-8');
$e_email         = htmlspecialchars($email,         ENT_QUOTES, 'UTF-8');
$e_destination   = htmlspecialchars($destination,   ENT_QUOTES, 'UTF-8');
$e_date          = htmlspecialchars($formatted_date, ENT_QUOTES, 'UTF-8');
$e_notes         = !empty($notes)
    ? nl2br(htmlspecialchars($notes, ENT_QUOTES, 'UTF-8'))
    : '<em style="color:#bbb">None</em>';

/* Type label for email */
$type_labels = [
    'ordinary'         => 'Regular Tour',
    'spouses_program'  => 'Spouses &amp; Partners Program',
    'conference_tour'  => 'Conference Tour (Oct. 9)',
];
$e_type = $type_labels[$type] ?? htmlspecialchars($type, ENT_QUOTES, 'UTF-8');

/* Subject line */
if ($type === 'spouses_program') {
    $subject = "New Registration #{$booking_id} \xe2\x80\x93 Spouses & Partners Program";
} elseif ($type === 'conference_tour') {
    $subject = "New Booking #{$booking_id} \xe2\x80\x93 Conference Tour – {$destination}";
} else {
    $subject = "New Booking #{$booking_id} \xe2\x80\x93 {$destination} Tour";
}

/* Selected tours row (only relevant for spouses_program) */
$tours_row = '';
if ($type === 'spouses_program' && !empty($selected_tours)) {
    $e_tours = htmlspecialchars($selected_tours, ENT_QUOTES, 'UTF-8');
    $tours_row = '
    <div class="field"><div class="lbl">Selected Tours</div><div class="val">' . nl2br(str_replace(' | ', '<br>', $e_tours)) . '</div></div>';
}

$html = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8">
<style>
body{font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px}
.wrap{max-width:600px;margin:0 auto;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.1)}
.hdr{background:linear-gradient(135deg,#e07b30,#c8920a);padding:32px 30px;text-align:center;color:#fff}
.hdr h1{margin:0;font-size:22px;letter-spacing:1px}
.hdr p{margin:8px 0 0;font-size:14px;opacity:.85}
.body{padding:30px 30px 10px}
.field{margin-bottom:18px;border-bottom:1px solid #f0e0cc;padding-bottom:14px}
.lbl{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px}
.val{font-size:16px;color:#333}
.badge{display:inline-block;background:#c8920a;color:#fff;padding:4px 14px;border-radius:20px;font-size:13px;font-weight:700}
.badge-type{display:inline-block;background:#1a0a00;color:#e07b30;padding:4px 14px;border-radius:20px;font-size:13px;font-weight:700}
.ftr{background:#fdf5e6;padding:18px 30px;text-align:center;color:#999;font-size:12px;border-top:1px solid #ecdcc8}
.ftr a{color:#c8920a}
</style>
</head>
<body>
<div class="wrap">
  <div class="hdr">
    <h1>Come To Egypt &ndash; New Booking</h1>
    <p>A new booking request has been submitted</p>
  </div>
  <div class="body">
    <div class="field"><div class="lbl">Booking ID</div><div class="val"><span class="badge">#' . $booking_id . '</span></div></div>
    <div class="field"><div class="lbl">Booking Type</div><div class="val"><span class="badge-type">' . $e_type . '</span></div></div>
    <div class="field"><div class="lbl">Destination</div><div class="val">' . $e_destination . '</div></div>
    <div class="field"><div class="lbl">Full Name</div><div class="val">' . $e_name . '</div></div>
    <div class="field"><div class="lbl">Mobile Number</div><div class="val">' . $e_mobile . '</div></div>
    <div class="field"><div class="lbl">Email Address</div><div class="val">' . $e_email . '</div></div>
    <div class="field"><div class="lbl">Date</div><div class="val">' . $e_date . '</div></div>'
    . $tours_row . '
    <div class="field" style="border:none"><div class="lbl">Notes / Special Requests</div><div class="val">' . $e_notes . '</div></div>
  </div>
  <div class="ftr">
    Arab Congress for Conference &amp; Exhibition Organization<br>
    <a href="mailto:arabcongress.co@gmail.com">arabcongress.co@gmail.com</a> &nbsp;|&nbsp;
    <a href="https://wa.me/message/56PURZNDQBU6N1">WhatsApp</a>
  </div>
</div>
</body></html>';

/* --- Send via SMTP --- */
try {
    $mailer = new SimpleSMTP(
        SMTP_HOST,
        SMTP_PORT,
        SMTP_USER,
        SMTP_PASS,
        SMTP_FROM,
        SMTP_FROM_NAME
    );
    $mailer->send(NOTIFY_EMAIL, $subject, $html);
} catch (RuntimeException $e) {
    error_log('[Arab Congress] SMTP error: ' . $e->getMessage());
}

/* --- Success response --- */
if ($type === 'spouses_program') {
    $success_msg = "Thank you, {$full_name}! Your registration (#" . $booking_id . ") for the Spouses & Partners Program has been received. We will contact you shortly.";
} elseif ($type === 'conference_tour') {
    $success_msg = "Thank you, {$full_name}! Your Conference Tour booking (#" . $booking_id . ") for {$destination} on October 9th has been received. We will contact you shortly.";
} else {
    $success_msg = "Thank you, {$full_name}! Your booking (#" . $booking_id . ") has been received. We will contact you shortly to confirm your {$destination} tour.";
}

echo json_encode([
    'success'    => true,
    'message'    => $success_msg,
    'booking_id' => $booking_id,
]);
