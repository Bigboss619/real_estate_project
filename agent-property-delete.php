<?php require_once('header.php'); ?>

<?php
    if(!isset($_SESSION['agents']))
    {
        header('location: ' . BASE_URL . 'agent-login');
        exit;
    }
    // This make sure agent only edit his post and not another agent post
    $id = $_GET['id'];
    $statement = $conn->prepare("SELECT * FROM property WHERE id=? AND agent_id=?");
    $statement->execute([$id,$_SESSION['agent']['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $total = $statement->rowCount();
    if(!$total)
    {
      header('location: ' . BASE_URL. 'agent-login');
      exit;
    }
?>

<?php
    $id = $_GET['id'];

   $statement = $conn->prepare("SELECT * FROM property WHERE id=?");
   $statement->execute([$id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    unlink('uploads/property/'.$result[0]['photo']);

    $statement = $conn->prepare("DELETE FROM property WHERE id=?");
    $statement->execute([$id]);

    $statement = $conn->prepare("SELECT * FROM property_photo WHERE property_id=?");
     $statement->execute([$id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($variable as $row) {
        unlink('uploads/property/'.$row['photo']);   
    }

    $statement = $conn->prepare("DELETE FROM property_photo WHERE property_id=?");
    $statement->execute([$id]);

    $statement = $conn->prepare("DELETE FROM property_video WHERE property_id=?");
    $statement->execute([$id]);

    $success_message = 'Package is deleted successfully';
    $_SESSION['success_message'] = $success_message;

    header('location: ' . BASE_URL . 'agent-property');
    exit
?>

