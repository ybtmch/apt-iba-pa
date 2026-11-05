<?php 

namespace Models;
use PDO;
use Exception;

class Amenity 
{
    // Database Connection Object
	protected $connection;

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAmenities($property_id){
		try {
			$sql = "SELECT * FROM apt_property_amenities WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function updateAmenities($amenity_id, $property_id,$aircon, $bathroom, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$security, $sink,$study_area, $tv,$wifi){
		try {
			$sql = 'UPDATE apt_property_amenities SET aircon=?, bathroom=?, cabinet=?,cctv=?,drinking_water=?,elevator=?,emergency_exit=?,food_hall=?,laundry=?, lounge=?, microwave=?, parking=?,refrigerator=?, security=?, sink=?,study_area=?, tv=?,wifi=? WHERE amenity_id=? AND property_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$aircon, 
                $bathroom,
                $cabinet,
                $cctv,
                $drinking_water,
                $elevator,
                $emergency_exit,
                $food_hall,
                $laundry, 
                $lounge, 
                $microwave, 
                $parking,
                $refrigerator,
                $security, 
                $sink,
                $study_area, 
                $tv,
                $wifi,
                $amenity_id,
                $property_id,
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function addAmenities($property_id,$aircon, $bathroom, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$security, $sink,$study_area, $tv,$wifi,$status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_property_amenities SET property_id=?,aircon=?, bathroom=?, cabinet=?,cctv=?,drinking_water=?,elevator=?,emergency_exit=?,food_hall=?,laundry=?, lounge=?, microwave=?, parking=?,refrigerator=?, security=?, sink=?,study_area=?, tv=?,wifi=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $property_id,
				$aircon, 
                $bathroom,
                $cabinet,
                $cctv,
                $drinking_water,
                $elevator,
                $emergency_exit,
                $food_hall,
                $laundry, 
                $lounge, 
                $microwave, 
                $parking,
                $refrigerator,
                $security, 
                $sink,
                $study_area, 
                $tv,
                $wifi,
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}