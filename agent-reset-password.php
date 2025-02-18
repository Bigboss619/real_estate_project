<?php require_once('header.php'); ?>

<?php
    $statement = $conn->prepare("SELECT * FROM agents WHERE email=? AND token=?");
    $statement->execute([$_REQUEST['email'],$_REQUEST['token']]);
    $total = $statement->rowCount();
    if(!$total) {
        header('location: '.BASE_URL.'agent-login');
        exit;
    }
    
?>
<?php
    if(isset($_POST['form_reset_password']))
    {
        try {
                if($_POST['password'] == '' || $_POST['retype_password'] == '') {
                throw new Exception("Password can not be empty");}
                if($_POST['password'] != $_POST['retype_password']) {
                throw new Exception("Passwords does not match");}
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $statement = $conn->prepare("UPDATE agents SET token=?, password=? WHERE email=? AND token=?");
                $statement->execute(['',$password, $_REQUEST['email'],$_REQUEST['token']]);
                $_SESSION['success_message'] = 'Password is reset successfully. You can login';
                header('location: '.BASE_URL.'agent-login?msg=success');
                exit;
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
?>

<section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box">
                            <div class="card-header card-header-auth">
                                <h4 class="text-center">Agent Reset Password</h4>
                            </div>
                            <div class="card-body card-body-auth">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password" value="" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="retype_password" placeholder="Retype Password" value="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="form_reset_password"     class="btn btn-primary btn-lg w_100_p">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once('footer.php'); ?>