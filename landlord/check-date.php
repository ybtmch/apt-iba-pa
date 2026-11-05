<?php
use Models\Availability;
use Models\Appointment;
include ("../init.php");
include ("session.php");

$landlord_id = $_SESSION['user_id'];
// $available_slots = new Availability();
// $available_slots->setConnection($connection);
// $available_slots = $available_slots->getAvailableSlots($landlord_id);
// $time_slots = $available_slots['time_slots'];

// $time_slots_array = explode(', ', $time_slots);

if(isset($_POST['set_date'], $_POST['property_id'])){
    $property_id = $_POST['property_id'];
    $date = $_POST['set_date'];
    $inputDate = DateTime::createFromFormat('j F, Y', $date);
    $outputDateString = $inputDate->format('Y-m-d');

    $check_date = new Appointment();
    $check_date->setConnection($connection);
    $check_date = $check_date->getPropertyDateAppointments($property_id, $outputDateString);
    
    $appointment_time = [];
    foreach($check_date as $date_check){
        $time_check = $date_check['time'];
        $appointment_time[] = $time_check;
    }

    $six_am = in_array('6:00 AM', $appointment_time) ? '' : 'disabled';
    $six30_am = in_array('6:30 AM', $appointment_time)  ? '' : 'disabled';
    $seven_am = in_array('7:00 AM', $appointment_time)  ? '' : 'disabled';
    $seven30_am = in_array('7:30 AM', $appointment_time)  ? '' : 'disabled';
    $eight_am = in_array('8:00 AM', $appointment_time)  ? '' : 'disabled';
    $eight30_am = in_array('8:30 AM', $appointment_time)  ? '' : 'disabled';
    $nine_am = in_array('9:00 AM', $appointment_time)  ? '' : 'disabled';
    $nine30_am = in_array('9:30 AM', $appointment_time)  ? '' : 'disabled';
    $ten_am = in_array('10:00 AM', $appointment_time)  ? '' : 'disabled';
    $ten30_am = in_array('10:30 AM', $appointment_time)  ? '' : 'disabled';
    $eleven_am = in_array('11:00 AM', $appointment_time)  ? '' : 'disabled';
    $eleven30_am = in_array('11:30 AM', $appointment_time)  ? '' : 'disabled';
    $twelve_pm = in_array('12:00 PM', $appointment_time)  ? '' : 'disabled';
    $twelve30_pm = in_array('12:30 PM', $appointment_time)  ? '' : 'disabled';
    $one_pm = in_array('1:00 PM', $appointment_time)  ? '' : 'disabled';
    $one30_pm = in_array('1:30 PM', $appointment_time)  ? '' : 'disabled';
    $two_pm = in_array('2:00 PM', $appointment_time)  ? '' : 'disabled';
    $two30_pm = in_array('2:30 PM', $appointment_time)  ? '' : 'disabled';
    $three_pm = in_array('3:00 PM', $appointment_time)  ? '' : 'disabled';
    $three30_pm = in_array('3:30 PM', $appointment_time)  ? '' : 'disabled';
    $four_pm = in_array('4:00 PM', $appointment_time)  ? '' : 'disabled';
    $four30_pm = in_array('4:30 PM', $appointment_time)  ? '' : 'disabled';
    $five_pm = in_array('5:00 PM', $appointment_time)  ? '' : 'disabled';
    $five30_pm = in_array('5:30 PM', $appointment_time)  ? '' : 'disabled';
    $six_pm = in_array('6:00 PM', $appointment_time)  ? '' : 'disabled';
    $six30_pm = in_array('6:30 PM', $appointment_time)  ? '' : 'disabled';
    $seven_pm = in_array('7:00 PM', $appointment_time)  ? '' : 'disabled';
    $seven30_pm = in_array('7:30 PM', $appointment_time)  ? '' : 'disabled';
    $eight_pm = in_array('8:00 PM', $appointment_time)  ? '' : 'disabled';
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
    <input type="hidden" name="date" value="<?= $date ?>" id="date">
    <div class="row ps-4 h3">
          <h2 class="dayzone">
            <img src="images/dayzone1.png" alt=""/>
            Morning
          </h2>
          <h2 class="timezone">6:00 AM to 11:30 AM</h2>
        </div>

          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $six_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="6:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 6:00 AM</a>
            </div>
          
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $six30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="6:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 6:30 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $seven_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="7:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 7:00 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $seven30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="7:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 7:30 AM</a>
            </div>
        </div>
        <div class="row pt-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $eight_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="8:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 8:00 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $eight30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="8:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 8:30 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $nine_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="9:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 9:00 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $nine30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="9:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 9:30 AM</a>
            </div>
        </div>
        <div class="row pt-5 pb-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $ten_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="10:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 10:00 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $ten30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="10:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 10:30 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $eleven_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="11:00 AM" role="button">
                <i class="fa-regular fa-clock"></i> 11:00 AM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $eleven30_am ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="11:30 AM" role="button">
                <i class="fa-regular fa-clock"></i> 11:30 AM</a>
            </div>

          </div>
        
        <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="images/dayzone2.png" alt=""/>
            Afternoon
          </h2>
          <h2 class="timezone">12:00 PM to 5:30 PM</h2>
        </div>
        <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $twelve_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="12:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 12:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $twelve30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="12:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 12:30 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $one_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="1:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 1:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $one30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="1:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 1:30 PM</a>
            </div>
            </div>
            <div class="row pt-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $two_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="2:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 2:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $two30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="2:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 2:30 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $three_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="3:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 3:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $three30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="3:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 3:30 PM</a>
            </div>
            </div>
            <div class="row pt-5 pb-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $four_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="4:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 4:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $four30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="4:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 4:30 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $five_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="5:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 5:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $five30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="5:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 5:30 PM</a>
            </div>

        </div>

            <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="images/dayzone2.png" alt=""/>
            Evening
          </h2>
          <h2 class="timezone">6:00 PM to 8:00 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $six_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="6:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 6:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $six30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="6:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 6:30 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $seven_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="7:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 7:00 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $seven30_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="7:30 PM" role="button">
                <i class="fa-regular fa-clock"></i> 7:30 PM</a>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
                <a class="btn btn-outline-secondary <?= $eight_pm ?>" data-bs-toggle="modal" data-bs-target="#modal" data-time="8:00 PM" role="button">
                <i class="fa-regular fa-clock"></i> 8:00 PM</a>
            </div>

        </div>


            

          <div class="row pt-5">

          <div class="col-5 col-sm-3 col-lg-2"></div>

          </div>
                </div>
      </div>

    <!-- Modals -->
    <div class="modal fade modalSection" id="modal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">August 04, 2023 | 8:00 AM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="modal-content">
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
          </div>
        </div>

    <script>
        $(document).ready(function() {
            $('#modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); 
            var time = button.data('time');
            var modalTitle = $(this).find('.modal-title'); 
            var date = $('input[name="date"]').val();

            var formatDate = new Date(date);

            // Continue with the rest of your code
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var year = formatDate.getFullYear();
            var month = formatDate.getMonth();
            var day = formatDate.getDate();
            var formattedDate = monthNames[month] + " " + (day < 10 ? '0' : '') + day + ", " + year;

            modalTitle.text(formattedDate + ' | ' + time);
            
            performAjax({ 
                date: date, 
                time: time 
            });
        });

        function performAjax(data) {
            $.ajax({
                url: 'check-time',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#modal-content').html(response);
                }
            });
        }
        });
    </script>
</body>
</html>