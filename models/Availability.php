<?php 

namespace Models;
use PDO;
use Exception;

class Availability 
{
    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function setAvailableSlots($property_id, $time_slots, $status){
        try {
            $sql = "INSERT INTO apt_property_availability SET property_id=?, time_slots=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$property_id,
                $time_slots,
                $status
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateAvailableSlots($property_id, $time_slots, $status){
        try {
            $sql = "UPDATE apt_property_availability SET time_slots=?, status=? WHERE property_id=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $time_slots,
                $status,
                $property_id
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function deleteAvailableSlots($property_id, $status){
        try {
            $sql = "UPDATE apt_property_availability SET status=? WHERE property_id=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $status,
                $property_id
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getAvailableSlots($user_id, $property_id){
		try {
            $sql = "SELECT * FROM apt_property_availability LEFT JOIN apt_properties ON apt_property_availability.property_id=apt_properties.property_id WHERE apt_property_availability.property_id=$property_id AND apt_properties.landlord_id=$user_id";
            $data = $this->connection->query($sql)->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

}