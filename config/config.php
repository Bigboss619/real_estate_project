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

    

   
   
?>