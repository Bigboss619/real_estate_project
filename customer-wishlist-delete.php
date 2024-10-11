<?php require_once('header.php'); ?>

<?php
    if(!isset($_SESSION['customer']))
    {
        header('location: ' . BASE_URL . 'customer-login');
        exit;
    }
  
?>

<?php
    $id = $_GET['id'];

    $statement = $conn->prepare("DELETE FROM wishlist WHERE id=?");
    $statement->execute([$id]);

    $success_message = 'Wishlist is deleted successfully';
    $_SESSION['success_message'] = $success_message;

    header('location: ' . BASE_URL . 'customer-wishlist');
    exit
?>

