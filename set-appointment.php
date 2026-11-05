<?php
use Models\Schedule; 
use Models\Appointment; 
use Models\Property; 
use Models\User; 
use Models\Notification; 
use Models\Log; 
use Models\Chat; 
use Models\Message; 
include ("init.php");
include ("session.php");

if(!isset($user_id)){
    header('location: index.php');
    exit();
}
if(isset($_POST['set_appointment'])){
    $property_id = $_POST['property_id'];
    $user_id = $_SESSION['user_id'];
    $appointment_date = $_POST['set_date'];
    $appointment_time = $_POST['set_time'];
    $property_name = $_POST['property_name'];
    
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
    $appointment_number = 'APT-' . $prop . strtoupper($randomString);

    $formatted_date = date("F j, Y", strtotime($appointment_date));
    //var_dump($property_id, $user_id, $appointment_date, $appointment_time);

    $matchFound = false;
    $date_time = new Schedule('','','');
    $date_time->setConnection($connection);
    $date_time = $date_time->getDateTime($property_id);
    
    $check_time = $appointment_time;
    foreach($date_time as $date_item){
        $unavailable_date = $date_item['date'];
        //$check_time = $date_item['time'];
        //var_dump($unavailable_date, $check_time);
        if ($appointment_date === $unavailable_date) {
            $check_time = $date_item['time'];
            $check_time .= ', ' . $appointment_time;
            $matchFound = true;
        }
    }
    //var_dump($check_time);
    //var_dump($property_id, $user_id, $appointment_date, $check_time, $matchFound);

    $appointment = new Appointment();
    $appointment->setConnection($connection);
    $appointment->setAppointment($appointment_number, $property_id, $user_id, $appointment_date,$appointment_time, 1);

    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);
    $full_name = $user['first_name'] . ' ' . $user['last_name'];

    $property = new Property();
    $property->setConnection($connection);
    $property = $property->getPropertyDetails($property_id);
    $property_name = $property['property_name'];
    $landlord_id = $property['landlord_id'];
    $notification_text = 'An appointment has been scheduled for your property, ' . $property_name . ', on ' . $formatted_date . ' at ' . $appointment_time . ' by ' . $full_name . '. Appointment number: ' . $appointment_number;
    $notification_type = 'appointment';
    $isRead = 0;
    $status = 1;

    $notification = new Notification();
    $notification->setConnection($connection);
    $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $status);

    if ($matchFound) {
        $unavailable = new Schedule('','','');
        $unavailable->setConnection($connection);
        $unavailable->updateUnavailable($property_id, $appointment_date, $check_time);
    } else {
    //var_dump($property_id, $appointment_date, $appointment_time);
        $unavailable = new Schedule('','','');
        $unavailable->setConnection($connection);
        $unavailable->setUnavailable($property_id, $appointment_date, $check_time);
    }

    $chat = new Chat();
    $chat->setConnection($connection);
    $check = $chat->checkChat($user_id, $property_id);

    if($check!=NULL){

    }else{
        $chat->createChat($property_id, $landlord_id, $user_id, $status);
    }

    $log_description = $full_name . ' requested an appointment at ' . $property_name . 'for ' . $formatted_date . ' at ' . $appointment_time;
    $action = 'appointment';
    $log = new Log();
    $log->setConnection($connection);
    $log->addToLog($user_id, $action, $log_description);

    echo $appointment_number;
  
} elseif(isset($_POST['cancel_appointment'])){
    $appointment_id = $_POST['appointment_id'];

    $appointment = new Appointment();
    $appointment->setConnection($connection);
    $record = $appointment->getAppointment($appointment_id);
    $landlord_id = $record['landlord_id'];
    $date = $record['date'];
    $formatted_date = date("F j, Y", strtotime($date));
    $time = $record['time'];
    $cancelled = $appointment->cancelAppointment($appointment_id);

    if($cancelled){
        echo "You have cancelled your appointment.";

        $notification_text = $full_name . ' has been cancelled their appointment for your property, ' . $property_name . ', on ' . $formatted_date . ' at ' . $time . '.';
        $notification_type = 'appointment';
        $isRead = 0;
        $status = 1;

        $notification = new Notification();
        $notification->setConnection($connection);
        $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $status);
    }

    echo '<script>window.location.href="appointments";</script>';
    exit();
}
?>



