<?php
use Models\Chat;
use Models\Message;

include "init.php";
include "session.php";

if(isset($user_id)){
    $chats = new Chat();
    $chats->setConnection($connection);
    $chats = $chats->getUserChats($user_id); 
}

?>

<html>
    <?php foreach($chats as $chat){?>
    <a href="chats?cid=<?php echo $chat['chat_id']?>">Chat</a>
    <?php } ?>
</html>

<?php 

if(isset($_GET['cid'])){
    $chat_id = $_GET['cid'];

    $messages = new Message();
    $messages->setConnection($connection);
    $messages = $messages->getMessages($chat_id);

    var_dump($messages);
    
}

?>

<html>
    <form action="chats?cid=<?= $chat_id ?>" method="POST">
    <input type="hidden" name="chat_id" id="chat_id" value="<?= $chat_id ?>">
    <input type="hidden" name="sender_id" id="sender_id" value="<?= $user_id ?>">
    <input type="text" name="message_text" id="message_text">
    <button type="submit" name="send_message" id="send_message">Send</button>
    </form>
</html>

<?php

if(isset($_POST['send_message'])){
    $message_text = $_POST['message_text'];
    $chat_id = $_POST['chat_id'];
    $sender_id = $_POST['sender_id'];

    //var_dump($message_text, $chat_id, $sender_id);

    $new_message = new Message();
    $new_message->setConnection($connection);
    $new_message = $new_message->newMessage($chat_id, $sender_id, $message_text);
    
    var_dump($new_message);
    
}