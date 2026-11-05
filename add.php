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
include "init.php";
include "session.php";

try {
    if(isset($_POST['apply_property']) && isset($_POST['user_id'])){
        
        $user_id = $_POST['user_id']; 
        $user = new User();
        $user->setConnection($connection);
        $user = $user->getById($user_id);

        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $contact_number = $user['contact_number'];

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
        $status = 2;

        
        //Property Amenities
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

        $lowest_rate = 0;
        $rent = $_POST['monthly_rent'];
        foreach($rent as $rate){
            if((intval($rate))>=(intval($lowest_rate))){
                $lowest_rate = $rate;
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
        
        $total = $_POST['total_rooms']; 
        $total_units = array_sum($total);
        //var_dump($total_units);
        
        $property = new Property();
        $property->setConnection($connection);
        $property_id = $property->addProperty($property_type, $property_name, $user_id, $status);
        //var_dump($property_id);
        if($property_id == NULL){
            echo "<script>alert('Failed to add basic details. Please try again');window.location.href='apply-property';</script>";
            exit();
        }
 
        $property_details = new Detail();
        $property_details->setConnection($connection);
        $property_details = $property_details->addPropertyDetails($property_id,$description,$total_floors,$total_units, $lowest_rate,$electric_bill,$water_bill,$reservation_fee,$advance_deposit,$gcash,$maya,$credit_card,$cash,$status);

        if($property_details == NULL){
            echo "<script>alert('Failed to add billing details. Please try again');window.location.href='apply-property';</script>";
            exit();
        }

        $property_location = new Location();
        $property_location->setConnection($connection);
        $property_location = $property_location->addPropertyLocation($property_id,$property_number,$street,$barangay,$city,$province,$region,$latitude,$longitude,$status);
        
        if($property_location == NULL){
            echo "<script>alert('Failed to add property location. Please try again');window.location.href='apply-property';</script>";
            exit();
        }
        
        $type_of_unit = $_POST['room_type'];
        $type = $_POST['furnished_type']; 
        $rent = $_POST['monthly_rent']; 
        $length = $_POST['length']; 
        $width = $_POST['width']; 
        $measurement = $_POST['measurement']; 
        
        $occupied_units = 0;
        
        for ($x = 0; $x < count($type_of_unit); $x++) {
            $unit_type = $type_of_unit[$x];
            $furnished_type = $type[$x];
            $monthly_rent = $rent[$x];
            $unit_total = $total[$x];
            $unit_area = $length[$x] + $measurement[$x] + ' x ' + $width[$x] + $measurement[$x];

            $unit = new Unit();
            $unit->setConnection($connection);
            $unit_id = $unit->addUnit($property_id, $unit_type, $unit_total, $occupied_units, $furnished_type, $unit_area, $monthly_rent, $status);
            
            if($unit_id == NULL){
                echo "<script>alert('Failed to add unit details. Please try again');window.location.href='apply-property';</script>";
                exit();
            }
        }

        //Property Images
        $imageData = $_FILES["images"] ?? NULL;
        $image_title = $_POST['image_title'] ?? NULL;
        $thumb = $_POST['thumbnail'];

        if(isset($imageData) && $imageData != NULL){
            for ($i = 0; $i < count($imageData['name']); $i++) {
                $imageName = $imageData['name'][$i];
                $imageTmpName = $imageData['tmp_name'][$i];
                $title = !is_null($image_title[$i]) ? $image_title[$i] : '';
                
                if(($thumb-1) == $i){
                    $thumbnail = 1;
                } else {
                    $thumbnail = 0;
                }
                
                $uploadDirectory = "resources/images/properties/";
                $targetFilePath = $uploadDirectory . basename($imageName);

                if (move_uploaded_file($imageTmpName, $targetFilePath)) {
                    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    $detected_type = exif_imagetype($targetFilePath);
            
                    if (in_array($detected_type, $allowed_types)) {
                        $image = imagecreatefromstring(file_get_contents($targetFilePath));
            
                        $imageName = pathinfo($imageName, PATHINFO_FILENAME) . '.webp';
                        $outputFilePath = $uploadDirectory . $imageName;
                        
                        imagewebp($image, $outputFilePath);
             
                        $images = new Image();
                        $images->setConnection($connection);
                        $insert = $images->addImage($property_id, $imageName, $title, $thumbnail, $status);

                        if($insert == NULL){
                            echo "<script>alert('Failed to add images. Please try again');window.location.href='apply-property';</script>";
                            exit();
                        }
                        
                        unlink($targetFilePath);
            
                    } else {
                        echo "Unsupported image format. Please upload a PNG, JPEG, or GIF.";
                    }
                } else {
                    echo "Error moving file to directory.";
                }
            }
        }

        //add to property amenities table but status=2=pending
        $property_amenities = new Amenity();
        $property_amenities->setConnection($connection);
        $property_amenities = $property_amenities->addAmenities($property_id,$aircon, $bathroom, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$security, $sink,$study_area, $tv,$wifi,$status);

        if($insert == NULL){
            echo "<script>alert('Failed to add images. Please try again');window.location.href='apply-property';</script>";
            exit();
        }

        //add to property rules table but status=2=pending
        if($_POST['curfew']==1){
            $from_curfew =$_POST['from_curfew'];
            $to_curfew =$_POST['to_curfew'];
        } elseif($_POST['curfew']==0){
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
        $time_slots = implode(", ", $_POST['time_slots']);;
        $status = 2;
        $available = new Availability();
        $available->setConnection($connection);
        $available = $available->setAvailableSlots($property_id, $time_slots, $status);

        if($available == NULL){
            echo "<script>alert('Failed to add available slots. Please try again');window.location.href='apply-property';</script>";
            exit();
        }

        $rules = new Rule();
        $rules->setConnection($connection);
        $rules = $rules->addRules($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $from_curfew, $to_curfew, $_POST['cooking'], $_POST['pets'], $_POST['visitors'], $from_visit, $to_visit, $_POST['alcohol'], $_POST['smoking'], $status);
        
        if($rules == NULL){
            echo "<script>alert('Failed to add property rules. Please try again');window.location.href='apply-property';</script>";
            exit();
        }
        
        $request = new Request();
        $request->setConnection($connection);
        $request = $request->addRequest($user_id, $property_id, $status);

        if($request == NULL){
            echo "<script>alert('Failed to apply for application. Please try again');window.location.href='apply-property';</script>";
            exit();
        }

        $admin_id = 1;
        $notification_text = 'An application has been made for the property ' . $property_name . ' by the user ' . $first_name . ' ' . $last_name;
        $notification_type = 'application';
        $isRead = 0;
        $status = 1;

        $notification = new Notification();
        $notification->setConnection($connection);
        $notification->sendNotification($admin_id, $notification_text, $notification_type, $isRead, $status);

        $notification_text = 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you';
        $notification_type = 'application';
        $isRead = 0;
        $status = 1;
        
        $notification->sendNotification($user_id, $notification_text, $notification_type, $isRead, $status);

        $log_description = $first_name . ' ' . $last_name . ' filed an application for ' . $property_name;
        $action = 'application';
        $log = new Log();
        $log->setConnection($connection);
        $log->addToLog($user_id, $action, $log_description);

        if($request){
            echo "<script>alert('You have successfully filed an application for your property.');window.location.href='index.php?apply=1';</script>";
            exit();
        } else {
            echo "<script>window.location.href='index.php?apply=2';</script>";
            exit();
        }
        
    } else {
        echo "<script>alert('Failed to add property. Please check your check your application.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}
?>
