<?php require_once('top.php'); ?>
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

            // Checking if the order the admin want to do delete is active 
            $statement = $conn->prepare("SELECT * FROM orders WHERE id=? AND currently_active=?");
            $statement->execute([$id,1]);
            $total = $statement->rowCount();
            if($total)
            {
                throw new Exception("You cannot delete order that is currently active.");
            }

            $statement = $conn->prepare("DELETE FROM orders WHERE id=?");
            $statement->execute([$id]);

            $success_message = 'Order is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'order-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'order-view.php');
        exit;
   };
?>

