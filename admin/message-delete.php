<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>

<?php
    $id = $_GET['id'];

    $statement = $conn->prepare("DELETE FROM messages WHERE id=?");
    $statement->execute([$id]);

    $statement = $conn->prepare("DELETE FROM message_replies WHERE message_id=?");
    $statement->execute([$id]);

    $success_message = 'Message is deleted successfully';
    $_SESSION['success_message'] = $success_message;

    header('location: ' . ADMIN_URL . 'message-view.php');
    exit
?>

