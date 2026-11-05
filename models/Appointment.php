<?php 

namespace Models;
use PDO;
use Exception;

class Appointment 
{

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function checkAppointments(){
		try {
            $sql = "SELECT * FROM apt_appointments";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getAppointments($property_id){
		try {
            $sql = "SELECT * FROM apt_appointments WHERE property_id=$property_id AND status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getAppointment($appointment_id){
		try {
            $sql = "SELECT apt_appointments.*, apt_properties.property_type, apt_properties.property_name, apt_properties.landlord_id, apt_property_locations.* FROM apt_appointments JOIN apt_properties ON apt_appointments.property_id=apt_properties.property_id JOIN apt_property_locations ON apt_appointments.property_id=apt_property_locations.property_id WHERE appointment_id=$appointment_id";
            $data = $this->connection->query($sql)->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyAppointments($user_id){
		try {
            $sql = "SELECT apt_appointments.*, apt_user_information.*, apt_properties.property_name FROM apt_appointments JOIN apt_properties ON apt_appointments.property_id=apt_properties.property_id JOIN apt_user_information ON apt_appointments.user_id=apt_user_information.user_id WHERE apt_properties.landlord_id=$user_id AND apt_appointments.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyDateAppointments($property_id, $date){
		try {
            $sql = "SELECT apt_appointments.*, apt_user_information.* FROM apt_appointments LEFT JOIN apt_properties ON apt_appointments.property_id=apt_properties.property_id LEFT JOIN apt_user_information ON apt_appointments.user_id=apt_user_information.user_id WHERE apt_appointments.date='$date' AND apt_properties.property_id=$property_id AND apt_appointments.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyTimeAppointments($user_id, $date, $time){
		try {
            $sql = "SELECT apt_appointments.*, apt_user_information.*, apt_users.email, apt_properties.property_name FROM apt_appointments 
            LEFT JOIN apt_properties ON apt_appointments.property_id=apt_properties.property_id 
            LEFT JOIN apt_user_information ON apt_appointments.user_id=apt_user_information.user_id 
            LEFT JOIN apt_users ON apt_appointments.user_id=apt_users.user_id 
            LEFT JOIN apt_user_images ON apt_appointments.user_id=apt_user_images.user_id 
            WHERE apt_appointments.date='$date' 
            AND apt_appointments.time='$time' 
            AND apt_properties.landlord_id=$user_id 
            AND apt_appointments.status=1";
            $data = $this->connection->query($sql)->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getUserAppointments($user_id){
		try {
            $sql = "SELECT apt_appointments.*, apt_properties.property_type, apt_properties.property_name, apt_property_locations.property_number, apt_property_locations.street, apt_property_locations.barangay, apt_property_locations.city FROM apt_appointments JOIN apt_properties ON apt_appointments.property_id=apt_properties.property_id JOIN apt_property_locations ON apt_appointments.property_id=apt_property_locations.property_id WHERE user_id=$user_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function setAppointment($appointment_number, $property_id, $user_id, $appointment_date,$appointment_time, $status){
        try {
            //status 1=active, 0=inactive
			$sql = "INSERT INTO apt_appointments SET appointment_number=?, property_id=?, user_id=?, date=?, time=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $appointment_number, 
				$property_id, 
                $user_id, 
                $appointment_date,
                $appointment_time, 
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateAppointment($appointment_id){
        try {
            //status 1=active, 0=inactive
			$sql = "UPDATE apt_appointments SET status=? WHERE appointment_id=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
                2,
				$appointment_id, 
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function cancelAppointment($appointment_id){
        try {
			$sql = "UPDATE apt_appointments SET status=? WHERE appointment_id=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
                2,
				$appointment_id, 
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function declineAppointment($appointment_id){
        try {
			$sql = "UPDATE apt_appointments SET status=? WHERE appointment_id=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
                0,
				$appointment_id, 
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}