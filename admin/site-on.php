<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}
$flag = __DIR__ . '/../maintenance.flag';
if (file_exists($flag)) {
    unlink($flag);
}
header('Location: dashboard.php?site=on');
exit;
