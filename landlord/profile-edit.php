<?php
use Models\User;
use Models\Auth;
use Models\UserImage;

include ("../init.php");
include ("session.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 1){
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

try {
    if(isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];
        $updated_first_name = $_POST['first_name'];
        $updated_last_name = $_POST['last_name'];
        $updated_contact_number = $_POST['contact_number'];

        $user_information = new User();
        $user_information->setConnection($connection);
        $user_information->updateUser($user_id, $updated_first_name, $updated_last_name, $updated_contact_number);

        $updated_email = $_POST['email_address'];

        $user = new Auth();
        $user->setConnection($connection);
        $user->updateEmail($user_id, $updated_email);

        if($_POST['password'] != NULL){
        $updated_password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $updated_password . $salt);

        $user->updatePassword($user_id, $hashedPassword, $salt);
        }

        if(isset($_FILES['image_name']) && $_FILES['image_name'] != NULL) {
        $updated_image = $_FILES['image_name'];
        $updated_image_name = $updated_image['name'];
        $updated_image_temp = $updated_image['tmp_name'];
        $uploadDirectory = "../resources/images/users/";
        $targetFilePath = $uploadDirectory . basename($updated_image_name);
        move_uploaded_file($updated_image_temp, $targetFilePath);

        $user_image = new UserImage();
        $user_image->setConnection($connection);
        $user_image->updateImage($user_id, $updated_image_name);
        }

        echo 'Updated Successfully.';
       
    }
} catch (Exception $e) {
   echo 'An error occurred: ' . $e->getMessage();
}



?>