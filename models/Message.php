<?php
namespace Models;
use \PDO;
use Exception;

class Message
{

    protected $message_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getMessages($chat_id){
        try {
            $sql = 'SELECT * FROM apt_messages WHERE chat_id=? AND status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $chat_id, 
            ]);
            $row = $statement->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getRecentMessage($chat_id){
        try {
            $sql = 'SELECT * FROM apt_messages WHERE chat_id=? AND status=1 ORDER BY message_id DESC LIMIT 1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $chat_id, 
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getUnreadMessage($chat_id, $user_id){
        try {
            $sql = 'SELECT * FROM apt_messages WHERE chat_id=? AND sender_id!=? AND isRead=0 AND status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $chat_id, 
                $user_id
            ]);
            $row = $statement->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function newMessage($chat_id, $sender_id, $message_text)
    {
        try{
            $sql = 'INSERT INTO apt_messages SET chat_id=?, sender_id=?, message_text=?, isRead=0, status=1';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $chat_id, 
                $sender_id, 
                $message_text,
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function markAsRead($chat_id, $sender_id)
    {
        try {
            $sql = 'UPDATE apt_messages SET isRead=1 WHERE chat_id=? AND sender_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $chat_id, 
                $sender_id
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteMessage($message_id, $chat_id){
        try {
            $sql = 'UPDATE apt_messages SET status=0 WHERE message_id=? AND chat_id=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $message_id, 
                $chat_id, 
            ]);

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}