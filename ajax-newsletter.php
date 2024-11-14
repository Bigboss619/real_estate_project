<?php
    ob_start();
    session_start();
    require_once 'config/config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    $arr = array();

    $statement = $conn->prepare("SELECT * FROM admins WHERE id=?");
    $statement->execute(array(1));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        $admin_email = $row['email'];
    }

    if(isset($_POST['email'])){
    try {
    
            if(empty($_POST['email']))
            {
            throw new Exception("Email  is required");
            }
            // Use $_POST['email'] for validation
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Invalid email");
            }
            $statement = $conn->prepare("SELECT * FROM subscribers WHERE email=?");
            $statement->execute([$_POST['email']]);
            $total = $statement->rowCount();
            if($total){
                throw new Exception('Email exists');
            }

            // generating token
            $token = bin2hex(random_bytes(32));
            // $token = md5(mt_rand());
            $statement = $conn->prepare("INSERT INTO subscribers (email, token, status) VALUES (?, ?, ?)");
            $statement->execute([$email, $token, 0]);

            $verification_link = BASE_URL.'verify-subscriber.php?email='.$email.'&token='.$token;

            //   Email Sending Codes
            $email_message = 'Please click on the following link to verify your subscription <br>';
            $email_message .= '<a href="'.$verification_link.'">'.$verification_link.'</a>';
           
            $mail = new PHPMailer(true);
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
            $mail->Subject = 'Verify Subscription';
            $mail->Body = $email_message;
            $mail->send();
            
            $arr['success_message'] = "Please check your email to confirm the email subscription. Check your spam folder too if you do not receive the email in the normal email inbox.";
    } catch (Exception $e) {
    $error_message = $e->getMessage();
    $arr['error_message'] = $error_message;
    }
    }
    echo json_encode($arr);
?>