<?php
use Models\Appointment;
include ("../init.php");
include ("session.php");

$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$time = $_POST['time'];

$check_time = new Appointment();
$check_time->setConnection($connection);
$check_time = $check_time->getPropertyTimeAppointments($user_id, $date, $time);
$property_name = $check_time['property_name'];
$first_name = $check_time['first_name'];
$last_name = $check_time['last_name'];
$contact_number = $check_time['contact_number'];
$email = $check_time['email'];
$image_name = $check_time['image_name'] ?? 'male-logo.png';
$appointment_number = $check_time['appointment_number'];
?>


<div class="container-fluid">
    <div class="row">
        <div class="col h6" >Property</div>
    </div>
    <div class="row">
        <div class="col"><input class="form-control" type="text" value="<?= $property_name ?>" aria-label="Disabled input example" disabled readonly></div>
    </div>
    <div class="row  mt-4">
        <div class="col-7 h6">Name</div>
        <div class="col-5 h6"></div>
    </div>
    <div class="row ">
        <div class="col-7">
            <input class="form-control" type="text" value="<?= $first_name . ' ' . $last_name?>" aria-label="Disabled input example" disabled readonly><br>
            <div class="h6">Contact Number</div>
            <input class="form-control" type="text" value="<?= $contact_number ?>" aria-label="Disabled input example" disabled readonly><br>
            <div class="h6">Email</div>
            <input class="form-control" type="text" value="<?= $email ?>" aria-label="Disabled input example" disabled readonly>
        </div>

        <div class="col-5">
            <img class="img-account-profile mb-2" id="profileImage" src="../resources/images/users/<?= $image_name ?>" style="height: 100%; width: 100%;" alt="">
        </div>
    </div> 
    <div class="row mt-4">
        <div class="col h6">Appointment Number</div>
    </div>
    <div class="row">
        <div class="col">
            <input class="form-control" type="text" value="<?= $appointment_number ?>" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>
</div>