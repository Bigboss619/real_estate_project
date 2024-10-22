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

    $statement = $conn->prepare("SELECT * FROM WHERE id=? AND customer_id=?");
    $statement->bind_param($id, $_SESSION['customer']['id']);
    $total = $statement->rowCount();
    if(!$total)
    {
        header('location: ' . BASE_URL . 'customer-login');
        exit;
    }

    $statement = $conn->prepare("DELETE FROM messages WHERE id=? AND customer_id=?");
    $statement->execute([$id],$_SESSION['customer']['id']);

    $statement = $conn->prepare("DELETE FROM message_replies WHERE message_id=? AND customer_id=?");
    $statement->execute([$id],$_SESSION['customer']['id']);

    $success_message = 'Message is deleted successfully';
    $_SESSION['success_message'] = $success_message;

    header('location: ' . BASE_URL . 'customer-messages');
    exit
?>

