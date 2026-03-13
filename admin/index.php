<?php
session_start();

// Already logged in — go straight to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF: basic same-origin check (token added below)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Invalid request. Please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'Ac7#Zp3mQx9w') {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user']      = 'admin';
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

// Generate CSRF token for the form
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login &mdash; Arab Congress</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        :root {
            --ac-orange: #e07b30;
            --ac-gold:   #c8920a;
            --ac-dark:   #1a1a1a;
        }

        html, body {
            height: 100%;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .login-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 2.5rem 2.25rem 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .login-logo .site-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--ac-dark);
            letter-spacing: 0.5px;
        }

        .login-logo .site-sub {
            font-size: 0.8rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 2px;
        }

        .login-logo .logo-bar {
            height: 4px;
            width: 48px;
            background: linear-gradient(90deg, var(--ac-orange), var(--ac-gold));
            border-radius: 2px;
            margin: 0.6rem auto 0;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 8px;
            border: 1.5px solid #ddd;
            padding: 0.55rem 0.85rem;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--ac-orange);
            box-shadow: 0 0 0 3px rgba(224, 123, 48, 0.18);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--ac-orange) 0%, var(--ac-gold) 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.6rem;
            border-radius: 8px;
            letter-spacing: 0.3px;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-login:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            color: #fff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-danger {
            border-radius: 8px;
            font-size: 0.875rem;
            border-left: 4px solid #dc3545;
            background: #fff5f5;
            color: #842029;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <div class="site-name">Arab Congress</div>
            <div class="site-sub">Admin Panel</div>
            <div class="logo-bar"></div>
        </div>

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger py-2 mb-3" role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    autocomplete="username"
                    required
                    autofocus
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : '' ?>"
                >
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-login w-100">Sign In</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
