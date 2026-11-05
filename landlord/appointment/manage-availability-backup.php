<?php

// FOR USER WHEN SELECTING APPOINTMENT DATES

use Models\Schedule;
use Models\Appointment;

include ("../../init.php");
include ("../session.php");
$user_id = $_SESSION['user_id'];

$property_id = 1;
$dateTime = new Schedule('','','');
$dateTime->setConnection($connection);
$dateTime = $dateTime->getDateTime($property_id);

if(isset($_POST['set_date'])){
  $date = $_POST['date'];
  $timestamp = strtotime($date);
  $dateCheck = date("Y-m-d", $timestamp);
  //$date = date("F j, Y", strtotime($dateCheck));
  foreach($dateTime as $dateItem){
    $unavailable_date = $dateItem['date'];

    if($unavailable_date===$dateCheck){
      $timeList = $dateItem['time'];
      $unavailable_time = explode(", ", $timeList);
    }
  }
} else {
  //$date = date("F j, Y");
  $unavailable_time = [];
  //$not_empty = empty($unavailable_time);
  //var_dump($not_empty);
}

$time_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 NN","12:30 PM","01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

if(isset($_POST['set_unavailable'])){
  $property_id = 1;//change when session is applied
  $getDate = $_POST['date'];
  $timestamp = strtotime($getDate);
  $date = date("Y-m-d", $timestamp);
  // $dateTime = new DateTime($date);
  // $convertedDate = $dateTime->format("Y-m-d");
  $time = implode(", ", $_POST['time_slots']);


  //var_dump($convertedDate);
  //$date = date("Y-m-d", strtotime($_POST['date']));
  $matchFound = false;

  foreach($dateTime as $dateItem){
    $unavailable_date = $dateItem['date'];
    
      if ($date === $unavailable_date) {
        $matchFound = true;
        break;
    }
  }

  if ($matchFound) {
    var_dump($property_id, $date, $time);
    $unavailable = new Schedule('','','');
    $unavailable->setConnection($connection);
    $unavailable->updateUnavailable($property_id, $date, $time);
    echo "<script>window.location.href='index.php?success=1';</script>";
    exit();
  } else {
    $unavailable = new Schedule($date, $time, $property_id);
    $unavailable->setConnection($connection);
    $unavailable->setUnavailable();
    echo "<script>window.location.href='index.php?success=1';</script>";
    exit();
  }

  //var_dump($unavailable_dates);
  
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<nav>
  <ul class="nav nav-pills nav-justified">
    <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="../property/index.php">Properties</a></li>
    <li class="active" style="background-color: #FFFAF0"><a  href="index.php">Appointments</a></li>
    <li style="background-color: #FFFACD"><a  href="../reservation/index.php">Reservations</a></li>
    <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
  </ul>
  <a href="../../logout.php">Logout</a>
  </nav>
  <!-- Your HTML content -->
  <h1>Content for Selected Date:<?php echo isset($date) ? $date : ''; ?></h1>
  <div id="contentContainer">
    <p>Select a date on the calendar to see the content for that day.</p>
  </div>
  <form action="add.php" method="POST" id="check_time">
  <!-- Calendar input field -->
  <input type="text" id="datepicker" value="<?= isset($date) ? $date : '' ?>" placeholder="<?= isset($date) ? $date : '' ?>" required>
    <input type="hidden" name="date" id="date" value="<?= isset($date) ? $date : '' ?>">
    <!-- Button to trigger AJAX request -->
    <button id="fetchButton" name="set_date" type="submit">Select this date</button>
  </form>

  <form action="add.php" method="POST" id="appointment-form">
  <input type="hidden" name="date" id="date" value="<?= isset($date) ? $date : '' ?>">

      <?php 
      if(!isset($date)) { 
        $disabled = 'disabled';
      }
      foreach($time_slots as $slots){
              if(!empty($unavailable_time)){
                $unavailable = in_array($slots, $unavailable_time);
              } else {
                $unavailable = false;
              }
              
      ?>
      <input type="checkbox" id="check" name="time_slots[]" value="<?=$slots?>" <?php echo isset($disabled) ? $disabled : ''; echo $unavailable ? 'checked' : '' ?> ><?=$slots?><br>
      <?php } ?>

    <!-- ^onclick="terms_changed(this)" <button id="setAppointment" name="set_appointment" type="submit" disabled="true">Set as unavailable</button> -->
    <?php if(isset($date)) { 
      //$not_empty = !empty($unavailable_time);
      //var_dump($not_empty);
      ?>
    <input id="setUnavailable" name="set_unavailable" type="submit" <?php echo empty($unavailable_time) ? 'disabled="true"' : ''?> value="Mark as unavailable"></input>
    <?php } else {?>
    <input name="set_unavailable" type="submit" disabled="true" value="Mark as unavailable"></input>
    <?php } ?>
  </form>

  <!-- JavaScript code -->
  <script>
    // $('#check').change(function () {
    //   $('#setAppointment').prop("disabled", !this.checked);
    // }).change()
    function terms_changed(termsCheckBox){
    //If the checkbox has been checked
    // if(termsCheckBox.checked){
    //     //Set the disabled property to FALSE and enable the button.
    //     document.getElementById("setUnavailable").disabled = false;
    // } else{
    //     //Otherwise, disable the submit button.
    //     document.getElementById("setUnavailable").disabled = true;
    // }
    }
    let check = document.getElementById('check');
      check.addEventListener('change', function () {
         
         if (check.checked) {
          document.getElementById("setUnavailable").disabled = false;
         } else {
          document.getElementById("setUnavailable").disabled = true;
         }
      })
    
    // Array of dates to be disabled
    // var currentDate = new Date().toISOString().split('T')[0];
    // Function to handle the fetch button click event
    
    // Add an event listener to the button to fetch content
    $("#fetchButton").on("click", handleFetchButtonClick);

    function handleFetchButtonClick() {
      var selectedDate = $("#datepicker").val(); 
      var inputElement = document.getElementById("date");
      inputElement.value = selectedDate;
    }

    // Initialize the datepicker with the beforeShowDay option
    $(document).ready(function() {
      var currentDate = new Date();
      var localDate = currentDate.toLocaleDateString('en-PH', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });

      $("#datepicker").datepicker({
        dateFormat: "MM d, yy",
        minDate: localDate,
      });
    });
  </script>
  
</body>

  
  
</html>


