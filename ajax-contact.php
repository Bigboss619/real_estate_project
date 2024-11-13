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
                if($_POST['name'] == ''){
                throw new Exception("Name can not be empty");
                }

                if(empty($_POST['email']))
                {
                throw new Exception("Email  is required");
                }

                // Use $_POST['email'] for validation
                $email = $_POST['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Invalid email");
                }
                
                if(empty($_POST['message']))
                {
                throw new Exception("Message cannot be empty");
                }

                //   Email Sending Codes
                $email_message = 'Full Name: '.$_POST['name'].'<br>';
                $email_message .= 'Email: '.$_POST['email'].'<br>';
                $email_message .= 'Message: '.$_POST['message'].'<br>';
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_ENCRYPTION;
                $mail->Port = SMTP_PORT;
                $mail->setFrom(SMTP_FROM);
                $mail->addAddress($admin_email);
                $mail->isHTML(true);
                $mail->Subject = 'Contact Form Message';
                $mail->Body = $email_message;
                $mail->send();
                $arr['success_message'] = "Your email is sent successfully. You will get replied soon.";
        } catch (Exception $e) {
        $error_message = $e->getMessage();
        $arr['error_message'] = $error_message;
        }
    }
    // echo json_encode($arr);
?>