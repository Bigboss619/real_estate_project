<?php include_once('../config/config.php'); ?>
<?php
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
// Automatic Logout System
$sessionTimeout = 60 * 60; // 1 minute
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $sessionTimeout){
    session_unset();
    session_destroy();
    header('Location: ' .ADMIN_URL.'login.php');
    exit;
}
// Update the last activity time
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>dist/images/favicon.png">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/font_awesome_5_free.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/duotone-dark.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/iziToast.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/bootstrap4-toggle.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/air-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/spacing.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/custom.css">

    <script src="<?php echo BASE_URL; ?>dist/js/jquery-3.7.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/tooltip.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/jquery.nicescroll.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/moment.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/stisla.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/jscolor.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/select2.full.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/iziToast.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/fontawesome-iconpicker.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/air-datepicker.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/tinymce/tinymce.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/bootstrap4-toggle.min.js"></script>
</head>

<body>
<div id="app">
    <div class="main-wrapper">