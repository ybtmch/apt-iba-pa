<?php
use Models\Appointment;
include ("../../init.php");
include ("../session.php");

$user_id = $_SESSION['user_id'] ?? NULL; //change on session
if(isset($_POST['set_date'])){
    $date = $_POST['set_date'];
    $check_date = new Appointment('', '', '', '','');
    $check_date->setConnection($connection);
    $check_date = $check_date->getPropertyDateAppointments($user_id, $date);

    $appointment_time = [];
    foreach($check_date as $date_check){
        $time_check = $date_check['time'];
        $appointment_time[] = $time_check;
    }
} else {
    header('location: index.php');
    exit();
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
<div class="container pt-5 pb-5 bgTimeSlots timeSlots">
<div id="time_slots">
    <input type="hidden" name="date" value="<?= $date ?>" id="date">
                <div class="row ps-4 h3 mt-2">
                  <h2 class="dayzone">
                    <img src="images/dayzone1.png" alt=""/>
                    Morning
                  </h2>
                  <h2 class="timezone">8:00 AM to 11:30 AM</h2>
                </div>
                
                <?php
                $morning_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM");

                $row_count = 0;
                $col_count = 0;

                echo '<div class="row pt-5 justify-content-center">';
                foreach ($morning_slots as $time_slot) {
                if ($col_count == 4) {
                    echo '</div><div class="row pt-5 justify-content-center">';
                    $col_count = 0;
                }

                if(in_array($time_slot, $appointment_time)){
                    $unavailable = '';
                  } else {
                    $unavailable = 'disabled';
                  }

                  
                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary ' . $unavailable . '" data-bs-toggle="modal" data-bs-target="#modal" data-time="' . $time_slot . '" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
                $col_count++;
                }
                echo '</div>';

                ?>
                
                <div class="row ps-4 h3 mt-5">
                  <hr>
                  <h2 class="dayzone pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Afternoon
                  </h2>
                  <h2 class="timezone">1:00 PM to 5:30 PM</h2>
                </div>
                  
                <?php
                $afternoon_slots = array("01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

                $row_count = 0;
                $col_count = 0;

                echo '<div class="row pt-5 justify-content-center">';
                foreach ($afternoon_slots as $time_slot) {
                if ($col_count == 4) {
                    echo '</div><div class="row pt-5 justify-content-center">';
                    $col_count = 0;
                }

                if(in_array($time_slot, $appointment_time)){
                    $unavailable = '';
                  } else {
                    $unavailable = 'disabled';
                  }

                  
                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary ' . $unavailable . '" data-bs-toggle="modal" data-bs-target="#modal" data-time="' . $time_slot . '" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
                $col_count++;
                }
                echo '</div>';

                ?>
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
                url: 'check-time.php',
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