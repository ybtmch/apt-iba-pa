<?php
use models\Reservation;
use models\Notification;
use models\Log;
include('../init.php');
include('session.php');

if(isset($_POST['confirm_reservation'])){
    $reservation_id = $_POST['reservation_id'];

    $reservation = new Reservation();
    $reservation->setConnection($connection);
    $reserve = $reservation->getReservation($reservation_id);
    $reserve_user_id = $reserve['user_id'];
    $property_name = $reserve['property_name'];
    $no_of_units = $reserve['no_of_units'];
    $unit_type = $reserve['unit_type'];
    $reservation = $reservation->confirmReservation($reservation_id);

    $notification_text = "Your reservation for " . $no_of_units . ' ' . $unit_type . ' on ' . $property_name . ' has been confirmed. You are now cleared to move in within 2 weeks from now.';
    $notification_type = "reservation";
    $isRead = 2;
    $status = 1;

    $notification = new Notification();
    $notification->setConnection($connection);
    $notification = $notification->sendNotification($reserve_user_id, $notification_text, $notification_type, $isRead, $status);

    $log_description = "Reservation for " . $property_name . " has been confirmed.";
    $action = "reservation";

    $log = new Log();
    $log->setConnection($connection);
    $log->addToLog($reserve_user_id, $action, $log_description);

}


?>