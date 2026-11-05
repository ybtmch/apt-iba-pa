<?php 
     use Models\Message;
     use Models\Chat;
     use Models\User;
     include ("init.php");
     include ("session.php");

     if(isset($_POST['user_id'])){
        try {
            $chat_id = $_POST['chat_id'];
            $user_id = $_POST['user_id'];

            $chat = new Chat();
            $chat->setConnection($connection);
            $chat = $chat->getChat($user_id, $chat_id);
            $sender_id = $chat['landlord_id'];

            $message = new Message();
            $message->setConnection($connection);
            $message->markAsRead($chat_id, $sender_id);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
     }
?>