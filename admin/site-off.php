<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}
file_put_contents(__DIR__ . '/../maintenance.flag', '1');
header('Location: dashboard.php?site=off');
exit;
