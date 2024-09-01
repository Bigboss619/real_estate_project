<?php
require_once('header.php');
    if(!isset($_REQUEST['email'])||!isset($_REQUEST['token'])) {
    header('location: '.BASE_URL);
    }
    $statement = $conn->prepare("SELECT * FROM agents WHERE email=? AND token=?");
    $statement->execute([$_REQUEST['email'],$_REQUEST['token']]);
    $total = $statement->rowCount();
    if($total) {
    $statement = $conn->prepare("UPDATE agents SET token=?, status=? WHERE email=? AND token=?");
    $statement->execute(['',1,$_REQUEST['email'],$_REQUEST['token']]);
    // We made this variable show onces using iziToast javascript (check the footer for the code)
    $_SESSION['success_message'] = 'Registration verified successfully. Please login now';
    header('location: '.BASE_URL.'agent-login');
    } else {
    header('location: '.BASE_URL);
    } 
?>