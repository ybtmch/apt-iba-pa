<?php
use Models\Availability;
use Models\Appointment;
use Models\Schedule;
include ("../init.php");
include ("session.php");
$landlord_id = $_SESSION['user_id'];

if(isset($_POST['disable_time'])){
    $property_id = $_POST['property_id'];
    $time_slots = $_POST['time_slots'];
    $date = $_POST['date'];
    $inputDate = DateTime::createFromFormat('j F, Y', $date);
    $outputDateString = $inputDate->format('Y-m-d');
    // print_r($outputDateString);
    $update = new Schedule('','','');
    $update->setConnection($connection);
    $check_dates = $update->getDates($property_id);
    $matchFound = false;
    if($check_dates){
        foreach($check_dates as $check_date){
            if($outputDateString === $check_date['date']){
                $matchFound = true;
                break;
            }
        }
    }

    if($matchFound){
        $update = $update->updateUnavailable($property_id, $outputDateString, $time_slots);
    } else {
        $update = $update->setUnavailable($property_id, $outputDateString, $time_slots);
    }

    return $update;

}