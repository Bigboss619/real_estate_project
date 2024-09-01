<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "real_estate_project";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
    echo "Connection failed: " .$e->getMessage();
    }
    define("BASE_URL", "http://localhost/real_estate_project/");
    define("ADMIN_URL",BASE_URL."admin/");
    // $cur_page = substr($_SERVER["SCRIPT_NAME"],strpos($_SERVER["SCRIPT_NAME"],"/")+1);
    $cur_page = basename($_SERVER['REQUEST_URI']);

    // Mailer Setup
    define("SMTP_HOST", "sandbox.smtp.mailtrap.io");
    define("SMTP_PORT", "2525");
    define("SMTP_USERNAME", "426bdb07731537");
    define("SMTP_PASSWORD", "6cf31588ee32b1");
    define("SMTP_ENCRYPTION", "tls");
    define("SMTP_FROM", "contact@yourwebsite.com");

    // Stripe payment method
    define('STRIPE_TEST_PK', 'pk_test_51PrqJ72L3bhIDhDy7TIbcU1ofzL4QAbYQZwOKn1C7pgTx9NANBjKnwzTG3m4z6XoEMzc7aB88uDn9O3vBxLtmfgR00f79AxvY1');
    define('STRIPE_TEST_SK', 'sk_test_51PrqJ72L3bhIDhDyUsaSexxXtoxCC6687G98aB3UVEhR46WKboXH6fucmdlwBI0XYVl2THY2HjtkI2I3FY2bHP3O00BVu4aijM');

    define('STRIPE_SUCCESS_URL', BASE_URL.'agent-stripe-success.php');
    define('STRIPE_CANCEL_URL', BASE_URL. 'agent-stripe-cancel.php');

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