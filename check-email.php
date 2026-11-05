<?php
include "init.php";
include ("session.php");
use Models\Auth;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);
    $email = $requestData["email"];
    $check_email = new Auth();
    $check_email->setConnection($connection);
    $check_email = $check_email->login($email);
        
        if($check_email != null){
            $emailExists = true;
        } else {
            $emailExists = false;
        }
    // Return JSON response
    echo json_encode(["emailExists" => $emailExists]);
}
?>