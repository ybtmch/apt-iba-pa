<?php

include "vendor/autoload.php";
include "config/database.php";

require_once "stripe-php-master/init.php";

// include 'vendor/PHPMailer/PHPMailer/src/Exception.php'; 
// include 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php'; 
// include 'vendor/PHPMailer/PHPMailer/src/SMTP.php'; 

use Models\Connection;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail_username = $_ENV['MAIL_USERNAME'];
$mail_password = $_ENV['MAIL_PASSWORD'];

$stripeDetails = array(
    "secretKey" => $_ENV['STRIPE_SECRET_KEY'],
    "publishableKey" => $_ENV['STRIPE_PUBLISHABLE_KEY']
);

\Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);