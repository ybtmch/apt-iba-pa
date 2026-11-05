<?php
use Models\Availability;
use Models\Property;
use Models\Appointment;

include ("../init.php");
$user_id = $_SESSION['user_id'];

$properties = new Property();
$properties->setConnection($connection);
$properties = $properties->getProperty($user_id);
$count_properties = count($properties);
$count_units = 0;
foreach($properties as $property){
    $total_units = $property['total_units'];
    $count_units = $count_units + $total_units;
}

$appointments = new Appointment();
$appointments->setConnection($connection);
$appointments = $appointments->getPropertyAppointments($user_id);
$count_appointments = isset($appointments) ? count($appointments) : 0;

function getDateTimeStamp($date, $time) {
    return strtotime("$date $time");
}

usort($appointments, function($a, $b) {
    $currentTimestamp = time(); // Get current timestamp
    $aTimestamp = getDateTimeStamp($a['date'], $a['time']);
    $bTimestamp = getDateTimeStamp($b['date'], $b['time']);

    $diffA = abs($aTimestamp - $currentTimestamp);
    $diffB = abs($bTimestamp - $currentTimestamp);

    return $diffA - $diffB;
});

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/appointments_view.css" rel="stylesheet" />
    
<style>
.tableAppt{
   background: var(--cultured-2);
}

.tableAppt table {
   border-collapse: separate;
   border-spacing: 0 10px; /* Adjust the spacing between rows if needed */
   border-radius: 10px; /* Adjust the radius as per your preference */
   overflow: hidden;
}

.tableAppt th,
.tableAppt td {
   border: 1px solid var(--cultured-2); /* Add border to cells if needed */
   border-radius: 8px; /* Adjust the radius as per your preference */
}

.tableAppt th:first-child,
.tableAppt td:first-child {
   border-top-left-radius: 10px;
   border-bottom-left-radius: 10px;
}

.tableAppt th:last-child,
.tableAppt td:last-child {
   border-top-right-radius: 10px;
   border-bottom-right-radius: 10px;
}

.tableAppt th{
   font-size: 1.9rem;
   font-weight: 500;
   padding: 1.2rem;
}

.tableAppt td{
   font-size: 1.7rem;
   font-weight: 400;
   padding: 2rem;
}

.tableAppt td, .tableAppt th{
   vertical-align: middle;
}

.hero-title {
   font-size: 40px;
   color: var(--orange-soda);
}

.hero-text {
   text-align: justify;
}

.tableAppt.btn{
   background-color: var(--orange-soda)
}

.tableAppt.btn i{
   color: #fff;
}

.tableAppt.btn:active, .hero .btn:focus{
   color: #fff;
}

.statusU span {
   padding: .5rem 3rem;
   color: var(--orange-soda);
   background-color: hsla(9, 100%, 62%, 0.1);;
   font-size: 2rem;
   font-weight: 500;
   border-radius: 25px;
}

.tableAppt .table .dropdown-menu a{
   font-size: 1.5rem;
}

.tableAppt .table .dropdown-menu {
   width: 150px;
}


/* Reservations table */

.tableRsvtn{
   background: var(--cultured-2);
}

.tableRsvtn table {
   border-collapse: separate;
   border-spacing: 0 10px; /* Adjust the spacing between rows if needed */
   border-radius: 10px; /* Adjust the radius as per your preference */
   overflow: hidden;
}

.tableRsvtn th,
.tableRsvtn td {
   border: 1px solid var(--cultured-2); /* Add border to cells if needed */
   border-radius: 8px; /* Adjust the radius as per your preference */
}

.tableRsvtn th:first-child,
.tableRsvtn td:first-child {
   border-top-left-radius: 10px;
   border-bottom-left-radius: 10px;
}

.tableRsvtn th:last-child,
.tableRsvtn td:last-child {
   border-top-right-radius: 10px;
   border-bottom-right-radius: 10px;
}

.tableRsvtn th{
   font-size: 1.9rem;
   font-weight: 500;
   padding: 1.2rem;
}

.tableRsvtn td{
   font-size: 1.7rem;
   font-weight: 400;
   padding: 2rem;
}

.tableRsvtn td a{
   font-size: 1.7rem;
   font-weight: 400;
   text-decoration: underline;
   color: grey;
}

.tableRsvtn td span{
   font-size: 1.5rem;
   font-weight: 500;
}

.tableRsvtn td, .tableRsvtn th{
   vertical-align: middle;
}

.hero-title {
   font-size: 40px;
   color: var(--orange-soda);
}

.hero-text {
   text-align: justify;
}

.tableRsvtn.btn{
   background-color: var(--orange-soda)
}

