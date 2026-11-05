<?php
namespace Models;
use \PDO;

class Image
{

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addImage($property_id, $targetFilePath, $title, $thumbnail, $status){
        //$encrypted_password = sha1($password);
        $sql = 'INSERT INTO apt_property_images SET property_id=?, image_path=?, title=?, thumbnail=?, status=?';
		$statement = $this->connection->prepare($sql);
		return $statement->execute([
            $property_id,
            $targetFilePath,
            $title,
            $thumbnail,
            $status,
        ]);
    }

    public function getImages($property_id){
        try {
			$sql = "SELECT * FROM apt_property_images WHERE property_id=$property_id AND status=1 ORDER BY title;";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getImage($image_id, $property_id){
        try {
			$sql = "SELECT * FROM apt_property_images WHERE image_id=$image_id AND property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getDisplayImage($property_id){
        try {
			$sql = "SELECT * FROM apt_property_images WHERE thumbnail=1 AND property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteImage($image_id, $property_id){
        try {
			$sql = 'UPDATE apt_property_images SET status=0 WHERE image_id=? AND property_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $image_id,
                $property_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateImage($image_id, $property_id, $image_path){
        try {
			$sql = 'UPDATE apt_property_images SET image_path=? WHERE image_id=? AND property_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $image_path,
                $image_id,
                $property_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateImageTitle($image_id, $property_id, $title){
        try {
			$sql = 'UPDATE apt_property_images SET title=? WHERE image_id=? AND property_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $title,
                $image_id,
                $property_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function removeThumbnail($property_id){
        try {
			$sql = 'UPDATE apt_property_images SET thumbnail=0 WHERE property_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $property_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function setThumbnail($image_id, $property_id, $thumbnail){
        try {
			$sql = 'UPDATE apt_property_images SET thumbnail=1 WHERE image_id=? AND property_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $image_id,
                $property_id
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

}