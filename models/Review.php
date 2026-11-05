<?php
namespace Models;
use \PDO;

class Review
{

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getAllReviews(){
        try {
			$sql = "SELECT * FROM apt_reviews 
            LEFT JOIN apt_user_information ON apt_reviews.user_id=apt_user_information.user_id 
            LEFT JOIN apt_properties ON apt_reviews.property_id=apt_properties.property_id WHERE apt_reviews.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addReview($rating, $description, $user_id, $property_id, $status){
        try {
            $sql = "INSERT INTO apt_reviews SET rating=?, description=?, user_id=?, property_id=?, status=?";
            $statement = $this->connection->prepare($sql);
			return $statement->execute([
                $rating, 
                $description, 
                $user_id, 
                $property_id, 
                $status

            ]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function getReviews($property_id){
        try {
			$sql = "SELECT * FROM apt_reviews JOIN apt_user_information ON apt_reviews.user_id=apt_user_information.user_id LEFT JOIN apt_user_images ON apt_reviews.user_id=apt_user_images.user_id WHERE apt_reviews.property_id=$property_id AND apt_reviews.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getRatings($property_id){
        try {
			$sql = "SELECT rating FROM apt_reviews WHERE apt_reviews.property_id=$property_id AND apt_reviews.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteReview($review_id){
        try {
			$sql = 'UPDATE apt_reviews SET status=0 WHERE review_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $review_id
            ]);
		} catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function checkReview($user_id, $property_id){
        try {
            $sql = "SELECT * FROM apt_reviews WHERE user_id=$user_id AND property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetch();
			return $data;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function checkReviewStatus($user_id, $property_id){
        try {
            $sql = "SELECT * FROM apt_reservations WHERE user_id=$user_id AND property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetch();
			return $data;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}