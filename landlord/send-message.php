<?php 
    use Models\Chat;
    use Models\Message;
    use Models\User;
    include ("../init.php");
    include ("session.php");

    if(isset($_POST['chat_message'])){
        try {
            $chat_id = $_POST['chat_id'];
            $sender_id = $_POST['sender_id'];
            $message_text = $_POST['chat_message'];

            $new_message = new Message();
            $new_message->setConnection($connection);
            $new_message->newMessage($chat_id, $sender_id, $message_text);

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
        
    } else{
        echo 'wala man';
    }


?>