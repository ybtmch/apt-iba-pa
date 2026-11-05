<?php 
use Models\Property;
use Models\Amenity;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
include "../../init.php";
//include ("../session.php");

try {
	if (isset($_POST['edit_property'])) {
                $property_id = $_POST['property_id'];
                $property_name = $_POST['property_name'];
                $owner_id = $_POST['owner_id'];
                $total_rooms = $_POST['total_rooms'];
                $total_floors = $_POST['total_floors'];
                $description = $_POST['description'];
                $property_number = $_POST['property_number'];
                $street = $_POST['street'];
                $region = $_POST['region_text'];
                $province = $_POST['province_text'];
                $city = $_POST['city_text'];
                $barangay = $_POST['barangay_text'];
                $postal = $_POST['postal'];
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $reservation = $_POST['reservation'];
                $deposit = $_POST['deposit'];
                $status = 1;

                $property = new Property('','','','', '', '', '','','','','', '', '', '','','','');
                $property->setConnection($connection);
                $property->updateProperty($property_id, $property_name, $owner_id, $total_rooms, $total_floors, $description, $property_number, $street, $region, $province, $city, $barangay, $postal, $latitude, $longitude, $reservation, $deposit, $status);
                
                header("Location: view.php?property_id=" . $property_id  . "#property_information");
                exit();
	} 
        else if (isset($_POST['edit_amenities'])) {
                if(isset($_POST["amenities"]) && is_array($_POST["amenities"])){
                        $amenities = $_POST["amenities"];
                } else {
                        $amenities = array(); // No amenities selected, initialize an empty array.
                }
                $amenities_csv = implode(",", $amenities);

                $property_id = $_POST['property_id'];
                $amenity = new Amenity('','','');
                $amenity->setConnection($connection);
                $amenity->updateAmenities($property_id, $amenities_csv);

                header("Location: view.php?property_id=" . $property_id . "#property_amenities");
                exit();
        }
        else if (isset($_POST['edit_room_amenities'])) {
                if(isset($_POST["roomAmenities"]) && is_array($_POST["roomAmenities"])){
                        $roomAmenities = $_POST["roomAmenities"];
                } else {
                        $roomAmenities = array(); // No amenities selected, initialize an empty array.
                }
                $roomAmenities_csv = implode(",", $roomAmenities);
                //var_dump($roomAmenities_csv);
                $property_id = $_POST['property_id']??null;
                $room_id = $_POST['room_id']??null;
                $roomAmenity = new RoomAmenity('','','');
                $roomAmenity->setConnection($connection);
                $roomAmenity->updateRoomAmenities($room_id ,$roomAmenities_csv);
                header("Location: view.php?property_id=" . $property_id  . "#room_amenities");
                exit();
        }
        else if (isset($_POST['delete_review'])) {
                $review_id = $_POST['review_id']??null;
                $property_id = $_POST['property_id']??null;
                $review = new Review('','','');
                $review->setConnection($connection);
                $review->deleteReview($review_id ,$property_id);
                header("Location: view.php?property_id=" . $property_id  . "#property_reviews");
                exit();
        }
        else if (isset($_POST['delete_image'])) {
                $image_id = $_POST['image_id']??null;
                $property_id = $_POST['property_id']??null;
                $image_path = $_POST['image_path']??null;
                $image = new Image();
                $image->setConnection($connection);
                $img = $image->deleteImage($image_id, $property_id);
        
                unlink($image_path);
        
                header("Location: view.php?property_id=" . $property_id . "#property_images");
                exit();
        }
                
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   