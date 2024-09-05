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
   try {
             $id = $_GET['id'];

            // Checking if there is an active property under location already. 
            $statement = $conn->prepare("SELECT * FROM property WHERE type_id=?");
            $statement->execute([$_GET['id']]);
            $total = $statement->rowCount();
            if($total > 0)
            {
                throw new Exception("There are some properties under this types. So you can not delete this type");
            }

            $statement = $conn->prepare("DELETE FROM types WHERE id=?");
            $statement->execute([$id]);

            $success_message = 'Type is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'type-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'location-view.php');
        exit;
   }
?>

