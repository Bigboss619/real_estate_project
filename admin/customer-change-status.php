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
   $statement = $conn->prepare("SELECT * FROM customer WHERE id=?");
   $statement->execute([$id]);
   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
   foreach($result as $row){
    $status = $row['status'];
   }
   if($status == 1)
   {
    $statement = $conn->prepare("UPDATE customer SET status=? WHERE id=?");
    $statement->execute([0, $id]);
    header('location: ' . ADMIN_URL . 'customer-view.php');
   }
   else
   {
        $statement = $conn->prepare("UPDATE customer SET status=? WHERE id=?");
        $statement->execute([1, $id]);
        header('location: ' . ADMIN_URL . 'customer-view.php');
   }

?>

