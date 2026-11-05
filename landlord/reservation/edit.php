<?php 
include "../../init.php";
use Models\Reservation;
use Models\Notification;

try {
    if(isset($_POST['confirm_reservation'])){
        $reservation_id = $_POST['reservation_id'];
        $user_id = $_POST['user_id'];
        $room_type = $_POST['room_type'];
        $property_name = $_POST['property_name'];

        $reservation = new Reservation('','','','','');
        $reservation->setConnection($connection);
        $reservation = $reservation->acceptReservation($reservation_id);
        
        if($reservation){
            $notification_text = 'Your reservation for a ' . $room_type . ' at ' . $property_name . ' has been confirmed.';
            $notification_type = 'reservation';
            $isRead = 0;
            $status = 1;

            $notification = new Notification();
            $notification->setConnection($connection);
            $notification->sendNotification($user_id, $notification_text, $notification_type, $isRead, $status);

            $result = 'success_confirm';
        } else {
            $result = 'failed_confirm';
        }

        // Redirect with a query parameter
        header("Location: index.php?result=$result");
        exit();
    } 
    
    elseif (isset($_POST['decline_reservation'])){
        $reservation_id = $_POST['reservation_id'];
        $landlord_id = $_POST['user_id'];
        $room_type = $_POST['room_type'];
        $property_name = $_POST['property_name'];

        $reservation = new Reservation('','','','','');
        $reservation->setConnection($connection);
        $reservation = $reservation->declineReservation($reservation_id);
        
        $notification_text = 'Your reservation for a ' . $room_type . ' at ' . $property_name . ' has been declined.';
        $notification_type = 'reservation';
        $isRead = 0;
        $status = 1;

        $notification = new Notification();
        $notification->setConnection($connection);
        $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $status);

        // Determine the result and set a message
        $result = ($reservation) ? 'success_confirm' : 'failed_confirm';

        // Redirect with a query parameter
        header("Location: index.php?result=$result");
        exit();        
    }
} 

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   