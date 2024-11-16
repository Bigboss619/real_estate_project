<?php
ob_start();
session_start();
include_once('config/config.php');
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if($cur_page == 'agent-payment-section.php' || $cur_page == 'agent-paypal-success.php')
{
    require_once('config/config_paypal.php');
}
if($cur_page == 'agent-payment-section.php' || $cur_page == 'agent-stripe-success.php')
{
    require_once('config/config_stripe.php');
}
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// $cur_page = basename($_SERVER['REQUEST_URI']);

// Automatic Logout System
$sessionTimeout = 60 * 60; // 1 hour
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $sessionTimeout){
    unset($_SESSION['customer']);
    unset($_SESSION['agents']);
    session_unset();
    session_destroy();
    $_SESSION['error_message'] = 'Session Timeout. Please login.';
    header('Location: ' . BASE_URL.'select');
    exit;
}
// Update the last activity time
$_SESSION['last_activity'] = time();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="description" content="">
<title>The Home</title>

<link rel="icon" type="image/png" href="uploads/favicon.png">

<!-- All CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/animate.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/magnific-popup.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/select2.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/all.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/meanmenu.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/spacing.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/style.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist-front/css/iziToast.min.css">


<!-- All Javascripts -->
<script src="<?php echo BASE_URL; ?>dist-front/js/jquery-3.6.3.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/wow.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/select2.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/jquery.waypoints.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/moment.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/owl.carousel.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/jquery.meanmenu.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/tinymce/tinymce.min.js"></script>
<script src="<?php echo BASE_URL; ?>dist-front/js/iziToast.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="<?php echo BASE_URL; ?>" class="logo">
            <img src="<?php echo BASE_URL; ?>uploads/logo.png" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
                    <img src="<?php echo BASE_URL; ?>uploads/logo.png" alt="">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a href="<?php echo BASE_URL; ?>" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>properties.php?name=&location_id=&type_id=&amenity_id=&purpose=&bedroom=&bathroom=&price=&p=1" class="nav-link">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>agents/1" class="nav-link">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>locations" class="nav-link">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>pricing" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>faq" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>blogs" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>contact-us" class="nav-link">Contact</a>
                        </li>
                        <?php if(isset($_SESSION['customer'])): ?>
                            <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>customer-dashboard" class="nav-link">Dashboard</a>
                            </li>
                            <?php elseif(isset($_SESSION['agents'])): ?>
                            <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>agent-dashboard" class="nav-link">Dashboard</a>
                            </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>select" class="nav-link">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
