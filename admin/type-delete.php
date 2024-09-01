<?php require_once('top.php'); ?>

<?php
    $id = $_GET['id'];

    $statement = $conn->prepare("DELETE FROM types WHERE id=?");
    $statement->execute([$id]);

    $success_message = 'Type is deleted successfully';

    $_SESSION['success_message'] = $success_message;

    header('location: ' . ADMIN_URL . 'type-view.php');
    exit
?>

