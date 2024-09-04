<?php require_once('top.php'); ?>

<?php
   

   try {
        $id = $_GET['id'];
        // Checking if there is an active property under location already. 
            $statement = $conn->prepare("SELECT * FROM property WHERE location_id=?");
            $statement->execute([$_GET['id']]);
            $total = $statement->rowCount();
            if($total > 0)
            {
                throw new Exception("There are some properties under this locations. So you can not delete this location");
            }
            // Delete the Photo
            $statement = $conn->prepare("SELECT * FROM locations WHERE id=?");
            $statement->execute([$_GET['id']]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            unlink('../uploads/'.$result[0]['photo']);

            // Location Delete
            $statement = $conn->prepare("DELETE FROM locations WHERE id=?");
            $statement->execute([$id]);

            $success_message = 'Location is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'location-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'location-view.php');
        exit;
   }

    
?>

