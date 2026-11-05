<?php
namespace Models;
use \PDO;
use Exception;

class Feedback
{

    protected $connection;

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function sendFeedback($user_id, $feedback_type,  $feedback_part, $feedback_page, $feedback_text, $status)
    {
        try{
            $sql = 'INSERT INTO apt_feedbacks SET user_id=?, feedback_type=?, feedback_part=?, feedback_page=?, feedback_text=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $user_id, 
                $feedback_type,
                $feedback_part,
                $feedback_page,
                $feedback_text,
                $status
            ]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getFeedbacks()
    {
        try {
             $sql = 'SELECT apt_feedbacks.*, apt_user_information.first_name, apt_user_information.last_name FROM apt_feedbacks LEFT JOIN apt_user_information ON apt_feedbacks.user_id=apt_user_information.user_id ORDER BY apt_feedbacks.date DESC';
             $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteFeedback($feedback_id){
        try {
            $sql = 'DELETE FROM apt_feedbacks WHERE feedback_id=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $feedback_id
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}