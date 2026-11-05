<?php
use Models\Property;
use Models\Appointment;
use Models\Reservation;
use Models\Unit;
use Models\Image;
use Models\User;
use Models\Review;
include ("../init.php");
include ("session.php");

$user = new User();
$user->setConnection($connection);
$user = $user->getById($user_id);

$full_name = $user['first_name'] . ' ' . $user['last_name'];
$_SESSION['full_name'] = $full_name;

if(isset($_SESSION['current_page'])){
    unset($_SESSION['current_page']);
}

//Get all properties
$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperty($user_id);
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

$reservations = new Reservation();
$reservations->setConnection($connection);
$reservations = array_reverse($reservations->getPropertyReservations($user_id));
$count_reservations = isset($reservations) ? count($reservations) : 0;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script
    src="https://kit.fontawesome.com/868f1fea46.js"
    crossorigin="anonymous"
  ></script>
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="css/all.css" rel="stylesheet"/>
    <link href="css/dashboard.css" rel="stylesheet"/>
    <!-- <link href="css/apply_property.css" rel="stylesheet" /> -->
    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
    
  </head>
  <body style="background-color: 	#f2f6f7">
    <!-- Navbar -->
<?php include('navbar.php'); ?>
    <!-- Navbar ends -->


    
<!-- Loader -->

    <?php //include('loader_process.php'); ?>


<!-- Cards -->

<section class="totalCards">
  <div class="container">
    <div class="row">
      
        <div class="col-12 col-md-6 mt-3 col-lg-3">
          <a href="properties.php" role="button" style="text-decoration: none;">
            <div class="card" style="border-radius: 7px;">
              <div class="card-body py-0" style="height: 100px">

                <div class="row h-100">
                  
                  <div class="col-8 my-auto">
                    <div class="tcTitle"><?php echo $count_properties ?></div>
                    <p class="tcSubtitle">Property</p>
                  </div>
                  

                  <div class="col-4 justify-content-center align-items-center d-flex">
                    <img src="resources/images/box4.png" alt="My Property" style="height: 90px;"/>
                  </div>

                </div>

              </div>
            </div>
          </a>  
        </div>


      <div class="col-12 col-md-6 mt-3 col-lg-3">
        <a href="appointments.php" role="button" style="text-decoration: none;">
          <div class="card" style="border-radius: 7px">
            <div class="card-body py-0" style="height: 100px">

              <div class="row h-100">
                <div class="col-8 my-auto">
                  <div class="tcTitle"><?php echo $count_appointments ?></div>
                  <p class="tcSubtitle">Appointments</p>
                </div>

                <div class="col-4 justify-content-center align-items-center d-flex">
                  <img src="resources/images/box2.png" alt="My Property" style="height: 80px;"/>
                </div>

              </div>

              <!-- <div class="row">
                
              </div> -->

            </div>
          </div>
        </a>  
      </div>

      <div class="col-12 col-md-6 mt-3 col-lg-3">
        <a href="reservations.php" role="button" style="text-decoration: none;">
          <div class="card" style="border-radius: 7px">
            <div class="card-body py-0" style="height: 100px">

              <div class="row h-100">
                <div class="col-8 my-auto">
                  <div class="tcTitle"><?php echo $count_reservations ?></div>
                  <p class="tcSubtitle">Reservations</p>
                </div>

                <div class="col-4 justify-content-center align-items-center d-flex">
                  <img src="resources/images/box3.png" alt="My Property" style="height: 90px;"/>
                </div>

              </div>

              <!-- <div class="row">
                
              </div> -->

            </div>
          </div>
        </a>  
      </div>

      <div class="col-12 col-md-6 mt-3 col-lg-3">
          <div class="card" style="border-radius: 7px">
            <div class="card-body py-0" style="height: 100px">

              <div class="row h-100">
                <div class="col-8 my-auto">
                  <div class="tcTitle"><?php echo $count_units ?></div>
                  <p class="tcSubtitle">Total Units</p>
                </div>

                <div class="col-4 justify-content-center align-items-center d-flex">
                  <img src="resources/images/box7.png" alt="My Property" style="height: 90px;"/>
                </div>

              </div>

              <!-- <div class="row">
                
              </div> -->

            </div>
          </div>
        </a>  
      </div>

    </div>
  </div>
