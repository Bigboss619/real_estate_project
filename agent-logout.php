<?php
    require_once ("header.php");
    unset($_SESSION['agents']);
    $_SESSION['success_message'] = 'You are logged out successfully';
    header('location: '.BASE_URL.'agent-login');
    exit;
?>