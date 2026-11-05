<?php 

namespace Models;
use PDO;
use Exception;

class Schedule 
{
    protected $slot_id;
    protected $date;
    protected $time;
    protected $property_id;

    public function __construct($date, $time, $property_id)
    {
        $this->date = $date;
        $this->time = $time;
        $this->property_id = $property_id;
    }

    public function getId() {
        return $this->slot_id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }

    public function getPropertyId() {
        return $this->property_id;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getDateTime($property_id){
		try {
            $sql = "SELECT * FROM apt_unavailable_slots WHERE property_id=$property_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getDates($property_id){
		try {
            $sql = "SELECT date FROM apt_unavailable_slots WHERE property_id=$property_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getAllTime($date, $property_id){
		try {
            $sql = "SELECT time FROM apt_unavailable_slots WHERE date=$date AND property_id=$property_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        
	}

    public function setUnavailable($property_id, $date, $time){
        try {
            $sql = "INSERT INTO apt_unavailable_slots SET property_id=?, date=?, time=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$property_id, 
                $date,
                $time
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateUnavailable($property_id, $date, $time){
        try {
            $sql = "UPDATE apt_unavailable_slots SET time=? WHERE property_id=? AND date=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$time,
				$property_id, 
                $date
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}