</section>


<!-- Appointments Table -->

<section class="tableAppt section-title">
    <div class="container">
        <p class="statusU text-start"><span>Activities</span></p>
        <div class="offersHeading1 text-start p-3 h1 ">Upcoming Appointments</div>

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
                                                    <li><a class="dropdown-item declineBtn" data-appt="<?= $appointment_id; ?>" href="#">Decline</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                } //end else
                            } //end foreach
                            if($upcoming == 0){
                                ?>
                                <tr>
                            <td colspan="8">No Upcoming Appointments Yet</td>
                        </tr>
                        <div class="col emptyContainer"></div>
                                <?php
                            }
                        } //end if
                        
                       else { // No appointments
                        ?>
                        

                        
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<section class="container-fluid d-flex justify-content-center" style="background-color: #f2f6f7">
  <hr>
</section>

<!-- Reservations Table -->

<div class="tableRsvtn section-title">
    <div class="container">

        <div class="offersHeading1 text-start p-3">Recent Reservations</div>

        <div class="row">
            <div class="col-12 table-responsive">

                <table class="table table-hover">
                    <thead style="border-radius: 50px">
                        <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Property</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Reservation Number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">
                        <?php
                        if (isset($reservations) && !empty($reservations)) {
                            foreach ($reservations as $reservation) {
                                $reservation_id = $reservation['reservation_id'];
                                $property_name = $reservation['property_name'];
                                $full_name = $reservation['first_name'] . ' ' . $reservation['last_name'];
                                $dateTimeObj = new DateTime($reservation['reservation_date']);
                                $date = $dateTimeObj->format('F j, Y');
                                $time = $dateTimeObj->format('g:i A');
                                $reservation_number = $reservation['reservation_number'];
                                $unit_type = $reservation['unit_type'];
                                $no_of_units = $reservation['no_of_units'];
                                if ($reservation['status'] == 1) {
                                    $payment = 'Confirmed';
                                    $text_bg = 'text-bg-success';
                                } elseif ($reservation['status'] == 2) {
                                    $payment = 'Pending';
                                    $text_bg = 'text-bg-success';
                                } elseif ($reservation['status'] == 3) {
                                    $payment = 'Declined';
                                    $text_bg = 'text-bg-warning';
                                }
                        ?>
                                <tr>
                                    <td><?= $full_name ?></td>
                                    <td><?= $property_name ?></td>
                                    <td><?= $unit_type ?></td>
                                    <td><?= $no_of_units ?></td>
                                    <td><?= $date ?></td>
                                    <td><?= $time ?></td>
                                    <td><?= $reservation_number ?></td>
                                    <td><span class="badge rounded-pill <?= $text_bg ?>"><?= $payment ?></span></td>
                                    <td><?php if ($reservation['status'] != 1) { ?>
                                            <div class="btn-group">
                                                <a type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; color: #0b2c3c;">
                                                    <i class="fa-regular fa-pen fa-2x"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item confirmBtn" data-reserveId="<?= $reservation_id; ?>" href="#">Confirm</a></li>
                                                </ul>
                                            </div>
                                            <?php } ?>
                                        </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="9">No Recent Reservations Available</td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>

<section class="container-fluid d-flex justify-content-center" style="background-color: #f2f6f7">
  <hr>
</section>






  <!-- Property of the landlord -->
<div class="container">

  <section class="accommodations">
    <div class="offersHeading2 text-start p-3 h1 ">Property</div>
          <div class="box-container" >
              <?php $propertyCounter = 0; ?>
              <?php 
              foreach ($properties as $property) { 
                  $property_id = $property['property_id'];
                  $property_name = $property['property_name'];
                  $address = $property['barangay'] . ', ' . $property['city'];
                  $lowest_rate = $property['lowest_rate'];
                  $property_type = $property['property_type'];
                  // $total_units = $property['total_units'];

                  $units = new Unit();
                  $units->setConnection($connection);
                  $units = $units->getUnits($property_id);

                  foreach($units as $unit){
                      $occupied_units = $unit['occupied_units'];
                      $count_units = $count_units - $occupied_units;
                  }

                  $property_id = $property['property_id'];
                  $images = new Image();
                  $images->setConnection($connection);
                  $images = $images->getDisplayImage($property_id);
                  
                  if($images){
                      $image = $images['image_path'];
                  }

                  $reviews = new Review();
                  $reviews->setConnection($connection);
                  $reviews = $reviews->getRatings($property_id);
                  
                  if(count($reviews)>0){
                      $total_ratings = 0;
                      $total_reviews = count($reviews);
                      
                      foreach ($reviews as $review) {
                          $total_ratings += $review["rating"];
                      }
          
                      $average_rating = number_format(($total_ratings / $total_reviews),1);
          
                      if($total_reviews>1){
                          $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
                      } else{
                          $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
                      }
                  } else{
                      $show_reviews = "No reviews yet";
                  }
              ?>
                  <?php if ($propertyCounter % 2 == 0) { ?>
                  <div class="row gx-5 mb-3">
                      <?php } ?>
                      <div class="col-12 col-lg-6">
                          <div class="box" style="background-color: white">
                              <div class="row">
                                  <div class="col-8">
                                      <h3 class="name"><?= $property_name ?></h3>
                                      <input type="hidden" value="<?=$property_id?>" name="property_id">
                                      <div class="row">
                                          <div class="h4 mt-3 col-sm-8">
                                              <div>
                                              <i class="fas fa-map-marker-alt"></i> <?= $address ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <a href="view.php?property_id=<?= $property_id ?>" class="btnViewIndex">View</a>
                                  </div>
                                  

                              </div>

                          <div class="thumb">
                              <p class="type"><span><?= $property_type ?></span></p>

                              <p class="unitsAvailable"><span> <?= $total_units ?> Total Units</span></p>

                              <img src="../resources/images/properties/<?= $image ?>" alt="" />
                          </div>
                          <div class="row">
                              
                              <div class="col-sm-6 rentName">
                              Rent starts at
                                <div class="price">&#8369;<?= $lowest_rate ?></div>
                              </div>
                              <div class="col-12 col-lg-6">
                                  <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $show_reviews ?></p>
                              </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-12 col-lg-6">
                            </div>
                            
                            <div class="col-6"></div>

                          </div>
                            <?php 
                            $units = new Unit();
                            $units->setConnection($connection);
                            $units = $units->getUnits($property_id);
                            foreach($units as $unit){
                                $unit_id = $unit['unit_id'];
                                $unit_type = $unit['unit_type'];
                                $total_units = $unit['total_units'];
                                $occupied_units = $unit['occupied_units'];
                                $available_units = intval($total_units) - intval($occupied_units);
                            ?>
                          <div class="row">
                                <!-- incremental button -->
                            <div class="col-12 col-lg-7 col-xl-6 mt-4"></div>
                            <div class="col-12 col-lg-7 col-xl-6 mt-4 order-1"> 
                                  <p class="unitsRemaining" style="font-weight: 600">Units Available</p>
                            </div>

                          </div>

                          <div class="row">


                              <!-- incremental button -->
                              <div class="col-12 col-lg-7 col-xl-6 mt-4 order-5 order-lg-0 justify-content-center justify-content-lg-start"> 
                                    <p class="unitsRemaining text-center text-lg-start" style="font-weight: 600; font-size: 1.6rem"><?php echo $unit_type ?></p>
                              </div>

                              <div class="col-12 col-xl-6 mt-0 mt-lg-0 order-4 order-lg-0"> 
                                <div class="d-flex justify-content-center w-100" style="border: 1px solid #ff5a3d; background-color: #ff5a3d; border-radius: 5px;">
                                    <div class="input-group w-100 justify-content-center align-items-center">
                                      <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-3" data-field="quantity">
                                      <input type="hidden" value="<?php echo $property_id ?>" name="property_id" id="property-id">
                                      <input type="hidden" value="<?php echo $unit_id ?>" name="unit_id" id="unit-id">
                                      <input type="hidden" value="<?php echo $total_units ?>" name="total_units" id="total-units">
                                      <input style="font-size: 2rem" type="number" step="1" max="10" value="<?= $available_units ?>" name="quantity" class="quantity-field form-control-lg border-0 text-center w-50">
                                      <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm mx-3" data-field="quantity">
                                    </div>
                                </div>
                                <button class="save-button btn btn-primary" onclick="saveChanges()">Save Changes</button>
                                <!-- <a href="view.php?property_id=<?= $property_id ?>" class="btnViewIndex">View property</a> -->
                              </div>
                          </div>
                            <?php } ?>
                      </div>
                      <?php if ($propertyCounter % 2 == 1 || $propertyCounter == count($properties) - 1) { ?>   
                  </div>
                      <?php } ?>
                  <?php $propertyCounter++; ?>
              <?php } ?>
              </div>


                  
                  
          </div>
          <div class="col extraContainer"></div>

  </section>

</div>

<!-- Modals -->
<div class="modal fade modalSection" id="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

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
            
        </div>
    </div>
</div>

<!--Appointment Modal-->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-content">
        <!-- Your container with appointment details -->
        <div class="container-fluid">
          <!-- ... Your appointment details content ... -->
        </div>
      </div>
    </div>
  </div>
</div>

<!--Appointment Modal JS-->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var openModalButton = document.getElementById('openModalButton');
    var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));

    $('#openModalButton').click(function() {
        event.preventDefault();
        var userId = $(this).data('userid');
        var date = $(this).data('date');
        var time = $(this).data('time');
        
        performAjax({ 
                user_id: userId,
                date: date, 
                time: time 
            });

        appointmentModal.show();
        
    });

    function performAjax(data) {
            $.ajax({
                url: 'check-indextime',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#modal-content').html(response);
                }
            });
        }

        $('.declineBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior
            var appointmentId = $(this).data('appt'); // Get the appointment_id from data-appt attribute
            declineAppointment({
                decline_appointment: 1,
                appointment_id: appointmentId
            }); // Call the declineAppointment function with appointmentId
        });

        function declineAppointment(data) {
            $.ajax({
                url: 'decline-appointment',
                type: 'POST',
                data: data,
                success: function(response) {
                    alert('Appointment has been declined.');
                }
            });
        }

        $('.confirmBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior
            var reservationId = $(this).data('reserveId'); // Get the appointment_id from data-appt attribute
            confirmReservation({
                confirm_reservation: 1,
                reservation_id: reservationId
            }); // Call the confirmReservation function with appointmentId
        });

        function confirmReservation(data) {
            $.ajax({
                url: 'confirm-reservation',
                type: 'POST',
                data: data,
                success: function(response) {
                    alert('Reservation has been confirmed.');
                }
            });
        }
    
    
  });
  
</script>
<script>
  function toggleSaveButton() {
    var saveButton = document.querySelector('.save-button');
    saveButton.style.display = 'block';
  }
  function saveChanges() {
  }
  document.querySelector('.button-plus').addEventListener('click', toggleSaveButton);
  document.querySelector('.button-minus').addEventListener('click', toggleSaveButton);
</script>
    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/incremental.js"></script>



    </body>
    </html>
  