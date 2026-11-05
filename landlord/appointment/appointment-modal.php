<?php
use Models\Appointment;
include ("../../init.php");

$user_id = $_SESSION['user_id'] ?? NULL; //change on session
//$date = '2023-09-09';
// $check_date = new Appointment('', '', '', '','');
// $check_date->setConnection($connection);
// $check_date = $check_date->getPropertyDateAppointments($user_id, $date);

// $appointment_time = [];
// foreach($check_date as $date_check){
//     $time_check = $date_check['time'];
//     $appointment_time[] = $time_check;
// }


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
     <!-- View Appointment title/date starts -->

     <div class="container-fluid">
        <section class="appointments">
  
            <div class="row">
              <div class="col-md">
                <h1 class="p-3 viewAppoint">View <strong>Appointments</strong></h1>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <h2 class="ms-3 apptDate" id="selected_date">No Date Selected</h2>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-3 mt-3">
                <form action="#">
                  <h2 class="text-center">*You can pick the date by clicking the button below.</h2>
                  
                  <div class="form-group p-3 datePicker">
                    <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                  </div>
                </form>
              </div>
            </div>

        </section>
      </div>
      
    <!-- View Appointment title/date ends -->

    <!-- Time slots starts -->
      <div class="container timeslotSettings">
        <div cass="row">
          <div class="col d-flex pb-3 justify-content-end"><a class="btn btn-outline-secondary" href="manage.php" role="button"><i class="fa-solid fa-sliders"></i> Manage Availability</a></div>
        </div>
      </div>
<div class="container pt-5 pb-5 bgTimeSlots timeSlots">
<div id="time_slots">
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
                  
                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
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
                  
                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
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
            <h5 class="modal-title" id="modal-title">August 04, 2023</h5>
            <input type="text" id="modal-id" value=""> 
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
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
                      <div class="col-7"><input class="form-control" type="text" value="Princess Karylle" aria-label="Disabled input example" disabled readonly></div>
                      <div class="col-5"><input class="form-control" type="text" value="Dela Cruz" aria-label="Disabled input example" disabled readonly></div>
                  </div> 
                  <div class="row mt-4">
                      <div class="col h6">Contact Number</div>
                  </div>
                  <div class="row">
                      <div class="col"><input class="form-control" type="text" value="09123456789" aria-label="Disabled input example" disabled readonly></div>
                  </div>
                  <div class="row mt-4">
                      <div class="col h6">Email</div>
                  </div>
                  <div class="row">
                      <div class="col"><input class="form-control" type="text" value="lopez.karylle@auf.edu.ph" aria-label="Disabled input example" disabled readonly></div>
                  </div>
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
    var pickDateInput = $("#pick-date");
    var selectedDateH2 = $("#selected_date");
    var property_id = $("#property_id");

    // When the date input changes, update the text on the h2 element
    pickDateInput.on('change', function() {
        var inputDate = pickDateInput.val();
        var propertyId = property_id.val();

        var date = new Date(inputDate);

        // Continue with the rest of your code
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var year = date.getFullYear();
        var month = date.getMonth();
        var day = date.getDate();
        var formattedDate = monthNames[month] + " " + (day < 10 ? '0' : '') + day + ", " + year;
        selectedDateH2.text(formattedDate);

        performAjax({ 
            set_date: inputDate, 
            property_id: propertyId 
        });
    });

    
        

    function performAjax(data) {
        $.ajax({
            url: 'check-date.php',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#time_slots').html(response);
            }
        });
    }

    
});

    </script>
</body>
</html>