<?php
use models\Appointment;
use models\Notification;
use models\Log;
include('../init.php');
include('session.php');

if(isset($_POST['decline_appointment'])){
    $appointment_id = $_POST['appointment_id'];

    $appointment = new Appointment();
    $appointment->setConnection($connection);
    $appt = $appointment->getAppointment($appointment_id);
    $appt_user_id = $appt['user_id'];
    $property_name = $appt['property_name'];
    $appointment = $appointment->declineAppointment($appointment_id);

    $notification_text = "Your appointment for a visit on " . $property_name . " has been declined. You may request for another appointment or contact the landlord for any inquiry.";
    $notification_type = "appointment";
    $isRead = 2;
    $status = 1;

    $notification = new Notification();
    $notification->setConnection($connection);
    $notification = $notification->sendNotification($appt_user_id, $notification_text, $notification_type, $isRead, $status);

    $log_description = "Appointment for " . $property_name . " has been declined.";
    $action = "appointment";

    $log = new Log();
    $log->setConnection($connection);
    $log->addToLog($appt_user_id, $action, $log_description);

}


?>