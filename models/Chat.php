<?php
namespace Models;
use \PDO;
use Exception;

class Chat
{

    protected $chat_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function getUserChats($user_id){
        try {
            $sql = 'SELECT apt_chats.*, apt_user_information.first_name, apt_user_information.last_name, apt_properties.property_name FROM apt_chats JOIN apt_user_information ON apt_chats.user_id=apt_user_information.user_id JOIN apt_properties ON apt_chats.property_id=apt_properties.property_id WHERE apt_chats.user_id=? AND apt_chats.status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $user_id, 
            ]);
            $row = $statement->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getChat($user_id, $chat_id){
        try {
            $sql = 'SELECT apt_chats.*, apt_user_information.first_name, apt_user_information.last_name, apt_properties.property_name FROM apt_chats JOIN apt_user_information ON apt_chats.user_id=apt_user_information.user_id JOIN apt_properties ON apt_chats.property_id=apt_properties.property_id WHERE apt_chats.user_id=? AND apt_chats.chat_id=? AND apt_chats.status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $user_id, 
                $chat_id
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function checkChat($user_id, $property_id){
        try {
            $sql = 'SELECT * FROM apt_chats WHERE user_id=? AND property_id=?';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $user_id, 
                $property_id
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getLandlordChat($landlord_id, $chat_id){
        try {
            $sql = 'SELECT apt_chats.*, apt_user_information.first_name, apt_user_information.last_name, apt_properties.property_name FROM apt_chats JOIN apt_user_information ON apt_chats.user_id=apt_user_information.user_id JOIN apt_properties ON apt_chats.property_id=apt_properties.property_id WHERE apt_chats.landlord_id=? AND apt_chats.chat_id=? AND apt_chats.status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $landlord_id, 
                $chat_id
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getLandlordChats($landlord_id){
        try {
            $sql = 'SELECT apt_chats.*, apt_user_information.first_name, apt_user_information.last_name, apt_properties.property_name FROM apt_chats JOIN apt_user_information ON apt_chats.user_id=apt_user_information.user_id JOIN apt_properties ON apt_chats.property_id=apt_properties.property_id WHERE apt_chats.landlord_id=? AND apt_chats.status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $landlord_id, 
            ]);
            $row = $statement->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function createChat($property_id, $landlord_id, $user_id, $status)
    {
        try{
            $sql = 'INSERT INTO apt_chats SET property_id=?, landlord_id=?, user_id=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_id, 
                $landlord_id,
                $user_id, 
                $status
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function deleteChat($property_id, $landlord_id, $user_id, $status)
    {
        try {
            $sql = 'UPDATE apt_chats SET status=? WHERE property_id=? AND landlord_id=? AND user_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$status,
				$property_id, 
                $landlord_id,
                $user_id, 
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

}