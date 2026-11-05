<?php 

namespace Models;
use PDO;
use Exception;

class Room 
{
    protected $room_id;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

	}

    public function getId() {
        return $this->room_id;
    }
    
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRooms($property_id){
		try {
			$sql = "SELECT * FROM apt_rooms WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addRoom($property_id, $room_type, $total_rooms, $occupied_rooms, $furnished_type, $monthly_rent, $status){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_rooms SET property_id=?, room_type=?, total_rooms=?, occupied_rooms=?, furnished_type=?, monthly_rent=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$property_id, 
                $room_type, 
                $total_rooms, 
                $occupied_rooms, 
                $furnished_type, 
                $monthly_rent, 
                $status,
			]);
			$lastInsertedId = $this->connection->lastInsertId();
            return $lastInsertedId;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getOccupancy($room_id, $property_id){
        try {
             $sql = "SELECT occupied_rooms FROM apt_rooms WHERE room_id=$room_id AND property_id=$property_id";
             $data = $this->connection->query($sql)->fetch();
			return $data['occupied_rooms'];
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
    public function occupyRoom($room_id, $property_id, $occupied_rooms){
        try {
            $sql = "UPDATE apt_rooms SET occupied_rooms=? WHERE room_id=? AND property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $occupied_rooms,
				$room_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function updateRoom($room_id, $property_id, $room_type, $total_rooms, $occupied_rooms, $furnished_type, $monthly_rent){
        try {
            $sql = "UPDATE apt_rooms SET room_type=?, total_rooms=?, occupied_rooms=?, furnished_type=?, monthly_rent=? WHERE room_id=? AND property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $room_type, 
                $total_rooms, 
                $occupied_rooms, 
                $furnished_type, 
                $monthly_rent,
				$room_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteRoom($room_id, $status){
        try {
            $sql = "UPDATE apt_rooms SET status=0 WHERE room_id=? AND property_id=?";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$room_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}