<?php
namespace Models;
use \PDO;
use Exception;

class Faq
{

    protected $faq_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function addFaq($question, $answer, $status)
    {
        try{
            $sql = 'INSERT INTO apt_faqs SET question=?, answer=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $question, 
                $answer, 
                $status
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getFaqs()
    {
        try {
             $sql = 'SELECT * FROM apt_faqs WHERE status=1';
             $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function updateFaq($faq_id, $question, $answer)
    {
        try {
            $sql = 'UPDATE apt_faqs SET question=?, answer=? WHERE faq_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$question, 
                $answer, 
                $faq_id
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteFaq($faq_id, $status){
        try {
            $sql = 'UPDATE apt_faqs SET status=? WHERE faq_id=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $status, 
                $faq_id, 
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}