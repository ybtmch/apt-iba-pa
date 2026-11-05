<?php 
use Models\Reservation;
use Models\Notification;
use Models\Unit;
use Models\Detail;
use Models\Log;

include ("init.php");
include ("session.php");

if(isset($user_id)){
    try {
        $property_id = $_POST['property_id'];
        $landlord_id = $_POST['landlord_id'];
        $property_name = $_POST['property_name'];
        $payment_status = 1;
        $status = 1;
        $unit_data_array = $_POST['unitDataArray'];
        
        foreach($unit_data_array as $unit_data){
            $unit_id = $unit_data['unit_id'];
            $unit_count = $unit_data['unit_count'];
            $unit_type = $unit_data['unit_type'];

            function generateRandomString($length = 5) {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
        
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
        
                return $randomString;
            }
            $prop = strtoupper(substr($property_name, 0, 3));
            $randomString = generateRandomString(5);
            $reservation_number = 'APT-' . $prop . strtoupper($randomString);
    
            $reservation = new Reservation();
            $reservation->setConnection($connection);
            $reservation = $reservation->addReservation($reservation_number, $user_id, $property_id, $unit_id, $unit_count, $payment_status, $status);
    
            $unit = new Unit();
            $unit->setConnection($connection);
            $occupancy = $unit->getOccupancy($unit_id, $property_id);
            $occupied_units = intval($occupancy) + intval($unit_count);
            $reserve_unit = $unit->occupyUnit($unit_id, $property_id, $unit_count);

            $detail = new Detail();
            $detail->setConnection($connection);
            $detail = $detail->updateOccupancy($property_id, $occupied_units);

            $notification_text = 'A reservation has been made for a ' . $unit_type . ' on your property, ' . $property_name . ' by ' . $full_name;
            $notification_type = 'reservation';
            $isRead = 0;
            $notification_status = 1;
    
            $notification = new Notification();
            $notification->setConnection($connection);
            $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $notification_status);

            $log_description = $full_name . ' has made a reservation for ' . $unit_type . ' at ' . $property_name;
            $action = 'reservation';
            $log = new Log();
            $log->setConnection($connection);
            $log->addToLog($user_id, $action, $log_description);
        }
    
        echo $reservation_number;
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
    }
    
} else {
    header('location: index.php');
    exit();
}
