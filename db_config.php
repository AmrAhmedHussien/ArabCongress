<?php
/* ============================================================
   Configuration – Arab Congress Bookings

   ACCESS: open via http://localhost/arab-congress/  (not file://)
   ============================================================ */

/* ---- Database (match your phpMyAdmin setup) ---- */
define('DB_HOST',    'localhost');
define('DB_NAME',    'arabcongress_db');   // DB name you created in phpMyAdmin
define('DB_USER',    'root');              // XAMPP default
define('DB_PASS',    '');                  // XAMPP default (empty)
define('DB_CHARSET', 'utf8mb4');

/* ---- Notification email ---- */
define('NOTIFY_EMAIL', 'AmrAhmedHussien@outlook.com');

/* ---- SMTP settings (used instead of mail() so no mail server needed) ----
 *
 *  OPTION A – Gmail  (recommended)
 *    1. Go to myaccount.google.com → Security → 2-Step Verification → enable it
 *    2. Then: Security → App Passwords → generate one for "Mail / Other"
 *    3. Copy the 16-character password below (no spaces)
 *
 *    define('SMTP_HOST', 'smtp.gmail.com');
 *    define('SMTP_PORT', 587);
 *    define('SMTP_USER', 'yourgmail@gmail.com');
 *    define('SMTP_PASS', 'xxxx xxxx xxxx xxxx');   // app password
 *    define('SMTP_FROM', 'yourgmail@gmail.com');
 *
 *  OPTION B – Outlook / Hotmail
 *    define('SMTP_HOST', 'smtp-mail.outlook.com');
 *    define('SMTP_PORT', 587);
 *    define('SMTP_USER', 'yourmail@outlook.com');
 *    define('SMTP_PASS', 'your-outlook-password');
 *    define('SMTP_FROM', 'yourmail@outlook.com');
 *
 * ---------------------------------------------------------------- */
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'moroa7md@gmail.com');       // ← change this
define('SMTP_PASS', 'ihju wgdj jivl brrq');        // ← change this (Gmail App Password)
define('SMTP_FROM', 'noreply@arabCongress.com');        // ← change this
define('SMTP_FROM_NAME', 'Come To Egypt Website');
