<?php
use Models\User;

session_start();


if(isset($_SESSION['user_id']) && $_SESSION['user_type']==3){
    $user_id = $_SESSION['user_id'];
    
    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $contact_number = $user['contact_number'];
    $email = $user['email'];
    $full_name = $user['first_name'] . ' ' . $user['last_name'];
    $image_path = isset($user['image_name']) ? $user['image_name'] : 'admin.png' ;
}
else{
    echo "<script>window.location.href='../login.php';alert('Invalid credentials.')</script>";
    exit();
}

?>