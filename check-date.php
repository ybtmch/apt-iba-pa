<?php 
use Models\Schedule; 
use Models\Appointment; 
use Models\Availability;
include ("init.php");
include ("session.php");

$property_id = $_POST['property_id'];
$landlord_id = $_POST['landlord_id'];
$date_time = new Schedule('','','');
$date_time->setConnection($connection);
$date_time = $date_time->getDateTime($property_id);

$available_slots = new Availability();
$available_slots->setConnection($connection);
$available_slots = $available_slots->getAvailableSlots($landlord_id, $property_id);
$time_slots = $available_slots['time_slots'];


$time_slots_array = explode(', ', $time_slots);

$morning_slots = [];
$afternoon_slots = [];
$evening_slots = [];

foreach ($time_slots_array as $time) {
    $time_parts = explode(' ', $time);
    $time_value = str_replace([':'], '', $time_parts[0]); // Remove colon from time

    if ($time_parts[1] === 'AM') {
        if ($time_value >= '600' && $time_value <= '1130') {
            $morning_slots[] = $time;
        }
    } elseif ($time_parts[1] === 'PM') {
        if ($time_value >= '100' && $time_value <= '530') {
            $afternoon_slots[] = $time;
        } elseif ($time_value >= '600' && $time_value <= '800') {
            $evening_slots[] = $time;
        }
    }
}

if(isset($_POST['set_date'])){
    
    $set_date = $_POST['set_date'];

    $unavailable_time = [];
    foreach($date_time as $dates){
        $date = $dates['date'];
        
        if($date===$set_date){
            $time_date = $dates['time'];       
            $unavailable_time = explode(", ", $time_date);
        } 
    }

    //var_dump($unavailable_time);
    
    $unavailable_morning = [];
    $unavailable_afternoon = [];
    $unavailable_evening = [];
// var_dump($unavailable_time);

    foreach ($unavailable_time as $time_slot) {
        $time_parts = explode(" ", $time_slot);
        $time_value = str_replace([':'], '', $time_parts[0]); // Remove colon from time

        if ($time_parts[1] === 'AM') {
            if ($time_value >= '600' && $time_value <= '1130') {
                $unavailable_morning[] = $time_slot;
            }
        } elseif ($time_parts[1] === 'PM') {
            if ($time_value >= '100' && $time_value <= '530') {
                $unavailable_afternoon[] = $time_slot;
            } elseif ($time_value >= '600' && $time_value <= '800') {
                $unavailable_evening[] = $time_slot;
            }
        }
    }
} 

