<?php

session_start();

use Models\User;

if(isset($_SESSION['user_id']) && $_SESSION['user_type']==1){
    $user_id = $_SESSION['user_id'];
    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);
        
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $contact_number = $user['contact_number'];
    $email = $user['email'];
    $image_name = $user['image_name'];
    $full_name = $user['first_name'] . ' ' . $user['last_name'];
}
else{
    echo "<script>window.location.href='../login.php';</script>";
    exit();
}

?>