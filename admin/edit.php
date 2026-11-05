<?php

use Models\Property;
use Models\Detail;
use Models\Location;
use Models\Amenity;
use Models\Rule;
use Models\Unit;
use Models\Request;
use Models\User;
use Models\Auth;
use Models\Image;
use Models\UserImage;
use Models\Notification;
use Models\Availability;
use Models\Log;
include "../init.php";
include "session.php";

try {
    if(isset($_POST['save_property']) && isset($_POST['user_id'])){
        
        $user_id = $_POST['user_id']; 
        $user = new User();
        $user->setConnection($connection);
        $user = $user->getById($user_id);

        if(isset($_POST['property_id'])){
            $property_id = $_POST['property_id'];
            $check_property = new Property();
            $check_property->setConnection($connection);
            $check = $check_property->getLandlordProperty($property_id, $user_id);

            if($check){
                $property_id = $_POST['property_id'];
            } else{
                echo "<script>window.location.href='index.php';</script>";
                exit();
            };
        } else {
            echo "<script>window.location.href='index.php';</script>";
            exit();
        }
        //Basic Details
        $property_name = ucfirst($_POST['property_name']); 
        $property_type = $_POST['property_type']; 
        $description = $_POST['description'];
        $total_floors = intval($_POST['total_floors']);

        //Property Location
        $property_number = $_POST['property_number'];
        $street = ucfirst($_POST['street']);
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $region = $_POST['region'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $status = 1;

        
        //Property Amenities
        $amenity_id = $_POST['amenity_id'];
        $aircon = $_POST['aircon'] ?? 0;
        $bathroom = $_POST['bathroom'] ?? 0;
        $cabinet = $_POST['cabinet'] ?? 0;
        $cctv = $_POST['cctv'] ?? 0;
        $drinking_water = $_POST['drinking_water'] ?? 0;
        $elevator = $_POST['elevator'] ?? 0;
        $emergency_exit = $_POST['emergency_exit'] ?? 0;
        $food_hall = $_POST['food_hall'] ?? 0;
        $laundry = $_POST['laundry'] ?? 0;
        $lounge = $_POST['lounge'] ?? 0;
        $microwave = $_POST['microwave'] ?? 0;
        $parking = $_POST['parking'] ?? 0;
        $refrigerator = $_POST['refrigerator'] ?? 0;
        $security = $_POST['security'] ?? 0;
        $sink = $_POST['sink'] ?? 0;
        $study_area = $_POST['study_area'] ?? 0;
        $tv = $_POST['tv'] ?? 0;
        $wifi = $_POST['wifi'] ?? 0;

        //Billing Details
        $reservation_fee = $_POST['reservation_fee'];
        $advance_deposit = $_POST['advance_deposit'];

        if($_POST['water_bill_check'] == 1){
            $water_bill = $_POST['water_bill'];
        } else{
            $water_bill = NULL;
        }

        if($_POST['electric_bill_check'] == 1){
            $electric_bill = $_POST['electric_bill'];
        } else{
            $electric_bill = NULL;
        }

        $lowest_rate = $_POST['lowest_rate'];
        
        if(isset($_POST['monthly_rent'])){
            $rent = $_POST['monthly_rent'] ?? 0;
            foreach($rent as $rate){
                if((intval($rate))>=(intval($lowest_rate))){
                    $lowest_rate = $rate;
                }
            }
        }
        
        if(isset($_POST['gcash'])){
            // $gcash = $_POST['gcash_account'];

            // $imageName1 = $gcash_upload['name'];
            // $imageTmpName1 = $gcash_upload['tmp_name'];
            // $uploadDirectory1 = "resources/images/payments/";
            // $targetFilePath1 = $uploadDirectory1 . basename($imageName1);
            // move_uploaded_file($imageTmpName1, $targetFilePath1);
            //$gcash = $imageName1;

            $gcash = 'Yes';
        } else {
            $gcash = NULL;
        }

        if(isset($_POST['maya'])){
            // $maya = $_POST['maya_account'];

            // $maya_upload = $_FILES['maya_upload'];
            // $imageName2 = $maya_upload['name'];
            // $imageTmpName2 = $maya_upload['tmp_name'];
            // $uploadDirectory2 = "resources/images/payments/";
            // $targetFilePath2 = $uploadDirectory2 . basename($imageName2);
            // move_uploaded_file($imageTmpName2, $targetFilePath2);
            // $maya = $imageName2;
            $maya = 'Yes';
        } else {
            $maya = NULL;
        }
        
        if(isset($_POST['credit_card'])){
            $credit_card = $_POST['credit_card_number'];
        } else {
            $credit_card = NULL;
        }

        if(isset($_POST['cash'])){
            $cash = $_POST['cash'];
        } else {
            $cash = 0;
        }
        
        if(isset($_POST['total_rooms'])){
            $new_total_units = $_POST['total_rooms'];
            $new_total = is_array($_POST['total_rooms']) ? array_sum($_POST['total_rooms']) : $_POST['total_rooms'];
        } else {
            $new_total = 0;
        }

        if(isset($_POST['old_total_units'])){
            $old_total_units = $_POST['old_total_units'];
            $old_total = is_array($old_total_units) ? array_sum($old_total_units) : $old_total_units;
        } else {
            $old_total = 0;
        }

        $property_total_units = $new_total + $old_total;
        //var_dump($property_total_units);
        
        $property = new Property();
        $property->setConnection($connection);
        $property->updateProperty($property_id, $property_type, $property_name, $user_id, $status);
 
        $property_details = new Detail();
        $property_details->setConnection($connection);
        $property_details = $property_details->updatePropertyDetails($property_id,$description,$total_floors,$property_total_units, $lowest_rate,$electric_bill,$water_bill,$reservation_fee,$advance_deposit,$gcash,$maya,$credit_card,$cash,$status);


        $property_location = new Location();
        $property_location->setConnection($connection);
        $property_location->updatePropertyLocation($property_id,$property_number,$street,$barangay,$city,$province,$region,$latitude,$longitude,$status);
        
        //Unit Details
        $old_unit_id = $_POST['old_unit_id'];
        $old_type_of_unit = $_POST['old_room_type'];
        $old_type = $_POST['old_furnished_type']; 
        $old_rent = $_POST['old_monthly_rent']; 
        $old_occupied = $_POST['occupied_units']; 
        if(is_array($old_unit_id)){
            for ($x = 0; $x < count($old_unit_id); $x++) {
                $unit_id = $old_unit_id[$x];
                $unit_type = $old_type_of_unit[$x];
                $furnished_type = $old_type[$x];
                $monthly_rent = $old_rent[$x];
                $unit_total = $old_total_units[$x];
                $occupancy = $old_occupied[$x];
                $unit = new Unit();
                $unit->setConnection($connection);
                $unit->updateUnit($unit_id, $unit_type, $unit_total, $occupancy, $furnished_type, $monthly_rent, $property_id);
                
            }
        } 
        if(isset($_POST['room_type'])){
            $type_of_unit = $_POST['room_type'];
                $type = $_POST['furnished_type']; 
                $rent = $_POST['monthly_rent']; 
                
                $occupied_units = 0;
                
                for ($x = 0; $x < count($type_of_unit); $x++) {
                    $unit_type = $type_of_unit[$x];
                    $furnished_type = $type[$x];
                    $monthly_rent = $rent[$x];
                    $unit_total = $new_total_units[$x];

                    $unit = new Unit();
                    $unit->setConnection($connection);
                    $unit_id = $unit->addUnit($property_id, $unit_type, $unit_total, $occupied_units, $furnished_type, $monthly_rent, $status);
                    
                }
        }
        

        //Property Images
        $imageData = $_FILES["images"] ?? NULL;
        $image_title = $_POST['image_title'] ?? NULL;
        $thumbnails = $_POST['thumbnail'] ?? NULL;

        if(isset($imageData) && $imageData != NULL && $image_title != NULL){
            for ($i = 0; $i < count($imageData['name']); $i++) {
                $imageName = $imageData['name'][$i];
                $imageTmpName = $imageData['tmp_name'][$i];
                $title = $image_title[$i];
                if($i===($thumbnails[$i]-1)){
                    $thumbnail = 1;
                } else {
                    $thumbnail = 0;
                }
                
                $uploadDirectory = "resources/images/properties/";
                $targetFilePath = $uploadDirectory . basename($imageName);
                move_uploaded_file($imageTmpName, $targetFilePath);
            
                $images = new Image();
                $images->setConnection($connection);
                $insert = $images->addImage($property_id, $imageName, $title, $thumbnail, $status);
                
            }
        }

        $property_amenities = new Amenity();
        $property_amenities->setConnection($connection);
        $property_amenities->updateAmenities($amenity_id, $property_id,$aircon, $bathroom, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$security, $sink,$study_area, $tv,$wifi,$status);

        if($_POST['curfew']==1){
            $from_curfew =$_POST['from_curfew'];
            $to_curfew =$_POST['to_curfew'];
        } elseif($_POST['curfew']==2){
            $from_curfew = NULL;
            $to_curfew = NULL;
        }

        if($_POST['visitors']==1){
            $from_visit = $_POST['from_visit'];
            $to_visit =$_POST['to_visit'];
        } elseif($_POST['visitors']==0){
            $from_visit = NULL;
            $to_visit = NULL;
        }

        //Time Slots
        $time_slots = implode(", ", $_POST['time_slots']);
        $status = 2;
        $available = new Availability();
        $available->setConnection($connection);
        $available->updateAvailableSlots($property_id, $time_slots, $status);
        

        $rules = new Rule();
        $rules->setConnection($connection);
        $rules->updateRules($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $from_curfew, $to_curfew, $_POST['cooking'], $_POST['pets'], $_POST['visitors'], $from_visit, $to_visit, $_POST['alcohol'], $_POST['smoking']);
        

        $admin_id = 1;
        $notification_text = 'An update has been made for the property ' . $property_name . ' by the user ' . $first_name . ' ' . $last_name;
        $notification_type = 'update';
        $isRead = 0;
        $status = 1;

        $notification = new Notification();
        $notification->setConnection($connection);
        $notification->sendNotification($admin_id, $notification_text, $notification_type, $isRead, $status);

        $log_description = $first_name . ' ' . $last_name . ' has updated their property, ' . $property_name;
        $action = 'property update';
        $log = new Log();
        $log->setConnection($connection);
        $log->addToLog($user_id, $action, $log_description);

        echo "<script>window.location.href='properties';</script>";
        exit();
       
        
    } else {
        echo "<script>alert('Failed to update property. Please check your check the details you have entered.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}
?>
