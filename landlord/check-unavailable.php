<?php
use Models\Availability;
use Models\Appointment;
use Models\Schedule;
include ("../init.php");
include ("session.php");

$landlord_id = $_SESSION['user_id'];

if(isset($_POST['set_date'], $_POST['property_id'])){
    $property_id = $_POST['property_id'];
    $date = $_POST['set_date'];
    $inputDate = DateTime::createFromFormat('j F, Y', $date);
    $outputDateString = $inputDate->format('Y-m-d');

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

    if(isset($_POST['disable_time'])){
        $timeList = $_POST['time_slots'];
        $unavailable_time = explode(", ", $timeList);
    } else {
        $unavailable_slots = new Schedule('','','');
        $unavailable_slots->setConnection($connection);
        $unavailable_slots = $unavailable_slots->getDateTime($property_id);
        $unavailable_time = array();
        foreach($unavailable_slots as $slots){
            $unavailable_date = $slots['date'];
            if($unavailable_date === $outputDateString){
                $timeList = $slots['time'];
                $unavailable_time = explode(", ", $timeList);
            } 
        }
    }
    

    $six_am = !in_array('6:00 AM', $time_slots_array) ? 'disabled' : '';
    $six30_am = !in_array('6:30 AM', $time_slots_array)  ? 'disabled' : '';
    $seven_am = !in_array('7:00 AM', $time_slots_array)  ? 'disabled' : '';
    $seven30_am = !in_array('7:30 AM', $time_slots_array)  ? 'disabled' : '';
    $eight_am = !in_array('8:00 AM', $time_slots_array)  ? 'disabled' : '';
    $eight30_am = !in_array('8:30 AM', $time_slots_array)  ? 'disabled' : '';
    $nine_am = !in_array('9:00 AM', $time_slots_array)  ? 'disabled' : '';
    $nine30_am = !in_array('9:30 AM', $time_slots_array)  ? 'disabled' : '';
    $ten_am = !in_array('10:00 AM', $time_slots_array)  ? 'disabled' : '';
    $ten30_am = !in_array('10:30 AM', $time_slots_array)  ? 'disabled' : '';
    $eleven_am = !in_array('11:00 AM', $time_slots_array)  ? 'disabled' : '';
    $eleven30_am = !in_array('11:30 AM', $time_slots_array)  ? 'disabled' : '';
    $twelve_pm = !in_array('12:00 PM', $time_slots_array)  ? 'disabled' : '';
    $twelve30_pm = !in_array('12:30 PM', $time_slots_array)  ? 'disabled' : '';
    $one_pm = !in_array('1:00 PM', $time_slots_array)  ? 'disabled' : '';
    $one30_pm = !in_array('1:30 PM', $time_slots_array)  ? 'disabled' : '';
    $two_pm = !in_array('2:00 PM', $time_slots_array)  ? 'disabled' : '';
    $two30_pm = !in_array('2:30 PM', $time_slots_array)  ? 'disabled' : '';
    $three_pm = !in_array('3:00 PM', $time_slots_array)  ? 'disabled' : '';
    $three30_pm = !in_array('3:30 PM', $time_slots_array)  ? 'disabled' : '';
    $four_pm = !in_array('4:00 PM', $time_slots_array)  ? 'disabled' : '';
    $four30_pm = !in_array('4:30 PM', $time_slots_array)  ? 'disabled' : '';
    $five_pm = !in_array('5:00 PM', $time_slots_array)  ? 'disabled' : '';
    $five30_pm = !in_array('5:30 PM', $time_slots_array)  ? 'disabled' : '';
    $six_pm = !in_array('6:00 PM', $time_slots_array)  ? 'disabled' : '';
    $six30_pm = !in_array('6:30 PM', $time_slots_array)  ? 'disabled' : '';
    $seven_pm = !in_array('7:00 PM', $time_slots_array)  ? 'disabled' : '';
    $seven30_pm = !in_array('7:30 PM', $time_slots_array)  ? 'disabled' : '';
    $eight_pm = !in_array('8:00 PM', $time_slots_array)  ? 'disabled' : '';

    $six_am2 = in_array('6:00 AM', $unavailable_time) ? 'checked' : '';
    $six30_am2 = in_array('6:30 AM', $unavailable_time)  ? 'checked' : '';
    $seven_am2 = in_array('7:00 AM', $unavailable_time)  ? 'checked' : '';
    $seven30_am2 = in_array('7:30 AM', $unavailable_time)  ? 'checked' : '';
    $eight_am2 = in_array('8:00 AM', $unavailable_time)  ? 'checked' : '';
    $eight30_am2 = in_array('8:30 AM', $unavailable_time)  ? 'checked' : '';
    $nine_am2 = in_array('9:00 AM', $unavailable_time)  ? 'checked' : '';
    $nine30_am2 = in_array('9:30 AM', $unavailable_time)  ? 'checked' : '';
    $ten_am2 = in_array('10:00 AM', $unavailable_time)  ? 'checked' : '';
    $ten30_am2 = in_array('10:30 AM', $unavailable_time)  ? 'checked' : '';
    $eleven_am2 = in_array('11:00 AM', $unavailable_time)  ? 'checked' : '';
    $eleven30_am2 = in_array('11:30 AM', $unavailable_time)  ? 'checked' : '';
    $twelve_pm2 = in_array('12:00 PM', $unavailable_time)  ? 'checked' : '';
    $twelve30_pm2 = in_array('12:30 PM', $unavailable_time)  ? 'checked' : '';
    $one_pm2 = in_array('1:00 PM', $unavailable_time)  ? 'checked' : '';
    $one30_pm2 = in_array('1:30 PM', $unavailable_time)  ? 'checked' : '';
    $two_pm2 = in_array('2:00 PM', $unavailable_time)  ? 'checked' : '';
    $two30_pm2 = in_array('2:30 PM', $unavailable_time)  ? 'checked' : '';
    $three_pm2 = in_array('3:00 PM', $unavailable_time)  ? 'checked' : '';
    $three30_pm2 = in_array('3:30 PM', $unavailable_time)  ? 'checked' : '';
    $four_pm2 = in_array('4:00 PM', $unavailable_time)  ? 'checked' : '';
    $four30_pm2 = in_array('4:30 PM', $unavailable_time)  ? 'checked' : '';
    $five_pm2 = in_array('5:00 PM', $unavailable_time)  ? 'checked' : '';
    $five30_pm2 = in_array('5:30 PM', $unavailable_time)  ? 'checked' : '';
    $six_pm2 = in_array('6:00 PM', $unavailable_time)  ? 'checked' : '';
    $six30_pm2 = in_array('6:30 PM', $unavailable_time)  ? 'checked' : '';
    $seven_pm2 = in_array('7:00 PM', $unavailable_time)  ? 'checked' : '';
    $seven30_pm2 = in_array('7:30 PM', $unavailable_time)  ? 'checked' : '';
    $eight_pm2 = in_array('8:00 PM', $unavailable_time)  ? 'checked' : '';
}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<form id="disableForm">
    <input type="hidden" name="date" value="<?= $date ?>" id="date">
    <div class="row ps-4 h3">
          <h2 class="dayzone">
            <img src="resources/images/dayzone1.png" alt=""/>
            Morning
          </h2>
          <h2 class="timezone">6:00 AM to 11:30 AM</h2>
        </div>

          <div class="row pt-5 justify-content-center">

          <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="6" name="time_slots[]" value="6:00 AM" <?= $six_am ?> <?= $six_am2 ?>>  
                <label for="6" class="btn btn-outline-secondary <?= $six_am ?>" >
                  <i class="fa-regular fa-clock me-1"></i> 6:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $six30_am ?>">
            <input type="checkbox" id="63" name="time_slots[]" value="6:30 AM" <?= $six30_am ?> <?= $six30_am2 ?>>  
                <label for="63" class="btn btn-outline-secondary <?= $six30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 6:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $seven_am ?>">
            <input type="checkbox" id="7" name="time_slots[]" value="7:00 AM" <?= $seven_am ?> <?= $seven_am2 ?>>  
                <label for="7" class="btn btn-outline-secondary <?= $seven_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $seven30_am ?>">
            <input type="checkbox" id="73" name="time_slots[]" value="7:30 AM" <?= $seven30_am ?> <?= $seven30_am2 ?>>  
                <label for="73" class="btn btn-outline-secondary <?= $seven30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $eight_am ?>">
            <input type="checkbox" id="8" name="time_slots[]" value="8:00 AM" <?= $eight_am ?> <?= $eight_am2 ?>>  
                <label for="8" class="btn btn-outline-secondary <?= $eight_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 8:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $eight30_am ?>">
            <input type="checkbox" id="83" name="time_slots[]" value="8:30 AM" <?= $eight30_am ?> <?= $eight30_am2 ?>>  
                <label for="83" class="btn btn-outline-secondary <?= $eight30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 8:30 AM
                </label>
            </div>

        

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $nine_am ?>">
              <input type="checkbox" id="9" name="time_slots[]" value="9:00 AM" <?= $nine_am ?> <?= $nine_am2 ?>>  
                <label for="9" class="btn btn-outline-secondary <?= $nine_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 9:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $nine30_am ?>">
              <input type="checkbox" id="93" name="time_slots[]" value="9:30 AM" <?= $nine30_am ?> <?= $nine30_am2 ?>>  
                <label for="93" class="btn btn-outline-secondary <?= $nine30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 9:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $ten_am ?>">
            <input type="checkbox" id="10" name="time_slots[]" value="10:00 AM" <?= $ten_am ?> <?= $ten_am2 ?>>  
                <label for="10" class="btn btn-outline-secondary <?= $ten_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 10:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $ten30_am ?>">
            <input type="checkbox" id="103" name="time_slots[]" value="10:30 AM" <?= $ten30_am ?> <?= $ten30_am2 ?>>  
                <label for="103" class="btn btn-outline-secondary <?= $ten30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 10:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $eleven_am ?>">
              <input type="checkbox" id="11" name="time_slots[]" value="11:00 AM"  <?= $eleven_am ?> <?= $eleven_am2 ?>>  
                <label for="11" class="btn btn-outline-secondary <?= $eleven_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 11:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $eleven30_am ?>">
              <input type="checkbox" id="113" name="time_slots[]" value="11:30 AM" <?= $eleven30_am ?> <?= $eleven30_am2 ?>>  
                <label for="113" class="btn btn-outline-secondary <?= $eleven30_am ?>">
                  <i class="fa-regular fa-clock me-1"></i> 11:30 AM
                </label>
            </div>

          </div>
        
        <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="resources/images/dayzone2.png" alt=""/>
            Afternoon
          </h2>
          <h2 class="timezone">1:00 PM to 5:30 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $twelve_pm ?>">
              <input type="checkbox" id="12" name="time_slots[]" value="12:00 PM"  <?= $twelve_pm ?> <?= $twelve_pm2 ?>>  
                  <label for="12" class="btn btn-outline-secondary <?= $twelve_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 12:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $twelve30_pm ?>">
              <input type="checkbox" id="123" name="time_slots[]" value="12:30 PM" <?= $twelve30_pm ?> <?= $twelve30_pm2 ?>>  
                  <label for="123" class="btn btn-outline-secondary <?= $twelve30_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 12:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $one_pm ?>">
              <input type="checkbox" id="1" name="time_slots[]" value="1:00 PM" <?= $one_pm ?> <?= $one_pm2 ?>>  
                <label for="1" class="btn btn-outline-secondary <?= $one_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 1:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $one30_pm ?>">
              <input type="checkbox" id="13" name="time_slots[]" value="1:30 PM" <?= $one30_pm ?> <?= $one30_pm2 ?>>  
                <label for="13" class="btn btn-outline-secondary <?= $one30_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 1:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $two_pm ?>">
              <input type="checkbox" id="2" name="time_slots[]" value="2:00 PM"  <?= $two_pm ?> <?= $two_pm2 ?>>  
                  <label for="2" class="btn btn-outline-secondary <?= $two_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 2:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center  <?= $two30_pm ?>">
              <input type="checkbox" id="23" name="time_slots[]" value="2:30 PM"  <?= $two30_pm ?> <?= $two30_pm2 ?>>  
                  <label for="23" class="btn btn-outline-secondary <?= $two30_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 2:30 PM
                  </label>
            </div>

           <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $three_pm ?>">
              <input type="checkbox" id="3" name="time_slots[]" value="3:00 PM"  <?= $three_pm ?> <?= $three_pm2 ?>>  
                <label for="3" class="btn btn-outline-secondary <?= $three_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 3:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $three30_pm ?>">
              <input type="checkbox" id="33" name="time_slots[]" value="3:30 PM"  <?= $three30_pm ?> <?= $three30_pm2 ?>>  
                <label for="33" class="btn btn-outline-secondary <?= $three30_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 3:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $four_pm ?>">
              <input type="checkbox" id="4" name="time_slots[]" value="4:00 PM"  <?= $four_pm ?> <?= $four_pm2 ?>>  
                  <label for="4" class="btn btn-outline-secondary <?= $four_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 4:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $four30_pm ?>">
              <input type="checkbox" id="43" name="time_slots[]" value="4:30 PM"  <?= $four30_pm ?> <?= $four30_pm2 ?>>  
                  <label for="43" class="btn btn-outline-secondary <?= $four30_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 4:30 PM
                  </label>
            </div>

          <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $five_pm ?>">
              <input type="checkbox" id="5" name="time_slots[]" value="5:00 PM"  <?= $five_pm ?> <?= $five_pm2 ?>>  
                <label for="5" class="btn btn-outline-secondary <?= $five_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 5:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $five30_pm ?>">
              <input type="checkbox" id="53" name="time_slots[]" value="5:30 PM"  <?= $five30_pm ?> <?= $five30_pm2 ?>>  
                <label for="53" class="btn btn-outline-secondary <?= $five30_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 5:30 PM
                </label>
            </div>

            </div>

            <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="resources/images/dayzone3.png" alt=""/>
            Evening
          </h2>
          <h2 class="timezone">6:00 PM to 8:00 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $six_pm ?>">
              <input type="checkbox" id="12" name="time_slots[]" value="6:00 PM"  <?= $six_pm ?>  <?= $six_pm2 ?>>  
                  <label for="12" class="btn btn-outline-secondary <?= $six_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 6:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center <?= $six30_pm ?>">
              <input type="checkbox" id="123" name="time_slots[]" value="6:30 PM"  <?= $six30_pm ?>  <?= $six30_pm2 ?>>  
                  <label for="123" class="btn btn-outline-secondary <?= $six30_pm ?>">
                    <i class="fa-regular fa-clock me-1"></i> 6:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $seven_pm ?>">
              <input type="checkbox" id="1" name="time_slots[]" value="7:00 PM"  <?= $seven_pm ?>  <?= $seven_pm2 ?>>  
                <label for="1" class="btn btn-outline-secondary <?= $seven_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $seven30_pm ?>">
              <input type="checkbox" id="13" name="time_slots[]" value="7:30 PM"  <?= $seven30_pm ?> <?= $seven30_pm2 ?>>  
                <label for="13" class="btn btn-outline-secondary <?= $seven30_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center <?= $eight_pm ?>">
              <input type="checkbox" id="13" name="time_slots[]" value="8:00 PM"  <?= $eight_pm ?> <?= $eight_pm2 ?>>  
                <label for="13" class="btn btn-outline-secondary <?= $eight_pm ?>">
                  <i class="fa-regular fa-clock me-1"></i> 8:00 PM
                </label>
            </div>

        </div>

            </div>
            

          <div class="row pt-5">

          <div class="col-5 col-sm-3 col-lg-2"></div>

          </div>
      </div>
