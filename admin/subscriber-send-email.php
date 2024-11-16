<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<?php
    if(isset($_POST['form_submit']))
    {
        try {
                if($_POST['subject'] == "")
                {
                    throw new Exception("Subject cannot be empty" );
                }
                if($_POST['message'] == "")
                {
                    throw new Exception("Message cannot be empty" );
                }
                $email_message = $_POST['message'];
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
                    $mail->Subject = $_POST['subject'];
                    $mail->Body = nl2br($email_message);

                    $statement = $conn->prepare("SELECT * FROM subscribers WHERE status=?");
                    $statement->execute([1]);
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $mail2 = clone $mail;
                        $mail2->addAddress($row['email']);
                        $mail2->isHTML(true);
                        $mail2->send();
                    }
                    $success_message = 'Email is sent successfully';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $_SESSION['success_message'] = $success_message;

                header('location: ' . ADMIN_URL . 'subscriber-send-email.php');
                exit;

        } catch (Exception $e ) {
            $error_message = $e->getMessage();
        }
    }
    
?>
<div class="main-content">
<section class="section">
<div class="section-header justify-content-between">
<h1>Send Email to Subscribers</h1>
<div class="ml-auto">
<a href="<?php echo ADMIN_URL; ?>subscriber-view.php" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
</div>
</div>
<div class="section-body">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" value="<?php if(isset($_POST['subject'])) {echo $_POST['subject'];} ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="" class="form-label">Message</label>
                    <textarea class="form-control h_100" name="message" id="" rows="3"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="form_submit" class="btn btn-primary">Send Email</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
</div>
</section>
</div>
<?php require_once('footer.php'); ?>