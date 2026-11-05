<?php 

namespace Models;
use PDO;
use Exception;

class Location 
{

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addPropertyLocation($property_id,$property_number,$street,$barangay,$city,$province,$region,$latitude,$longitude,$status){
        try {
            // Insert data into the apt_property_locations table
            $sql = "INSERT INTO apt_property_locations SET property_id=?,property_number=?, street=?, barangay=?, city=?, province=?, region=?, latitude=?, longitude=?, status=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_id,
                $property_number,
                $street,
                $barangay,
                $city,
                $province,
                $region,
                $latitude,
                $longitude,
                $status
            ]);
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

    public function updatePropertyLocation($property_id,$property_number,$street,$barangay,$city,$province,$region,$latitude,$longitude,$status){
        try {
            // Insert data into the apt_property_locations table
            $sql = "UPDATE apt_property_locations SET property_number=?, street=?, barangay=?, city=?, province=?, region=?, latitude=?, longitude=?, status=? WHERE property_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_number,
                $street,
                $barangay,
                $city,
                $province,
                $region,
                $latitude,
                $longitude,
                $status,
                $property_id
            ]);
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

}