</form>

      <script>

        var selectedRadio = $('#selectedRadio');
        var morningRadio = $('#morningRadio');
        var afternoonRadio = $('#afternoonRadio');
        var eveningRadio = $('#eveningRadio');
        var allRadio = $('#allRadio');

        var morningRadios = document.querySelectorAll('input[name="time_slots[]"][value$="AM"]:not(:disabled)');

        var afternoonRadios = document.querySelectorAll('input[name="time_slots[]"][value^="12"]:not(:disabled), input[name="time_slots[]"][value="1:00 PM"]:not(:disabled), input[name="time_slots[]"][value="1:30 PM"]:not(:disabled), input[name="time_slots[]"][value^="2"]:not(:disabled), input[name="time_slots[]"][value^="3"]:not(:disabled), input[name="time_slots[]"][value^="4"]:not(:disabled), input[name="time_slots[]"][value^="5"]:not(:disabled)');

        var eveningRadios = document.querySelectorAll('input[name="time_slots[]"][value="6:00 PM"]:not(:disabled), input[name="time_slots[]"][value="6:30 PM"]:not(:disabled), input[name="time_slots[]"][value="7:00 PM"]:not(:disabled), input[name="time_slots[]"][value="7:30 PM"]:not(:disabled), input[name="time_slots[]"][value="8:00 PM"]:not(:disabled)');

        function handleRadioChange() {
            if (selectedRadio.prop("checked")) {
                // If "All" radio is checked, uncheck all checkboxes
                morningRadios.forEach(radio => radio.checked = false);
                afternoonRadios.forEach(radio => radio.checked = false);
                eveningRadios.forEach(radio => radio.checked = false);
            } else if (morningRadio.prop("checked")) {
                // If "Morning" radio is checked, check all morning checkboxes
                morningRadios.forEach(radio => radio.checked = true);
                afternoonRadios.forEach(radio => radio.checked = false);
                eveningRadios.forEach(radio => radio.checked = false);
            } else if (afternoonRadio.prop("checked")) {
                // If "Afternoon" radio is checked, check all afternoon checkboxes
                morningRadios.forEach(radio => radio.checked = false);
                afternoonRadios.forEach(radio => radio.checked = true);
                eveningRadios.forEach(radio => radio.checked = false);
            } else if (eveningRadio.prop("checked")) {
                // If "Evening" radio is checked, check all evening checkboxes
                morningRadios.forEach(radio => radio.checked = false);
                afternoonRadios.forEach(radio => radio.checked = false);
                eveningRadios.forEach(radio => radio.checked = true);
            } else if (allRadio.prop("checked")) {
                // If "Evening" radio is checked, check all evening checkboxes
                morningRadios.forEach(radio => radio.checked = true);
                afternoonRadios.forEach(radio => radio.checked = true);
                eveningRadios.forEach(radio => radio.checked = true);
            }
        }

        // Attach the function to the change event of the radio buttons
        selectedRadio.add(morningRadio).add(afternoonRadio).add(eveningRadio).add(allRadio).on("change", handleRadioChange);

        function disableTime(){
            var disableForm = $('#disableForm');
            var disableRadios = document.querySelectorAll('input[name="time_slots[]"]:checked:not(:disabled)');
            
            var confirmation = window.confirm('Are you sure you want to disable the selected time slots?');
            if (confirmation) {
                var selectedValues = Array.from(disableRadios).map(radio => radio.value).join(', ');
                var disableDate = $('#date').val();
                disableTimeSlots({
                    disable_time: 1,
                    property_id: <?php echo $property_id ?>,
                    date: disableDate,
                    time_slots: selectedValues
                })
            }       
        } 

        function disableTimeSlots(data) {
            $.ajax({
                url: 'disable-time',
                type: 'POST',
                data: data,
                success: function(response) {
                    alert('Selected timeslots disabled');
                    window.location.href="appointments";
                    // window.location.href = 'manage-unavailable.php';
                }
            });
        }

        // var disableButton = ('#disable_time');
        // disableButton.on('click', function(){
        //     var disableForm = ('#disableForm');
        //     var disableRadios = document.querySelectorAll('input[name="time_slots[]"]:not(:disabled):checked');
        //     alert(disableRadios);
        // });
      </script>
</body>
</html>

