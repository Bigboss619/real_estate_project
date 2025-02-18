<?php require_once('header.php');
 ?>
 <?php

use Money\Exchange;
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<?php
    if(isset($_POST['submit']))
    {
        try{
            if($_POST['email'] == '') {
            throw new Exception("Email can not be empty");
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is invalid");
            }
            $q = $conn->prepare("SELECT * FROM agents WHERE email=?");
            $q->execute([$_POST['email']]);
            $total = $q->rowCount();
            if(!$total) {
            throw new Exception("Email is not found");}
            $token = time();
            $statement = $conn->prepare("UPDATE agents SET token=? WHERE email=?");
            $statement->execute([$token,$_POST['email']]);
            $link = BASE_URL.'agent-reset-password.php?email='.$_POST['email'].'&token='.$token;
            $email_message = 'Please click on this link to reset your password: <br>';
            $email_message .= '<a href="'.$link.'">Reset Password</a>';
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
                $mail->Subject = 'Reset Password';
                $mail->Body = $email_message;
                $mail->send();
                $success_message = 'Please check your email and follow the steps.';
                } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
        }catch(Exception $e)
        {
            $error_message = $e->getMessage();
        }
    }  
?>
<div class="page-top" style="background-image: url('<?php echo BASE_URL; ?>uploads/settings/banner.jpg);">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Agent Forget Password</h2>
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
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website" name="submit">
                            Submit
                         </button>
                        <a href="<?php echo BASE_URL; ?>agent-login" class="primary-color">Back to Login Page</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
    <?php require_once('footer.php'); ?>