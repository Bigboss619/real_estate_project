<?php require_once('header.php'); ?>

<!-- if a customer already logged in this code will allow him to login everytime -->
<?php
    if(isset($_SESSION['customer']))
    {
        header('location: '.BASE_URL.'customer-dashboard');
        exit;
    }
?>
<?php
    if(isset($_POST['form_submit']))
    {
        try {
                if($_POST['email'] == '') {
                throw new Exception("Email can not be empty");
                }
                if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email is invalid");
                }
                if($_POST['password'] == '') {
                throw new Exception("Password can not be empty");
                }
                
                $q = $conn->prepare("SELECT * FROM customer WHERE email=? AND status=?");
                $q->execute([$_POST['email'],1]);
                $total = $q->rowCount();
                if(!$total) {
                throw new Exception("Email is not found");
                }
                else {
                $result = $q->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                $password = $row['password'];
                if(!password_verify($_POST['password'], $password)) {
                throw new Exception("Password does not match");
                }
                }
                }
                // creating a section
                $_SESSION['customer'] = $row;
                header('location: '.BASE_URL.'customer-dashboard');
        } catch (Exception $th) {
                $error_message = $th->getMessage();
        }
    }
?>
<div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/settings/banner.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Customer Login</h2>
            </div>
        </div>
    </div>
</div>

    <div class="page-content">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
            <div class="login-form">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Email Address *</label>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary bg-website" name="form_submit">
                            Login
                        </button>
                        <a href="<?php echo BASE_URL; ?>customer-forget-password" class="primary-color">Forget Password? </a>
                    </div>
                    <div class="mb-3">
                        <a href="<?php echo BASE_URL; ?>customer-registration" class="primary-color">Don't have an account? Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
    <?php require_once('footer.php'); ?>