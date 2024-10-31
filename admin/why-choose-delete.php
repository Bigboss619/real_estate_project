<?php

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

    $statement = $conn->prepare("DELETE FROM why_choose_items WHERE id=?");
    $statement->execute([$id]);

    $success_message = 'Why Choose Item is deleted successfully';

    $_SESSION['success_message'] = $success_message;

    header('location: ' . ADMIN_URL . 'why-choose-view.php');
    exit;
   
?>

