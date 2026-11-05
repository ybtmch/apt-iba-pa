<?php
namespace Models;
use \PDO;
use Exception;

class Bookmark
{

    protected $bookmark_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function addBookmark($property_id, $user_id, $status)
    {
        try{
            $sql = 'INSERT INTO apt_bookmarks SET property_id=?, user_id=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_id, 
                $user_id, 
                $status
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateBookmark($property_id, $user_id, $status)
    {
        try {
            $sql = 'UPDATE apt_bookmarks SET status=? WHERE property_id=? AND user_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$status,
				$property_id, 
                $user_id, 
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function checkBookmark($property_id, $user_id){
        try {
            $sql = 'SELECT status FROM apt_bookmarks WHERE property_id=? AND user_id=?;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_id, 
                $user_id, 
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getSavedProperties($user_id){
        try {
            $sql = 'SELECT apt_properties.*, apt_property_details.lowest_rate, apt_property_locations.barangay FROM apt_bookmarks 
            LEFT JOIN apt_properties ON apt_bookmarks.property_id=apt_properties.property_id
            LEFT JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id
            WHERE apt_bookmarks.user_id=? AND apt_bookmarks.status=1';
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
}