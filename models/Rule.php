<?php 

namespace Models;
use PDO;
use Exception;

class Rule 
{
    protected $property_id;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

    }

    public function getPropertyId() {
        return $this->property_id;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRules($property_id){
		try {
			$sql = "SELECT * FROM apt_property_rules WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	// public function updateAmenities($property_id, $amenities_csv){
	// 	try {
	// 		$sql = 'UPDATE apt_property_amenities SET amenity_name=? WHERE property_id=? AND status=1';
	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			$amenities_csv,
	// 			$property_id,
	// 		]);
	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }

	public function addRules($property_id, $short_term, $min_weeks, $mix_gender, $curfew, $from_curfew, $to_curfew, $cooking, $pets, $visitors, $from_visit, $to_visit, $alcohol, $smoking, $status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_property_rules SET property_id=?, short_term=?, min_weeks=?, mix_gender=?, curfew=?, from_curfew=?, to_curfew=?, cooking=?, pets=?, visitors=?, from_visit=?, to_visit=?, alcohol=?, smoking=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$property_id, 
                $short_term, 
                $min_weeks, 
                $mix_gender, 
                $curfew, 
                $from_curfew, 
                $to_curfew, 
                $cooking, 
                $pets, 
                $visitors, 
                $from_visit, 
                $to_visit, 
                $alcohol, 
                $smoking, 
                $status
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateRules($property_id, $short_term, $min_weeks, $mix_gender, $curfew, $from_curfew, $to_curfew, $cooking, $pets, $visitors, $from_visit, $to_visit, $alcohol, $smoking){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "UPDATE apt_property_rules SET short_term=?, min_weeks=?, mix_gender=?, curfew=?, from_curfew=?, to_curfew=?, cooking=?, pets=?, visitors=?, from_visit=?, to_visit=?, alcohol=?, smoking=?, WHERE property_id=? AND status=1"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $short_term, 
                $min_weeks, 
                $mix_gender, 
                $curfew, 
                $from_curfew, 
                $to_curfew, 
                $cooking, 
                $pets, 
                $visitors, 
                $from_visit, 
                $to_visit, 
                $alcohol, 
                $smoking, 
                $property_id
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}