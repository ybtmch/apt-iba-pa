<?php 

namespace Models;
use PDO;
use Exception;

class Property 
{
    // Database Connection Object
	protected $connection;

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getProperties(){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            INNER JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            INNER JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id
            INNER JOIN apt_property_amenities ON apt_properties.property_id=apt_property_amenities.property_id
            INNER JOIN apt_property_images ON apt_properties.property_id=apt_property_images.property_id
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1 GROUP BY apt_properties.property_id;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertiesStatistics(){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT apt_properties.property_id, apt_properties.property_name, apt_property_details.total_units, apt_property_details.occupied_units, apt_user_information.first_name, apt_user_information.last_name, apt_property_locations.barangay FROM apt_properties INNER JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id INNER JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id GROUP BY apt_properties.property_id ORDER BY apt_property_details.occupied_units DESC" ;
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getAllMaps(){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT apt_properties.property_name, apt_property_locations.* FROM apt_properties JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id WHERE apt_properties.status=1;
            ";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertiesByBarangay($barangay){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id   
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1 AND apt_property_locations.barangay=$barangay";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getProperty($landlord_id){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1 AND apt_properties.landlord_id=$landlord_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyDetails($property_id){
		try {
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id 
            LEFT JOIN apt_property_images ON apt_properties.property_id=apt_property_images.property_id
            LEFT JOIN apt_property_amenities ON apt_properties.property_id=apt_property_amenities.property_id
            WHERE apt_properties.property_id=? AND apt_user_information.user_type=1 AND apt_properties.status=1";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_id
			]);
    
            $data = $statement->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getLandlordProperty($property_id, $landlord_id){
		try {
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id 
            LEFT JOIN apt_property_images ON apt_properties.property_id=apt_property_images.property_id
            LEFT JOIN apt_property_amenities ON apt_properties.property_id=apt_property_amenities.property_id
            WHERE apt_properties.property_id=? AND apt_properties.landlord_id=? AND apt_user_information.user_type=1 AND apt_properties.status=1";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_id,
                $landlord_id
			]);
    
            $data = $statement->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function addProperty($property_type, $property_name, $landlord_id, $status){
        try {
            // Insert data into the apt_properties table
            $sql = "INSERT INTO apt_properties SET property_type=?, property_name=?, landlord_id=?, status=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_type,
                $property_name,
                $landlord_id,
                $status
            ]);
          
            $lastInsertedId = $this->connection->lastInsertId();
            return $lastInsertedId;
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

    public function updateProperty($property_id, $property_type, $property_name, $landlord_id, $status){
        try {
            // Insert data into the apt_properties table
            $sql = "UPDATE apt_properties SET property_type=?, property_name=?, landlord_id=?, status=? WHERE property_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_type,
                $property_name,
                $landlord_id,
                $status,
                $property_id
            ]);
          
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

}
