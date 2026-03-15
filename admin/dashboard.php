<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

require_once '../db_config.php';

// PDO connection
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die('<p style="color:red;font-family:monospace;padding:2rem;">Database connection failed.</p>');
}

// Fetch all bookings (gracefully handle older tables missing new columns)
try {
    $stmt = $pdo->query('SELECT * FROM bookings ORDER BY created_at DESC');
} catch (PDOException $e) {
    $stmt = $pdo->query('SELECT id, full_name, mobile, email, booking_date, destination, notes, created_at, NULL AS type, NULL AS selected_tours FROM bookings ORDER BY created_at DESC');
}
$bookings = $stmt->fetchAll();
$total    = count($bookings);

$deleted    = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$siteToggle = $_GET['site'] ?? null;
$siteOnline = !file_exists(__DIR__ . '/../maintenance.flag');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; Arab Congress Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        :root {
            --ac-orange: #e07b30;
            --ac-gold:   #c8920a;
        }

        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* ---- Navbar ---- */
        .ac-navbar {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            padding: 0.75rem 1.5rem;
        }

        .ac-navbar .brand {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.4px;
        }

        .ac-navbar .brand span {
            color: var(--ac-orange);
        }

        .ac-navbar .nav-link-logout {
            color: #ccc;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .ac-navbar .nav-link-logout:hover {
            color: var(--ac-orange);
        }

        /* ---- Stat card ---- */
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--ac-orange), var(--ac-gold));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 26px;
            height: 26px;
            fill: #fff;
        }

        .stat-label {
            font-size: 0.78rem;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.1;
        }

        /* ---- Table card ---- */
        .table-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .table-card .card-header-custom {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 0.95rem;
        }

        .table thead th {
            background: #f8f9fa;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #555;
            border-bottom: 2px solid #eee;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background: #fff9f4;
        }

        .table td {
            font-size: 0.875rem;
            vertical-align: middle;
            color: #333;
        }

        /* ---- Buttons ---- */
        .btn-view {
            background: linear-gradient(135deg, var(--ac-orange), var(--ac-gold));
            color: #fff;
            border: none;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            transition: opacity 0.2s;
        }

        .btn-view:hover {
            opacity: 0.88;
            color: #fff;
        }

        .btn-delete {
            background: transparent;
            color: #dc3545;
            border: 1.5px solid #dc3545;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }

        .btn-delete:hover {
            background: #dc3545;
            color: #fff;
        }

        /* ---- Modal ---- */
        .modal-header {
            background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
            color: #fff;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1rem;
        }

        .detail-row {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.65rem;
            font-size: 0.875rem;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            min-width: 110px;
            flex-shrink: 0;
        }

        .detail-value {
            color: #1a1a1a;
            word-break: break-word;
        }

        .detail-divider {
            height: 1px;
            background: #eee;
            margin: 0.75rem 0;
        }

        /* ---- Misc ---- */
        .badge-id {
            background: #f0f0f0;
            color: #555;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }

        /* ---- Booking type badges ---- */
        .badge-type {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.22rem 0.6rem;
            border-radius: 20px;
            white-space: nowrap;
            letter-spacing: 0.3px;
        }
        .badge-type-spouses {
            background: #fff3e0;
            color: #e07b30;
            border: 1px solid #e07b30;
        }
        .badge-type-conference {
            background: #1a1a1a;
            color: #e07b30;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="ac-navbar d-flex align-items-center justify-content-between">
    <div class="brand">Arab <span>Congress</span> &mdash; Admin</div>
    <div class="d-flex align-items-center gap-3">
        <?php if ($siteOnline): ?>
            <a href="site-off.php" class="nav-link-logout" style="color:#f87171;" onclick="return confirm('Take the website offline?')">&#9632; Take Offline</a>
        <?php else: ?>
            <a href="site-on.php" class="nav-link-logout" style="color:#4ade80;">&#9654; Bring Online</a>
        <?php endif; ?>
    <a href="logout.php" class="nav-link-logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-right:4px;vertical-align:-1px">
            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg>
        Logout
    </a>
    </div>
</nav>

<div class="container-fluid px-4 py-4">

    <!-- Success toast -->
    <?php if ($deleted): ?>
        <div class="alert alert-success alert-dismissible fade show py-2 mb-3" role="alert" style="font-size:0.875rem;border-radius:8px;border-left:4px solid #198754;">
            Booking deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($siteToggle === 'off'): ?>
        <div class="alert alert-warning alert-dismissible fade show py-2 mb-3" role="alert" style="font-size:0.875rem;border-radius:8px;border-left:4px solid #f59e0b;">
            Website is now <strong>offline</strong>. Visitors see the maintenance page.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($siteToggle === 'on'): ?>
        <div class="alert alert-success alert-dismissible fade show py-2 mb-3" role="alert" style="font-size:0.875rem;border-radius:8px;border-left:4px solid #198754;">
            Website is <strong>online</strong> again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Stat cards row -->
    <div class="row mb-4 g-3">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Calendar icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">Total Bookings</div>
                    <div class="stat-value"><?= $total ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings table -->
    <div class="table-card">
        <div class="card-header-custom">
            All Bookings
            <span class="text-muted fw-normal" style="font-size:0.8rem;margin-left:8px;"><?= $total ?> record<?= $total !== 1 ? 's' : '' ?></span>
        </div>

        <?php if ($total === 0): ?>
            <div class="text-center text-muted py-5" style="font-size:0.9rem;">No bookings found.</div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#ID</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Destination</th>
                        <th>Type</th>
                        <th>Booking Date</th>
                        <th>Submitted At</th>
                        <th class="pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $b): ?>
                    <?php
                        $id             = (int) $b['id'];
                        $fullName       = htmlspecialchars($b['full_name'],       ENT_QUOTES, 'UTF-8');
                        $mobile         = htmlspecialchars($b['mobile'],          ENT_QUOTES, 'UTF-8');
                        $email          = htmlspecialchars($b['email'],           ENT_QUOTES, 'UTF-8');
                        $destination    = htmlspecialchars($b['destination'],     ENT_QUOTES, 'UTF-8');
                        $bookDate       = htmlspecialchars($b['booking_date'],    ENT_QUOTES, 'UTF-8');
                        $notes          = htmlspecialchars($b['notes'] ?? '',     ENT_QUOTES, 'UTF-8');
                        $createdAt      = htmlspecialchars($b['created_at'],      ENT_QUOTES, 'UTF-8');
                        $bookingType    = $b['type'] ?? 'ordinary';
                        $selectedTours  = htmlspecialchars($b['selected_tours'] ?? '', ENT_QUOTES, 'UTF-8');

                        // Type badge HTML
                        if ($bookingType === 'spouses_program') {
                            $typeBadge = '<span class="badge-type badge-type-spouses">Spouses</span>';
                        } elseif ($bookingType === 'conference_tour') {
                            $typeBadge = '<span class="badge-type badge-type-conference">Conference</span>';
                        } else {
                            $typeBadge = '';
                        }
                    ?>
                    <tr>
                        <td class="ps-3"><span class="badge-id"><?= $id ?></span></td>
                        <td><?= $fullName ?></td>
                        <td><?= $mobile ?></td>
                        <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= $email ?></td>
                        <td><?= $destination ?></td>
                        <td><?= $typeBadge ?></td>
                        <td><?= $bookDate ?></td>
                        <td style="white-space:nowrap;"><?= $createdAt ?></td>
                        <td class="pe-3">
                            <div class="d-flex gap-1 flex-nowrap">
                                <!-- View button: data attributes carry all booking details -->
                                <button
                                    type="button"
                                    class="btn-view btn-open-modal"
                                    data-id="<?= $id ?>"
                                    data-fullname="<?= $fullName ?>"
                                    data-mobile="<?= $mobile ?>"
                                    data-email="<?= $email ?>"
                                    data-destination="<?= $destination ?>"
                                    data-bookdate="<?= $bookDate ?>"
                                    data-notes="<?= $notes ?>"
                                    data-createdat="<?= $createdAt ?>"
                                    data-type="<?= htmlspecialchars($bookingType, ENT_QUOTES, 'UTF-8') ?>"
                                    data-selectedtours="<?= $selectedTours ?>"
                                >
                                    View
                                </button>

                                <!-- Delete form -->
                                <form method="POST" action="delete.php" class="d-inline" onsubmit="return confirmDelete(event)">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Booking Detail Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:10px;overflow:hidden;border:none;box-shadow:0 10px 40px rgba(0,0,0,0.2);">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Booking Details &mdash; <span id="modal-id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="detail-row">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value" id="modal-fullname"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Mobile</span>
                    <span class="detail-value" id="modal-mobile"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value" id="modal-email"></span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-row">
                    <span class="detail-label">Destination</span>
                    <span class="detail-value" id="modal-destination"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Type</span>
                    <span class="detail-value" id="modal-type"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Booking Date</span>
                    <span class="detail-value" id="modal-bookdate"></span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-row" id="modal-tours-row" style="display:none;">
                    <span class="detail-label">Selected Tours</span>
                    <span class="detail-value" id="modal-selectedtours" style="white-space:pre-line;"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Notes</span>
                    <span class="detail-value" id="modal-notes" style="font-style:italic;color:#666;"></span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-row">
                    <span class="detail-label">Submitted At</span>
                    <span class="detail-value" id="modal-createdat" style="color:#888;font-size:0.82rem;"></span>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid #eee;">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';

    const modal      = new bootstrap.Modal(document.getElementById('bookingModal'));
    const viewBtns   = document.querySelectorAll('.btn-open-modal');

    const typeLabels = {
        'ordinary':        'Regular Tour',
        'spouses_program': 'Spouses & Partners Program',
        'conference_tour': 'Conference Tour (Oct. 9)',
    };

    viewBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('modal-id').textContent          = '#' + btn.dataset.id;
            document.getElementById('modal-fullname').textContent    = btn.dataset.fullname;
            document.getElementById('modal-mobile').textContent      = btn.dataset.mobile;
            document.getElementById('modal-email').textContent       = btn.dataset.email;
            document.getElementById('modal-destination').textContent = btn.dataset.destination;
            document.getElementById('modal-bookdate').textContent    = btn.dataset.bookdate;
            document.getElementById('modal-notes').textContent       = btn.dataset.notes || '—';
            document.getElementById('modal-createdat').textContent   = btn.dataset.createdat;

            // Type field
            var bType = btn.dataset.type || 'ordinary';
            document.getElementById('modal-type').textContent = typeLabels[bType] || bType;

            // Selected tours (spouses program)
            var toursRow = document.getElementById('modal-tours-row');
            var toursVal = btn.dataset.selectedtours || '';
            if (toursVal) {
                document.getElementById('modal-selectedtours').textContent = toursVal.replace(/ \| /g, '\n');
                toursRow.style.display = 'flex';
            } else {
                toursRow.style.display = 'none';
            }

            modal.show();
        });
    });
})();

function confirmDelete(e) {
    if (!confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
        e.preventDefault();
        return false;
    }
    return true;
}
</script>
</body>
</html>
