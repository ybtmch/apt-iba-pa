<?php 

namespace Models;
use PDO;
use Exception;

class Unit 
{
    protected $unit_id;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

	}

    public function getId() {
        return $this->unit_id;
    }
    
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getUnits($property_id){
		try {
			$sql = "SELECT * FROM apt_units WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getUnit($unit_id){
		try {
			$sql = "SELECT * FROM apt_units WHERE unit_id=$unit_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addUnit($property_id, $unit_type, $total_units, $occupied_units, $furnished_type, $dimension, $monthly_rent, $status){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_units SET property_id=?, unit_type=?, total_units=?, occupied_units=?, furnished_type=?, dimension=?, monthly_rent=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$property_id, 
                $unit_type, 
                $total_units, 
                $occupied_units, 
                $furnished_type, 
                $dimension, 
                $monthly_rent, 
                $status,
			]);
			$lastInsertedId = $this->connection->lastInsertId();
            return $lastInsertedId;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getOccupancy($unit_id, $property_id){
        try {
             $sql = "SELECT occupied_units FROM apt_units WHERE unit_id=$unit_id AND property_id=$property_id";
             $data = $this->connection->query($sql)->fetch();
			return $data['occupied_units'];
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
    public function occupyUnit($unit_id, $property_id, $occupied_units){
        try {
            $sql = "UPDATE apt_units SET occupied_units=? WHERE unit_id=? AND property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $occupied_units,
				$unit_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function updateUnit($unit_id, $unit_type, $total_units, $occupied_units, $furnished_type, $monthly_rent, $property_id){
        try {
            $sql = "UPDATE apt_units SET unit_type=?, total_units=?, occupied_units=?, furnished_type=?, monthly_rent=? WHERE unit_id=? AND property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $unit_type, 
                $total_units, 
                $occupied_units, 
                $furnished_type, 
                $monthly_rent,
				$unit_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function deleteUnit($unit_id, $status){
        try {
            $sql = "UPDATE apt_units SET status=0 WHERE unit_id=? AND property_id=?";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$unit_id,
				$property_id,
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}