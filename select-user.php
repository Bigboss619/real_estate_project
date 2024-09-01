<?php require_once('header.php'); ?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner-home.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>User Selection</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

            <div class="main-part-users" style="text-align:center; width:100%; margin-bottom:50px; margin-top:40px;">
                <div class="left-part-users" style="width: 400px;display:inline-block; background: #000; padding:30px; margin:0 20px;">
                    <h3 style="font-size: 20px;">
                        <a style="color: #2657ab; text-decoration:underline;" href="<?php echo BASE_URL; ?>customer-registration">Customer Registration</h3>
                    <h3 style="font-size: 20px;">
                        <a style="color: #2657ab; text-decoration:underline;"  href="<?php echo BASE_URL; ?>customer-login">Customer Login</h3>
                </div>
                <div class="right-part-users" style="width: 400px;display:inline-block;background: #c1ffd9; padding:30px; margin:0 20px;">
                    <h3 style="font-size: 20px;"><a style="color: #1e8130; text-decoration:underline;" href="<?php echo BASE_URL; ?>agent-registration">Agent Registration</h3>
                    <h3 style="font-size: 20px;"><a style="color: #1e8130; text-decoration:underline;" href="<?php echo BASE_URL; ?>agent-login">Agent Login</h3>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>