<?php
 require_once('header.php'); ?>
 <?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 ?>
<?php
    if(isset($_POST['form_submit']))
    {
        try {
            if($_POST['fullname'] == '') {
                throw new Exception("Fullname can not be empty");
            }
            if($_POST['email'] == '') {
                throw new Exception("Email can not be empty");
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email is invalid");
            }
            $statement = $conn->prepare("SELECT * FROM agents WHERE email=?");
            $statement->execute([$_POST['email']]);
            $total = $statement->rowCount();
            if($total > 0) {
                throw new Exception("Email already exists");
            }
            if($_POST['password'] == '' || $_POST['retype_password'] == '') {
                throw new Exception("Password can not be empty");
            }
            if($_POST['password'] != $_POST['retype_password'])
            {
                throw new Exception("Password does not match");
            }
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                $token = time();


            $link = BASE_URL.'agent-registration-verify.php?email='.$_POST['email'].'&token='.$token;
            $email_message = 'Please click on this link to verify registration: <br>';
            $email_message .= '<a href="'.$link.'">Click Here</a>';

            $statement = $conn->prepare("INSERT INTO agents (fullname,email,photo,password,token,status) VALUES(?,?,?,?,?,?)");
            $statement->execute([$_POST['fullname'], $_POST['email'],'',$password, $token,0]);

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_ENCRYPTION;
                $mail->Port = SMTP_PORT;
                $mail->setFrom(SMTP_FROM);
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = 'Registration Verification Email';
                $mail->Body = $email_message;
                $mail->send();
                $success_message = 'Registration is completed. An email is sent to your email address. Please check that and verify the registration.';

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            $success_message = "Registration is successful. Check your email and verify registration to login";

            // Use this when you add value to the input field;
            unset($_POST['fullname']);
            unset($_POST['email']);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
?>

<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/banner.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Agent Registration</h2>
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
                        <label for="" class="form-label">Full Name *</label>
                        <input type="text" name="fullname" class="form-control" value="<?php if(isset($_POST['fullname'])) {echo $_POST['fullname'];} ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email Address *</label>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password *</label>
                        <input type="password" name="retype_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary bg-website" name="form_submit">
                            Create Account
                        </button>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="<?php echo  BASE_URL; ?>agent-login" class="primary-color">Existing User? Login Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <?php require_once('footer.php'); ?>