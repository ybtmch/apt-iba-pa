<?php 
include ("init.php");
// include ("session.php");
session_start();
use Models\Auth;
use Models\User;
use Models\Log;

try {
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'])){
        $first_name = ucfirst($_POST['first_name']);
        $last_name = ucfirst($_POST['last_name']);
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);
        $status = 1;
        
        $register_user = new Auth();
        $register_user->setConnection($connection);
        $register_user = $register_user->registerUser($email, $hashedPassword, $salt, $status);
        
        $user_auth = $register_user['statement'] ?? null;
        $user_id = $register_user['lastInsertedId'] ?? null;

        $register_info = new User();
        $register_info->setConnection($connection);
        $register_info->registerUserInfo($user_id, $first_name, $last_name, $contact_number, $status);

        $log_description = $first_name . ' ' . $last_name . ' created an account using ' . $email;
        $action = 'register';
        $log = new Log();
        $log->setConnection($connection);
        $log->addToLog($user_id, $action, $log_description);

        if($user_auth != NULL && $user_id != NULL){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_type'] = 2;
            header('location:index.php');
            exit();
        }
        else {
            echo '<script>alert("Failed Registration")</script>';
        }

    }
}

catch (Exception $e) {
    
}

?>

