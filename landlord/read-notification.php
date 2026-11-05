<?php 
     use Models\Notification;
     use Models\User;
     include ("../init.php");
     include ("session.php");

     if(isset($_POST['user_id'])){
        try {
             $notification = new Notification();
             $notification->setConnection($connection);
             $notification->markAsRead($user_id);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
     }
?>