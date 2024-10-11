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
   if(isset($_POST['form_submit'])){
    try {
    if($_POST['fsubject'] == '') {
    throw new Exception("Subject can not be empty");
    }
    if($_POST['message'] == '') {
    throw new Exception("Message can not be empty");
    }

    $statement = $conn->prepare("INSERT INTO messages (subject, message, customer_id, agent_id, posted_on) VALUES (?,?,?,?,?)");
    $statement->execute([$_POST['subject'],$_POST['message'],$_SESSION['customer']['id'],$_POST['agent_id'],date('Y-m-d H:i:s')]);

    //The registration-verify.php is subject to change
    // $link = BASE_URL.'registration-verify.php?email='.$_POST['email'].'&token='.$token;
    $email_message = 'A customer has sent you a message. Solease login to your account and check that. <br>';
    // $email_message .= '<a href="'.$link.'">Click Here</a>';
    $mail = new PHPMailer(true);
    try {
    $mail->isSMTP();
    $mail->Host = SMTP HOST;
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
  <div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Create New Messages</h2>
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
                    <a href="<?php echo BASE_URL; ?>customer-messages.php" class="btn btn-primary btn-sm mb_20">All Message</a>
                    <form action="customer-edit-profile.php" method="post">
            <div class="row">
                
                <div class="col-md-12 mb-3">
                    <label for="">Subject *</label>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" value="">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Message</label>
                    <div class="form-group">
                        <div class="mb-3">
                            <textarea class="form-control editor" name="" id="" rows="3"></textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Select Agent *</label>
                    <div class="form-group">
                        <select name="agent_id" class="form-select select2">
                           <?php
                                $statement = $conn->prepare("SELECT * FROM agents WHERE status=? ORDER BY fullname ASC");
                                $statement->execute([1]);
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                $total = $statement->rowCount();
                                foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname'] .' - '. $row['email']; ?></option>
                                    <?php
                                }
                           ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" name="form_submit" class="btn btn-primary" value="Send Message">
                    </div>
                </div>

                    
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>