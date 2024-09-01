<?php
    include_once "header.php";
    unset($_SESSION['admin']);
    header('location: '.ADMIN_URL.'login.php');
    exit;
?>