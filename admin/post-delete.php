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
        
            // Delete the Photo
            $statement = $conn->prepare("SELECT * FROM posts WHERE id=?");
            $statement->execute([$_GET['id']]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            unlink('../uploads/blog/'.$result[0]['photo']);

            // Location Delete
            $statement = $conn->prepare("DELETE FROM posts WHERE id=?");
            $statement->execute([$id]);

            $success_message = 'Blog Post is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'post-view.php');
            exit;
 
    
?>

