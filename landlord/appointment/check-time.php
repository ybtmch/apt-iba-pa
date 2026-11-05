<?php
use Models\Appointment;
include ("../../init.php");
include ("../session.php");

$user_id = $_SESSION['user_id'] ?? NULL; 
$date = $_POST['date'];
$time = $_POST['time'];

$check_time = new Appointment('', '', '', '','');
$check_time->setConnection($connection);
$check_time = $check_time->getPropertyTimeAppointments($user_id, $date, $time);

$first_name = $check_time['first_name'];
$last_name = $check_time['last_name'];
$contact_number = $check_time['contact_number'];
$email = $check_time['email'];
?>


<div class="container-fluid">
                  <div class="row">
                      <div class="col h6" >Property</div>
                  </div>
                  <div class="row">
                      <div class="col"><input class="form-control" type="text" value="AA Valenzuela Dormitory" aria-label="Disabled input example" disabled readonly></div>
                  </div>
                  <div class="row  mt-4">
                      <div class="col-7 h6">First Name</div>
                      <div class="col-5 h6">Last Name</div>
                  </div>
                  <div class="row ">
                      <div class="col-7"><input class="form-control" type="text" value="<?= $first_name ?>" aria-label="Disabled input example" disabled readonly></div>
                      <div class="col-5"><input class="form-control" type="text" value="<?= $last_name ?>" aria-label="Disabled input example" disabled readonly></div>
                  </div> 
                  <div class="row mt-4">
                      <div class="col h6">Contact Number</div>
                  </div>
                  <div class="row">
                      <div class="col"><input class="form-control" type="text" value="<?= $contact_number ?>" aria-label="Disabled input example" disabled readonly></div>
                  </div>
                  <div class="row mt-4">
                      <div class="col h6">Email</div>
                  </div>
                  <div class="row">
                      <div class="col"><input class="form-control" type="text" value="<?= $email ?>" aria-label="Disabled input example" disabled readonly></div>
                  </div>