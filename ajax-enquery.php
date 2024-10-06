<?php

 require_once 'config/config.php';

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 require 'vendor/autoload.php';

 $arr = array();
 
 if(isset($_POST['email'])){
  
    try {
          if($_POST['full_name'] == ''){
            throw new Exception("Full name can not be empty");
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
          if(empty($_POST['phone']))
          {
            throw new Exception("Phone cannot be empty");
          }
          if(empty($_POST['comment']))
          {
            throw new Exception("Message cannot be empty");
          }
          
        //   Email Sending Codes
        $email_message = 'Full Name: '.$_POST['full_name'].'<br>';
        $email_message .= 'Email: '.$_POST['email'].'<br>';
        $email_message .= 'Phone: '.$_POST['phone'].'<br>';
        $email_message .= 'Message: '.$_POST['comment'].'<br>';
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;
        $mail->setFrom(SMTP_FROM);
        $mail->addAddress($_POST['agent_email']);
        $mail->isHTML(true);
        $mail->Subject = 'Enquery Form Email Customer';
        $mail->Body = $email_message;
        $mail->send();

       
        $arr['success_message'] = "Your email is sent successfully. Agent will check and reply you soon.";
            
    } catch (Exception $e) {
            $error_message = $e->getMessage();
            $arr['error_message'] = $error_message;
    }
 }
 echo json_encode($arr);

