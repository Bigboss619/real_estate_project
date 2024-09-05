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

            // Checking if there is an active property under location already. 
            $statement = $conn->prepare("SELECT * FROM property WHERE FIND_IN_SET(?, amenities)>0");
            $statement->execute([$_GET['id']]);
            $total = $statement->rowCount();
            if($total > 0)
            {
                throw new Exception("Amenity is used in properties. So, it can not be deleted.");
            }

            $statement = $conn->prepare("DELETE FROM amenities WHERE id=?");
            $statement->execute([$id]);

            $success_message = 'Amenity is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'amenity-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'amenity-view.php');
        exit;
   };
?>

