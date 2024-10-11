<?php require_once('header.php'); ?>
<?php
    if(!isset($_SESSION['customer']))
    {
        header('location: '.BASE_URL.'customer-login');
        exit;
    }
    try {
        $statement = $conn->prepare("SELECT * FROM wishlist WHERE customer_id=? AND property_id=?");
        $statement->execute([$_SESSION['customer']['id'],$_GET['id']]);
        $total = $statement->rowCount();
        if($total){
            throw new Exception("Property is already added to your wishlis");
        }        
        $statement = $conn->prepare("INSERT INTO wishlist (customer_id, property_id) VALUES(?,?)");
        $statement->execute([$_SESSION['customer']['id'], $_GET['id']]);

        $_SESSION['success_message'] = 'Propery is added to your wishlists.';        
        header('location: ' . BASE_URL . 'customer-wishlist');
        exit;
        
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header('location: ' . BASE_URL . 'customer-wishlist');
        exit;
    }



?>
<?php require_once('footer.php'); ?>