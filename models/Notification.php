<?php 

namespace Models;
use PDO;
use Exception;

class Notification 
{
    protected $notification_id;
	protected $connection;

	public function __construct()
	{
   
	}

	public function getId() {
        return $this->notification_id;
    }


	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getNotifications($user_id){
        try{
            $sql = "SELECT * FROM apt_notifications WHERE user_id=$user_id AND status=1;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function sendNotification($user_id, $notification_text, $notification_type, $isRead, $status){
        try {
             $sql = "INSERT INTO apt_notifications SET user_id=?, notification_text=?, notification_type=?, isRead=?, status=?;";
             $statement = $this->connection->prepare($sql);
             $statement->execute([
                $user_id, 
                $notification_text, 
                $notification_type, 
                $isRead, 
                $status
             ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function markAsRead($user_id){
        try {
             $sql ="UPDATE apt_notifications SET isRead=1 WHERE  user_id=?";
             $statement = $this->connection->prepare($sql);
             $statement->execute([
                $user_id
             ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getUnreadNotification($user_id){
        try {
            $sql = 'SELECT * FROM apt_notifications WHERE user_id=? AND isRead=0 AND status=1;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $user_id
            ]);
            $row = $statement->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteNotification($notification_id, $user_id){
        try {
            $sql ="UPDATE apt_notifications SET status=0 WHERE notification_id=? AND user_id=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
               $notification_id,
               $user_id
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}