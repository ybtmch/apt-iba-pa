<?php
namespace Models;
use \PDO;
use Exception;

class Payment
{

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function getAllPayments(){
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


    public function recordPayment($user_id, $payment_type, $transaction_number)
    {
        try{
            $sql = 'INSERT INTO apt_payments SET user_id=?, payment_type=?, transaction_number=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $user_id, 
                $payment_type,
                $transaction_number
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