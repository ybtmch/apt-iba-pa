<?php 

namespace Models;
use PDO;
use Exception;

class Detail 
{
    // Database Connection Object
	protected $connection;

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addPropertyDetails($property_id,$description,$total_floors,$total_units,$lowest_rate,$electric_bill,$water_bill,$reservation_fee,$advance_deposit,$gcash,$maya,$credit_card,$cash,$status){
        try {
            // Insert data into the apt_property_details table
            $sql = "INSERT INTO apt_property_details SET property_id=?,description=?, total_floors=?, total_units=?, lowest_rate=?, electric_bill=?, water_bill=?, reservation_fee=?, advance_deposit=?, gcash=?, maya=?, credit_card=?, cash=?, status=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_id,
                $description,
                $total_floors,
                $total_units,
                $lowest_rate,
                $electric_bill,
                $water_bill,
                $reservation_fee,
                $advance_deposit,
                $gcash,
                $maya,
                $credit_card,
                $cash,
                $status
            ]);
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

    public function updatePropertyDetails($property_id,$description,$total_floors,$total_units,$lowest_rate,$electric_bill,$water_bill,$reservation_fee,$advance_deposit,$gcash,$maya,$credit_card,$cash,$status){
        try {
            $sql = "UPDATE apt_property_details SET description=?, total_floors=?, total_units=?, lowest_rate=?, electric_bill=?, water_bill=?, reservation_fee=?, advance_deposit=?, gcash=?, maya=?, credit_card=?, cash=?, status=? WHERE property_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $description,
                $total_floors,
                $total_units,
                $lowest_rate,
                $electric_bill,
                $water_bill,
                $reservation_fee,
                $advance_deposit,
                $gcash,
                $maya,
                $credit_card,
                $cash,
                $status,
                $property_id
            ]);
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }


    public function updateOccupancy($property_id, $occupancy){
        try {
            $sql = "UPDATE apt_property_details SET occupied_units=? WHERE property_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $occupancy,
                $property_id
            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}
