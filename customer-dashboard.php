<?php
require_once('header.php');
?>
<?php
    if(!isset($_SESSION['customer']))
    {
        header('location: '.BASE_URL.'customer-login');
        exit;
    }
?>
<?php
    $statement = $conn->prepare("SELECT * FROM wishlist WHERE customer_id=?");
    $statement->execute([$_SESSION['customer']['id']]);
    $total_wishlist = $statement->rowCount();

    $statement = $conn->prepare("SELECT * FROM messages WHERE customer_id=?");
    $statement->execute([$_SESSION['customer']['id']]);
    $total_messages = $statement->rowCount();

?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/banner.jpg)">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content user-panel">
<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-12">
        <?php require_once('customer-sidebar.php'); ?>
    </div>
    <div class="col-lg-9 col-md-12">
        <h3 class="mb_20">Hello, <?php echo $_SESSION['customer']['fullname'] ?></h3>
       

        <div class="row box-items">
            <div class="col-md-4">
                <div class="box1">
                    <h4><?php echo $total_wishlist; ?></h4>
                    <p>Wishlist Items</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box2">
                    <h4><?php echo $total_messages; ?></h4>
                    <p>Messages</p>
                </div>
            </div>
           
        </div>

        <h3 class="mt-5">Recent Properties</h3>
        
    </div>
</div>
</div>
</div>
<?php
require_once('footer.php');
?>