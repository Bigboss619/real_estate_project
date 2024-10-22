<?php
require_once('header.php');
?>
<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 ?>
<?php
    if(!isset($_SESSION['customer']))
    {
        header('location: '.BASE_URL.'customer-login');
        exit;
    }
    $statement = $conn->prepare("SELECT * FROM 
    messages WHERE id=?");
    $statement->execute([$_GET['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement = $conn->prepare("SELECT * FROM agents WHERE id=?");
    $statement->execute([$result[0]['agent_id']]);
    $result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result1 as $row){
        $agent_mail = $row['email'];
        $agent_name = $row['fullname'];
        $agent_photo = $row['photo'];
    }
   
?>
<?php 
    if(isset($_POST['form_submit']))
    {
        try {
                if(empty($_POST['reply']))
                {
                    throw new Exception("Reply can not be empty");
                }
                $statement = $conn->prepare("INSERT INTO message_replies (message_id,customer_id,agent_id,sender,reply,reply_on) VALUES(?,?,?,?,?,?)");
                $statement->execute([$_GET['id'], $_SESSION['customer']['id'],$result[0]['agent_id'],'Customer',$_POST['reply'],date('Y-m-d H:i:s')]);

                $email_message = 'A customer has sent you message. Please login to your account and check that.';

                
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
                        $mail->addAddress($agent_mail);
                        $mail->isHTML(true);
                        $mail->Subject = 'Customer Message';
                        $mail->Body = $email_message;
                        $mail->send();
                        $success_message = 'Message is sent successfully';
                        $_SESSION['success_message'] = $success_message;
                        header('location: ' . BASE_URL . 'customer-message/'.$_GET['id']);
                        exit;
                } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
        } catch (Exception $e) {
            $error_message =  $e->getMessage();
        }
    }
?>
  <div class="page-top" style="background-image: url(<?php echo BASE_URL; ?>uploads/banner.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Subject: <?php echo $result[0]['subject']; ?></h2>
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

                <div class="message-reply">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Reply</label>
                            <div class="form-group">
                                <textarea name="reply" class="form-control h-200" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="form_submit" class="btn btn-primary btn-sm mt_10" value="Send">
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="message-heading" style="font-size: 20px;font-weight:700;margin-bottom:10px;margin-top:30px;">
                        Main Heading
                    </div>
                    <div class="message-item" style="margin-bottom:40px;background:#e1e5f7;padding:10px;">

                        <div class="message-top">
                            <div class="photo" style="display:inline-block;">
                                <img src="<?php echo BASE_URL;?>uploads/customer-dp/<?php echo $_SESSION['customer']['photo']; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                <div class="text" style="display:inline-block;vertical-align:middle;margin-left:10px;;">
                                    <h6 style="margin-top: 10px;font-size:16px;font-weight:700;margin-bottom:5px;"><?php echo $_SESSION['customer']['fullname']; ?> <span class="badge rounded-pill text-bg-primary">Customer</span></h6>
                                    <p class="mt-3 mb-0" style="color: #838383;">Posted On: <?php echo $result[0]['posted_on']; ?></p>
                                </div>
                            </div>
                        </div>
                       
                        <div class="message-bottom mt-5">
                            <p><?php echo $result[0]['message']; ?></p>
                        </div>
                    </div>

                    <!--============= ALL REPLY SECTION ============-->
                    <div class="message-heading" style="font-size:20px;font-weight:700;margin-bottom:10px;margin-top:30px;">
                       All Replies
                    </div>

                    <?php
                        $statement = $conn->prepare("SELECT * FROM message_replies WHERE message_id=? ORDER BY id ASC");
                        $statement->execute([$_GET['id']]);
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                        $total = $statement->rowCount();
                        if(!$total){
                            echo '<div class="message-item text-danger">No reply found</div>'
                        }
                        foreach($result as $row){
                            ?>
                                <div class="message-item" style="margin-bottom:40px;background:#e1e5f7;padding:10px;border:1px solid #7b7b7b;">

                                    <div class="message-top">
                                        <div class="photo" style="display:inline-block;">
                                            <?php 
                                            if($row['sender'] == 'Customer'):
                                            ?>
                                            <img src="<?php echo BASE_URL;?>uploads/customer-dp/<?php echo $_SESSION['customer']['photo']; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                            <?php endif; ?>

                                            <?php 
                                            if($row['sender'] == 'Agent'):
                                            ?>
                                            <img src="<?php echo BASE_URL;?>uploads/agent-dp/<?php echo $agent_photo; ?>" class="img-fluid rounded-circle" style="width:60px;height:60px;vertical-align:middle;" alt="">
                                            <?php endif; ?>

                                            <div class="text" style="display:inline-block;vertical-align:middle;margin-left:10px;;">
                                                <h6 style="margin-top: 10px;font-size:16px;font-weight:700;margin-bottom:5px;">
                                                <?php 
                                                    if($row['sender'] == 'Customer'):
                                                ?>
                                                    <?php echo $_SESSION['customer']['fullname']; ?>
                                                    <span class="badge rounded-pill text-bg-primary">Customer</span>
                                                    <?php else: ?>
                                                        <?php echo $agent_name; ?>
                                                        <span class="badge rounded-pill text-bg-success">Agent</span>
                                                    <?php endif; ?>
                                                </h6>
                                                <p class="mt-3 mb-0" style="color: #838383;">Posted On: <?php echo $row['reply_on']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="message-bottom mt-5">
                                        <p><?php echo $row['reply']; ?></p>
                                    </div>
                                </div>
                            <?php
                        }  
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>