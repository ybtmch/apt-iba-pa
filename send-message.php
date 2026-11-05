<?php 
    use Models\Chat;
    use Models\Message;
    use Models\User;
    include ("init.php");
    include ("session.php");

    if(isset($_POST['chat_message'])){
        try {
            $chat_id = $_POST['chat_id'];
            $sender_id = $_POST['sender_id'];
            $message_text = $_POST['chat_message'];

            $new_message = new Message();
            $new_message->setConnection($connection);
            $new_message->newMessage($chat_id, $sender_id, $message_text);

            echo json_encode(intval($chat_id));

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
        
    } 

    if(isset($_FILES['chat_image'])){
        try {
            $chat_id = $_POST['chat_id'];
            $sender_id = $_POST['sender_id'];

            $chat_image = $_FILES['image_name'];
            $chat_image_name = $chat_image['name'];
            $chat_image_temp = $chat_image['tmp_name'];
            $uploadDirectory = "resources/images/chats/";
            $targetFilePath = $uploadDirectory . basename($updated_image_name);
            move_uploaded_file($updated_image_temp, $targetFilePath);

            $new_message = new Message();
            $new_message->setConnection($connection);
            $new_message->newMessage($chat_id, $sender_id, $chat_image_name);

            echo json_encode(intval($chat_id));

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
        
    } 


?>