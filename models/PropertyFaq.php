<?php
namespace Models;
use \PDO;
use Exception;

class PropertyFaq
{

    protected $faq_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getFaqs($landlord_id)
    {
        try {
            $sql = 'SELECT * FROM apt_property_faqs WHERE landlord_id=? AND status=1';
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

    public function addFaq($landlord_id, $question, $answer, $status)
    {
        try{
            $sql = 'INSERT INTO apt_property_faqs SET landlord_id=?, question=?, answer=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $landlord_id,
                $question, 
                $answer, 
                $status
            ]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateFaq($faq_id, $landlord_id, $question, $answer)
    {
        try {
            $sql = 'UPDATE apt_property_faqs SET question=?, answer=? WHERE faq_id=? AND landlord_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$question, 
                $answer, 
                $faq_id,
                $landlord_id
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteFaq($faq_id, $landlord_id, $status){
        try {
            $sql = 'UPDATE apt_property_faqs SET status=? WHERE faq_id=? and landlord_id=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $status, 
                $faq_id, 
                $landlord_id,
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}