<?php
     // Paypal Payment Setup
     require_once "vendor/autoload.php";
     use Omnipay\Omnipay;
 
     // i used my business account detail 1 for this project
     define('CLIENT_ID', 'Adz1XQmkUT8ujWyuVntIFnhCXgi7wmYeWWyBGXEPYy7AGg20BhjgVfvpYepjKNIiYAnG55RahuMts_bj');
     define('CLIENT_SECRET', 'EGwUGGrWUB8UpT7XSRfUYNfrnGXdBHJARR0Kz1sAhDMKPqtc1sR0eWjqKk1ntx4rtaTmlAD0yWzgkbOT');
  
     define('PAYPAL_RETURN_URL', BASE_URL .'agent-paypal-success.php');
     define('PAYPAL_CANCEL_URL', BASE_URL .'agent-paypal-cancel.php');
     define('PAYPAL_CURRENCY', 'USD'); // set your currency here
  
     $gateway = Omnipay::create('PayPal_Rest');
     $gateway->setClientId(CLIENT_ID);
     $gateway->setSecret(CLIENT_SECRET);
     $gateway->setTestMode(true); //set it to 'false' when go live
?>