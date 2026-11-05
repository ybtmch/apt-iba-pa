<?php 

namespace Models;
use PDO;
use Exception;

class User 
{

    // Database Connection Object
	protected $connection;


    public function getId() {
        return $this->user_id;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function registerUserInfo($user_id, $first_name, $last_name, $contact_number, $status){
        try {
            $sql = "INSERT INTO apt_user_information SET user_id=?, first_name=?, last_name=?, contact_number=?, user_type=2, status=?"; 
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $user_id,
                $first_name, 
                $last_name, 
                $contact_number, 
                $status
            ]);
    
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getLandlords(){
		try {
			$sql = "SELECT apt_user_information.*, apt_users.*, apt_user_images.image_name, apt_properties.property_name FROM apt_user_information JOIN apt_users ON apt_user_information.user_id=apt_users.user_id LEFT JOIN apt_user_images ON apt_user_information.user_id=apt_user_images.user_id JOIN apt_properties ON apt_user_information.user_id=apt_properties.landlord_id WHERE apt_user_information.user_type=1 AND apt_user_information.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getUsers(){
		try {
			$sql = "SELECT apt_user_information.*, apt_users.*, apt_user_images.image_name FROM apt_user_information JOIN apt_users ON apt_user_information.user_id=apt_users.user_id LEFT JOIN apt_user_images ON apt_user_information.user_id=apt_user_images.user_id WHERE apt_user_information.user_type=2 AND apt_user_information.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getById($user_id){
        try {
            $sql = 'SELECT apt_user_information.*, apt_users.*, apt_user_images.image_name FROM apt_user_information JOIN apt_users ON apt_user_information.user_id=apt_users.user_id LEFT JOIN  apt_user_images ON apt_user_information.user_id=apt_user_images.user_id WHERE apt_user_information.user_id=? AND apt_user_information.status=1';
			$statement = $this->connection->prepare($sql);
            
			$statement->execute([
				$user_id
			]);

            return $row = $statement->fetch();

        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addLandlord($user_id, $first_name, $last_name, $contact_number, $status){
        try {
			$sql = "INSERT INTO apt_user_information SET user_id=?, first_name=?, last_name=?, contact_number=?, user_type=1, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $user_id,
				$first_name, 
                $last_name, 
                $contact_number, 
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addUser($user_id, $first_name, $last_name, $contact_number){
        try {
			$sql = "INSERT INTO apt_user_information SET user_id=?, first_name=?, last_name=?, contact_number=?, user_type=2, status=1"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $user_id,
				$first_name, 
                $last_name, 
                $contact_number, 
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateUser($user_id, $first_name, $last_name, $contact_number){
		try {
            $sql = "UPDATE apt_user_information SET first_name=?, last_name=?, contact_number=? WHERE user_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$first_name,
				$last_name,
				$contact_number,
                $user_id
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteUser($user_id){
		try {
			$sql = 'UPDATE apt_user_information SET status=0 WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$user_id
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}