<?php
namespace Models;
use \PDO;
use Exception;

class Log
{

    protected $connection;

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function addToLog($user_id, $action, $log_description)
    {
        try{
            $sql = 'INSERT INTO apt_logs SET user_id=?, action=?, description=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $user_id, 
                $action,
                $log_description
            ]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getLogs()
    {
        try {
             $sql = 'SELECT apt_logs.*, apt_user_information.first_name, apt_user_information.last_name FROM apt_logs LEFT JOIN apt_user_information ON apt_logs.user_id=apt_user_information.user_id ORDER BY apt_logs.date_time DESC';
             $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteLog($log_id){
        try {
            $sql = 'DELETE FROM apt_logs WHERE log_id=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $log_id
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}