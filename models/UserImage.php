<?php
namespace Models;
use \PDO;

class UserImage
{

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addImage($user_id, $image_name, $status){
        $sql = 'INSERT INTO apt_user_images SET user_id=?, image_name=?, status=?';
		$statement = $this->connection->prepare($sql);
		return $statement->execute([
            $user_id,
            $image_name,
            $status
        ]);
    }

    public function getImage($user_id){
        try {
			$sql = "SELECT * FROM apt_user_images WHERE user_id=$user_id AND status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateImage($user_id, $image_name){
        try {
			$sql = 'UPDATE apt_user_images SET image_name=? WHERE user_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $image_name, 
                $user_id, 
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteImage($user_id){
        try {
			$sql = 'UPDATE apt_property_images SET status=0 WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $user_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}