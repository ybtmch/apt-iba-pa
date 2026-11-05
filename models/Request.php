<?php 

namespace Models;
use PDO;
use Exception;

class Request 
{

	protected $connection;


    public function getId() {
        return $this->application_id;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAllRequests(){
		try {
			$sql = "SELECT apt_application_requests.*, apt_user_information.first_name, apt_user_information.last_name, apt_user_information.contact_number, apt_properties.property_type, apt_properties.property_name, apt_users.email FROM apt_application_requests JOIN apt_user_information ON apt_application_requests.user_id=apt_user_information.user_id JOIN apt_users ON apt_users.user_id=apt_application_requests.user_id JOIN apt_properties ON apt_properties.property_id=apt_application_requests.property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getRequest($application_id){
		try {
			$sql = "SELECT * FROM apt_application_requests 
           WHERE application_id=$application_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    // 	public function getRequest($application_id){
	// 	try {
	// 		$sql = "SELECT apt_application_requests.application_id, apt_user_information.*, apt_users.email, apt_properties.*, apt_property_details.*, apt_property_locations.*, apt_property_amenities.*, apt_property_rules.* FROM apt_application_requests 
    //         INNER JOIN apt_user_information ON apt_application_requests.user_id=apt_user_information.user_id 
    //         INNER JOIN apt_users ON apt_users.user_id=apt_application_requests.user_id 
    //         INNER JOIN apt_properties ON apt_properties.property_id=apt_application_requests.property_id 
    //         INNER JOIN apt_property_details ON apt_property_details.property_id=apt_application_requests.property_id 
    //         INNER JOIN apt_property_locations ON apt_property_locations.property_id=apt_application_requests.property_id 
    //         INNER JOIN apt_property_amenities ON apt_property_amenities.property_id=apt_application_requests.property_id 
    //         INNER JOIN apt_property_rules ON apt_property_rules.property_id=apt_application_requests.property_id WHERE application_id=$application_id";
	// 		$data = $this->connection->query($sql)->fetch();
	// 		return $data;

	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
	// }

	public function editRequest($application_id, $user_id, $property_id, $status, $user_type){
		try {
			$sql1 = 'UPDATE apt_application_requests SET status=? WHERE application_id=?';
			$statement1 = $this->connection->prepare($sql1);
			$statement1->execute([
				$status,
				$application_id,
			]);

            $sql2 = 'UPDATE apt_properties SET status=? WHERE property_id=?';
			$statement2 = $this->connection->prepare($sql2);
			$statement2->execute([
				$status,
				$property_id,
			]);

            $sql3 = 'UPDATE apt_property_details SET status=? WHERE property_id=?';
			$statement3 = $this->connection->prepare($sql3);
			$statement3->execute([
				$status,
				$property_id,
			]);

            $sql4 = 'UPDATE apt_property_images SET status=? WHERE property_id=?';
			$statement4 = $this->connection->prepare($sql4);
			$statement4->execute([
				$status,
				$property_id,
			]);

            $sql5 = 'UPDATE apt_property_locations SET status=? WHERE property_id=?';
			$statement5 = $this->connection->prepare($sql5);
			$statement5->execute([
				$status,
				$property_id,
			]);

            $sql6 = 'UPDATE apt_property_rules SET status=? WHERE property_id=?';
			$statement6 = $this->connection->prepare($sql6);
			$statement6->execute([
				$status,
				$property_id,
			]);

            $sql7 = 'UPDATE apt_units SET status=? WHERE property_id=?';
			$statement7 = $this->connection->prepare($sql7);
			$statement7->execute([
				$status,
				$property_id,
			]);

            $sql9 = 'UPDATE apt_user_information SET user_type=?, status=? WHERE user_id=?';
			$statement9 = $this->connection->prepare($sql9);
			$statement9->execute([
                $user_type,
				$status,
				$user_id,
			]);

            $sql10 = 'UPDATE apt_property_availability SET status=? WHERE property_id=?';
			$statement10 = $this->connection->prepare($sql10);
			$statement10->execute([
				$status,
				$property_id,
			]);

            $sql11 = 'UPDATE apt_property_amenities SET status=? WHERE property_id=?';
			$statement11 = $this->connection->prepare($sql11);
			$statement11->execute([
				$status,
				$property_id,
			]);

            return $success = ($sql1 && $sql2 && $sql3 && $sql4 && $sql5 && $sql6 && $sql7 && $sql9 && $sql10 && $sql11) ? TRUE : FALSE;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function addRequest($user_id, $property_id, $status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_application_requests SET user_id=?, property_id=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$user_id, 
                $property_id, 
                $status
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}