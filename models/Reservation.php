<?php 

namespace Models;
use PDO;
use Exception;

class Reservation 
{

    public function getId() {
        return $this->reservation_id;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getReservations($property_id){
		try {
            $sql = "SELECT * FROM apt_reservations 
             WHERE apt_reservations.property_id=$property_id AND apt_reservations.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}
    
    public function getPendingReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_user_information.first_name, apt_user_information.last_name, apt_user_information.contact_number, apt_users.email, apt_properties.property_name, apt_properties.property_type, apt_units.unit_type, apt_property_locations.* FROM apt_reservations 
            INNER JOIN apt_users ON apt_reservations.user_id=apt_users.user_id 
            INNER JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id 
            INNER JOIN apt_user_information ON apt_reservations.user_id=apt_user_information.user_id 
            INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id 
            LEFT JOIN apt_units ON apt_reservations.unit_id=apt_units.unit_id WHERE apt_properties.landlord_id=$user_id AND apt_reservations.status=2;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_user_information.first_name, apt_user_information.last_name, apt_user_information.contact_number, apt_properties.property_name, apt_properties.property_type, apt_units.unit_type, apt_property_locations.*, apt_users.email FROM apt_reservations 
            INNER JOIN apt_user_information ON apt_reservations.user_id=apt_user_information.user_id 
            INNER JOIN apt_users ON apt_reservations.user_id=apt_users.user_id 
            INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id 
            INNER JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id 
            INNER JOIN apt_units ON apt_reservations.unit_id=apt_units.unit_id WHERE apt_properties.landlord_id=$user_id AND apt_reservations.status=1 OR apt_reservations.status=2 ORDER BY apt_reservations.reservation_date DESC";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getUserReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_properties.property_type, apt_properties.property_name, apt_property_locations.*, apt_units.unit_type FROM apt_reservations JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id JOIN apt_units ON apt_reservations.unit_id=apt_units.unit_id WHERE user_id=$user_id AND apt_reservations.status!=0";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getReservation($reservation_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_properties.property_type, apt_properties.property_name, apt_properties.landlord_id, apt_property_locations.*, apt_units.unit_type FROM apt_reservations INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id INNER JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id INNER JOIN apt_units ON apt_reservations.property_id=apt_units.property_id WHERE appointment_id=$appointment_id";
            $data = $this->connection->query($sql)->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function acceptReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				1, //Accepted
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function confirmReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				1, //Declined
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function declineReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				3, //Declined
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function deleteReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				0, //Deleted
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function addReservation($reservation_number, $user_id, $property_id, $unit_id, $unit_count, $payment_status, $status){
        try {
			$sql = "INSERT INTO apt_reservations SET reservation_number=?, user_id=?, property_id=?, unit_id=?, no_of_units=?, payment_status=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $reservation_number,
                $user_id, 
                $property_id, 
                $unit_id, 
                $unit_count,
                $payment_status, 
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}