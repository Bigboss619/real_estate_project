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

            // Deleting the customer from the wishlist table
            $statement = $conn->prepare("DELETE FROM wishlist WHERE customer_id=?");
            $statement->execute([$id]);

            // Deleting the customer from the messages table
            $statement = $conn->prepare("DELETE FROM messages WHERE customer_id=?");
            $statement->execute([$id]);

            // Deleting the customer reply from the message reply table
            $statement = $conn->prepare("DELETE FROM message_reply WHERE customer_id=?");
            $statement->execute([$id]);

            $statement = $conn->prepare("SELECT FROM customer WHERE id=?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $photo = $row['photo'];
                if($photo != ''){
                    unlink('../uploads/customer-dp/'.$photo);
                }
            }

             // Deleting the customer reply from the message reply table
             $statement = $conn->prepare("DELETE FROM customer WHERE id=?");
             $statement->execute([$id]);


            $success_message = 'Customer is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'customer-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'customer-view.php');
        exit;
   };
?>

