<?php

use Money\Exchange;

 require_once('top.php'); ?>
   <?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>

<?php
        $id = $_GET['id'];

        $statement = $conn->prepare("DELETE FROM faqs WHERE id=?");
        $statement->execute([$id]);

        $success_message = 'FAQ is deleted successfully';

        $_SESSION['success_message'] = $success_message;

        header('location: ' . ADMIN_URL . 'faq-view.php');
        exit;
  
?>