.tableRsvtn.btn i{
   color: #fff;
}

.tableRsvtn.btn:active, .hero .btn:focus{
   color: #fff;
}

.tableRsvtn .table .dropdown-menu a{
   font-size: 1.5rem;
}

.tableRsvtn .table .dropdown-menu {
   width: 150px;
}

</style>
</head>
<body>

<!-- Old codes where madaming timeslots -->

     <!--   
        <div class="container-fluid">
            <section class="tabelAppt">
    
                <div class="row">
                <div class="col-md">
                    <h1 class="p-3 viewAppoint">View <strong>Appointments</strong></h1>
                </div>
                </div>  

            </section>
        </div>
        <div class="row">
            <div class="col-12 table-responsive ">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Property</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time of Visit</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php 
                        // Check if $appointments is set and not empty
                        if(isset($appointments) && !empty($appointments)) {
                            $upcoming = 0;
                            foreach($appointments as $appointment){
                                $appointment_id = $appointment['appointment_id'];
                                $tenant_user_id = $appointment['user_id'];
                                $appointment_number = $appointment['appointment_number'];
                                $full_name = $appointment['first_name'] . ' ' . $appointment['last_name'];
                                $property_name = $appointment['property_name'];
                                $date = $appointment['date'];
                                $timestamp = strtotime($date);
                                $formattedDate = date("F j, Y", $timestamp);
                                $time = $appointment['time'];

                                $timezone = new DateTimeZone('Asia/Manila');
                                $dateString = $date . ' ' . $time;
                                $targetDateTime = new DateTime($dateString, $timezone);
                                $now = new DateTime('now', $timezone);

                                // Check if the appointment is upcoming or passed
                                if ($targetDateTime->getTimestamp() < $now->getTimestamp()) {
                                    $status = 'Passed';
                                } 
                                else {
                                    $upcoming = $upcoming + 1;
                                    $status = 'Upcoming';
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $appointment_id; ?></th>
                                        <td><?= $full_name ?></td>
                                        <td><?= $property_name ?></td>
                                        <td><?= $formattedDate ?></td>
                                        <td><?= $time ?></td>
                                        <td><?= $appointment_number ?></td>
                                        <td><?= $status ?></td>
                                        <td>
                                        <a class="btn" id="openModalButton" href="#" data-bs-toggle="modal" data-bs-target="#appointmentModal" data-userid="<?php echo $tenant_user_id ?>" data-date="<?php echo $date ?>" data-time="<?php echo $time ?>"><i class="fa-solid fa-eye fa-2x" style="border: none; color: #0b2c3c;"></i></a>
                                            <div class="btn-group">
                                                <a type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; color: #0b2c3c;">
                                                    <i class="fa-regular fa-pen fa-2x"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Finished</a></li>
                                                    <li><a class="dropdown-item" href="#">Expired</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                } //end else
                            } //end foreach
                        } //end if
                        
                        if($upcoming === 0) { // No appointments
                        ?>
                        <tr>
                            <td colspan="8">No Upcoming Appointments Yet</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div> -->
     
<!-- Upcoming Appointments Table copied from landlord.index -->

<!-- <section class="tableAppt section-title">
    <div class="container">
        <p class="statusU text-start"><span>Activities</span></p>
        <div class="offersHeading1 text-start p-3 h1 ">Upcoming Appointments</div>

        <div class="container timeslotSettings">
        <div class="d-none d-lg-block">
            <div  class="row justify-content-between align-items-center mb-3 ">
                            <div class="col-2 ">
                                <form>
                                    <div  class="form-group ">
                                        <select style=" border:none; font-size:15px; border-radius:5px; width:100%; height:30px;" name="property" id="propertySelect">
                                            <?php 
                                            foreach ($properties as $property){
                                                $property_name = $property['property_name'];
                                                $property_id = $property['property_id'];
                                            ?>
                                            <option value="<?php echo $property_id ?>"><?php echo $property_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </form>
                            </div>

                        
                            <div class="col-4 text-end">                  
                                <a class="btn btn-outline-secondary me-2 text-center  " href="manage-available.php" role="button"><i class="fa-solid fa-regular fa-folder-gear"></i></i> Availability Manager</a>
                            
                            
                                <a  class="btn btn-outline-secondary me-2 text-center  " href="manage-unavailable.php" role="button"><i class="fa-solid fa-calendar-xmark"></i> Set Unavailability</a>
                            </div>  
            </div>
        </div>
                           
                <div class="d-block d-lg-none">
                    <div class="row justify-content-end ">
                        <a  class="btn btn-outline-secondary me-2 text-center  " href="manage-available.php" role="button"><i class="fa-solid fa-regular fa-folder-gear"></i></i> Availability Manager</a>

                    </div>
                        <div  class="row justify-content-between mt-2 align-items-center mb-3  ">
                            <div class="col">
                                <form>
                                    <div  class="form-group ">
                                        <select style=" border:none; font-size:15px; border-radius:5px; width:100%; height:30px;" name="property" id="propertySelect">
                                            <?php 
                                            foreach ($properties as $property){
                                                $property_name = $property['property_name'];
                                                $property_id = $property['property_id'];
                                            ?>
                                            <option value="<?php echo $property_id ?>"><?php echo $property_name ?></option>
                                            <?php } ?>
                                            <option value="2">222</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        
                        
                            <a  class="btn btn-outline-secondary me-2 text-center " href="manage-unavailable.php" role="button"><i class="fa-solid fa-calendar-xmark"></i> Set Unavailability</a>
  
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-12 table-responsive ">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Property</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time of Visit</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php 
                        // Check if $appointments is set and not empty
                        if(isset($appointments) && !empty($appointments)) {
                            $upcoming = 0;
                            foreach($appointments as $appointment){
                                $appointment_id = $appointment['appointment_id'];
                                $tenant_user_id = $appointment['user_id'];
                                $appointment_number = $appointment['appointment_number'];
                                $full_name = $appointment['first_name'] . ' ' . $appointment['last_name'];
                                $property_name = $appointment['property_name'];
                                $date = $appointment['date'];
                                $timestamp = strtotime($date);
                                $formattedDate = date("F j, Y", $timestamp);
                                $time = $appointment['time'];

                                $timezone = new DateTimeZone('Asia/Manila');
                                $dateString = $date . ' ' . $time;
                                $targetDateTime = new DateTime($dateString, $timezone);
                                $now = new DateTime('now', $timezone);

                                // Check if the appointment is upcoming or passed
                                if ($targetDateTime->getTimestamp() < $now->getTimestamp()) {
                                    $status = 'Passed';
                                } 
                                else {
                                    $upcoming = $upcoming + 1;
                                    $status = 'Upcoming';
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $appointment_id; ?></th>
                                        <td><?= $full_name ?></td>
                                        <td><?= $property_name ?></td>
                                        <td><?= $formattedDate ?></td>
                                        <td><?= $time ?></td>
                                        <td><?= $appointment_number ?></td>
                                        <td><?= $status ?></td>
                                        <td>
                                        <a class="btn" id="openModalButton" href="#" data-bs-toggle="modal" data-bs-target="#appointmentModal" data-userid="<?php echo $tenant_user_id ?>" data-date="<?php echo $date ?>" data-time="<?php echo $time ?>"><i class="fa-solid fa-eye fa-2x" style="border: none; color: #0b2c3c;"></i></a>
                                            <div class="btn-group">
                                                <a type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; color: #0b2c3c;">
                                                    <i class="fa-regular fa-pen fa-2x"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Finished</a></li>
                                                    <li><a class="dropdown-item" href="#">Expired</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                } //end else
                            } //end foreach
                        } //end if
                        
                        if($upcoming === 0) { // No appointments
                        ?>
                        <tr>
                            <td colspan="8">No Upcoming Appointments Yet</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section> -->

<!-- FINAL BOSS! ito na yung kita sa apppointmetns.php, so kita upcoming & yung finished appt. -->

    <!-- View Appointment title/date ends -->
    <section class="tableAppt section-title pb-5 mb-5">
    <div class="container">
        <p class="statusU text-start"><span>Activities</span></p>
        <div class="offersHeading1 text-start p-3 h1 ">All Appointments</div>


        <!-- Dorm/Apt dropdown + Availability manager & Set unavailability buttons -->

            <div class="container timeslotSettings">
                <div class="d-none d-lg-block">
                    <div  class="row justify-content-between align-items-center mb-3 ">
                                    <div class="col-12 col-lg-4">
                                        <form>
                                            <div  class="form-group ">
                                                <select style=" border:none; font-size:15px; border-radius:5px; width:100%; height:30px;" name="property" id="propertySelect">
                                                    <?php 
                                                    foreach ($properties as $property){
                                                        $property_name = $property['property_name'];
                                                        $property_id = $property['property_id'];
                                                    ?>
                                                    <option value="<?php echo $property_id ?>"><?php echo $property_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                
                                    <div class="col-12 col-lg-6 text-end">                  
                                        <a class="btn btn-outline-secondary me-2 text-center  " href="manage-available.php" role="button"><i class="fa-solid fa-regular fa-folder-gear"></i></i> Availability Manager</a>
                                    
                                    
                                        <a  class="btn btn-outline-secondary me-2 text-center  " href="manage-unavailable.php" role="button"><i class="fa-solid fa-calendar-xmark"></i> Set Unavailability</a>
                                    </div>  
                    </div>
                </div>
                            
                <div class="d-block d-lg-none">
                    <form>
                        <div  class="form-group ">
                            <select style=" border:none; font-size:15px; border-radius:5px; width:100%; height:30px;" name="property" id="propertySelect">
                                <?php 
                                foreach ($properties as $property){
                                    $property_name = $property['property_name'];
                                    $property_id = $property['property_id'];
                                ?>
                                <option value="<?php echo $property_id ?>"><?php echo $property_name ?></option>
                                <?php } ?>
                                <option value="2">222</option>
                            </select>
                        </div>
                    </form>

                    <div class="row mt-3 mb-3">
                    
                        <div class="col-12">
                            <a  class="btn btn-outline-secondary text-center w-100" href="manage-available.php" role="button"><i class="fa-solid fa-regular fa-folder-gear"></i></i> Availability Manager</a>
                        </div>

                    </div>
                        <!-- <div  class="row justify-content-between mt-2 align-items-center mb-3  ">
                            <div class="col">

                            </div> -->
                        
                            <div class="col-12">
                                <a  class="btn btn-outline-secondary text-center w-100" href="manage-unavailable.php" role="button"><i class="fa-solid fa-calendar-xmark"></i> Set Unavailability</a>
                            </div>

                    <!-- </div> -->
                    </div>
            </div>


        <div class="row">
            <div class="col-12 table-responsive text-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Property</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time of Visit</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php 
                        // Check if $appointments is set and not empty
                        if(isset($appointments) && !empty($appointments)) {

                            foreach($appointments as $appointment){
                                $appointment_id = $appointment['appointment_id'];
                                $appointment_number = $appointment['appointment_number'];
                                $full_name = $appointment['first_name'] . ' ' . $appointment['last_name'];
                                $property_name = $appointment['property_name'];
                                $date = $appointment['date'];
                                $timestamp = strtotime($date);
                                $formattedDate = date("F j, Y", $timestamp);
                                $time = $appointment['time'];

                                $timezone = new DateTimeZone('Asia/Manila');
                                $dateString = $date . ' ' . $time;
                                $targetDateTime = new DateTime($dateString, $timezone);
                                $now = new DateTime('now', $timezone);

                                // Check if the appointment is upcoming or passed
                                $status = ($targetDateTime->getTimestamp() < $now->getTimestamp()) ? 'Passed' : 'Upcoming';
                        ?>
                        <tr>
                            <th scope="row"><?= $appointment_id; ?></th>
                            <td><?= $full_name ?></td>
                            <td><?= $property_name ?></td>
                            <td><?= $formattedDate ?></td>
                            <td><?= $time ?></td>
                            <td><?= $appointment_number ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <a class="btn" href="appointments.php" type="button"><i class="fa-solid fa-eye fa-2x" style="border: none; color: #0b2c3c;"></i></a>
                                <div class="btn-group">
                                    <a type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; color: #0b2c3c;">
                                        <i class="fa-regular fa-pen fa-2x"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Decline</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        
                        <?php 
                            } // end foreach
                        } else { // No appointments
                        ?>
                        <tr>
                            <td colspan="8">No Appointments Made Yet</td>
                        </tr>

                        
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="col extraContainer"></div>
        </div>
    </div>
</section>


    <!-- Time slots ends -->

<script>
$(document).ready(function() {
    var pickDateInput = $("#pick-date");
    var selectedDateH2 = $("#selected_date");

    $('#propertySelect').change(function() {
        var selectedValue = $(this).val();
        if(pickDateInput.val()){
            updateSelectedDate();
        }
        
    });

    function updateSelectedDate() {
        var propertySelect = $('#propertySelect').val(); 
        var inputDate = pickDateInput.val();
        var date = new Date(inputDate);

        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var year = date.getFullYear();
        var month = date.getMonth();
        var day = date.getDate();
        var formattedDate = monthNames[month] + " " + (day < 10 ? '0' : '') + day + ", " + year;
        selectedDateH2.text(formattedDate);

        if(propertySelect && inputDate){
            checkDate({ 
                property_id: propertySelect,
                set_date: inputDate, 
            });
        }
    }
    // pickDateInput.trigger('change');
    pickDateInput.on('change', updateSelectedDate);

    function checkDate(data) {
        $.ajax({
            url: 'check-date',
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