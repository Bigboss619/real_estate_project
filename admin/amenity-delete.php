<?php require_once('top.php'); ?>

<?php
    $id = $_GET['id'];

    $statement = $conn->prepare("DELETE FROM amenities WHERE id=?");
    $statement->execute([$id]);

    $success_message = 'Amenity is deleted successfully';

    $_SESSION['success_message'] = $success_message;

    header('location: ' . ADMIN_URL . 'amenity-view.php');
    exit
?>