?>
<?php if(count($morning_slots)>0) { ?>
<div class="row ps-4 h3 mt-2">
    <h2 class="dayzone">
    <img src="resources/images/dayzone1.png" alt=""/>
    Morning
    </h2>
    <h2 class="timezone">8:00 AM to 11:30 AM</h2>
</div>

<?php
//$morning_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM");

$passed_time_slots = [];
date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");
$current_time = date("g:i A");

if($set_date === $current_date){
    usort($morning_slots, function ($a, $b) {
        $time_a = strtotime($a);
        $time_b = strtotime($b);
        return $time_a - $time_b;
    });
    
    // Find the time slots that have already passed
    $passed_time_slots = array_filter($morning_slots, function ($time_slot) use ($current_time) {
        return strtotime($time_slot) < strtotime($current_time);
    });
}

$row_count = 0;
$col_count = 0;

echo '<div class="row pt-5 justify-content-center">';
foreach ($morning_slots as $time_slot) {
if ($col_count == 4) {
    echo '</div><div class="row pt-5 justify-content-center">';
    $col_count = 0;
}

if(in_array($time_slot, $unavailable_morning) || in_array($time_slot, $passed_time_slots)){
    $unavailable = '<button class="btnDisabled" disabled>';
    $unavailable_radio = 'disabled';
  } else {
    $unavailable = '';
    $unavailable_radio = '';
  }

echo '<div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
 ' . $unavailable . '                       
<label class="radio w-100 justify-content-center d-flex">
  <input type="radio" ' . $unavailable_radio . ' name="time_slot" id="time_slot" value="' . $time_slot . '" required/>

  <div class="row justify-content-between radioVisitTime align-items-center"
    id="pickVisitTime">

    <div class="col-12">
      <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i>' . $time_slot . '</span>
    </div>

  </div>
</label>
</div>';
$col_count++;
}
echo '</div>';

?>
<?php } if(count($afternoon_slots)>0) { ?>
<div class="row ps-4 h3 mt-5">
    <hr>
    <h2 class="dayzone pt-4">
    <img src="resources/images/dayzone2.png" alt=""/>
    Afternoon
    </h2>
    <h2 class="timezone">1:00 PM to 5:30 PM</h2>
</div>
    
<?php
//$afternoon_slots = array("01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

$passed_time_slots = [];
date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");
$current_time = date("g:i A");

if($set_date === $current_date){
    usort($afternoon_slots, function ($a, $b) {
        $time_a = strtotime($a);
        $time_b = strtotime($b);
        return $time_a - $time_b;
    });
    
    // Find the time slots that have already passed
    $passed_time_slots = array_filter($afternoon_slots, function ($time_slot) use ($current_time) {
        return strtotime($time_slot) < strtotime($current_time);
    });
}

$row_count = 0;
$col_count = 0;

echo '<div class="row pt-5 justify-content-center">';
foreach ($afternoon_slots as $time_slot) {
if ($col_count == 4) {
    echo '</div><div class="row pt-5 justify-content-center">';
    $col_count = 0;
}

if(in_array($time_slot, $unavailable_afternoon)){
    $unavailable = '<button class="btnDisabled" disabled>';
    $unavailable_radio = 'disabled';
  } else {
    $unavailable = '';
    $unavailable_radio = '';
  }
  
echo '<div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
' . $unavailable . '                          
<label class="radio w-100 justify-content-center d-flex">
  <input type="radio" name="time_slot" id="time_slot" value="' . $time_slot . '" required/>

  <div class="row justify-content-between radioVisitTime align-items-center"
    id="pickVisitTime">

    <div class="col-12">
      <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i>' . $time_slot . '</span>
    </div>

  </div>
</label>
</div>';
$col_count++;
}
echo '</div>';
?>

<?php } if(count($evening_slots)>0) { ?>

<div class="row ps-4 h3 mt-5">
    <hr>
    <h2 class="dayzone pt-4">
    <img src="resources/images/dayzone3.png" alt=""/>
    Afternoon
    </h2>
    <h2 class="timezone">1:00 PM to 5:30 PM</h2>
</div>
    
<?php

$passed_time_slots = [];
date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");
$current_time = date("g:i A");

if($set_date === $current_date){
    usort($evening_slots, function ($a, $b) {
        $time_a = strtotime($a);
        $time_b = strtotime($b);
        return $time_a - $time_b;
    });
    
    // Find the time slots that have already passed
    $passed_time_slots = array_filter($evening_slots, function ($time_slot) use ($current_time) {
        return strtotime($time_slot) < strtotime($current_time);
    });
}

$row_count = 0;
$col_count = 0;

echo '<div class="row pt-5 justify-content-center">';
foreach ($evening_slots as $time_slot) {
if ($col_count == 4) {
    echo '</div><div class="row pt-5 justify-content-center">';
    $col_count = 0;
}

if(in_array($time_slot, $unavailable_evening)){
    $unavailable = '<button class="btnDisabled" disabled>';
    $unavailable_radio = 'disabled';
  } else {
    $unavailable = '';
    $unavailable_radio = '';
  }
  
echo '<div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
' . $unavailable . '                          
<label class="radio w-100 justify-content-center d-flex">
  <input type="radio" name="time_slot" id="time_slot" value="' . $time_slot . '" required/>

  <div class="row justify-content-between radioVisitTime align-items-center"
    id="pickVisitTime">

    <div class="col-12">
      <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i>' . $time_slot . '</span>
    </div>

  </div>
</label>
</div>';
$col_count++;
}
echo '</div>';
?>
<?php } ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const confirmDetailsModal = document.getElementById('btnConfirm');
    const timeRadioButtons = document.querySelectorAll('input[name="time_slot"]');
    btnConfirm.disabled = true;

    timeRadioButtons.forEach(timeRadioButton => {
        timeRadioButton.addEventListener('change', function() {
        // Check if any radio button is checked
        const isChecked = [...timeRadioButtons].some(radio => radio.checked);
        
        // Enable or disable the confirm button based on the checked status
        btnConfirm.disabled = !isChecked;
        });
    });</script>