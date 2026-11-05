<!-- User appointments page -->
<?php
use Models\Appointment;
include "init.php";
include "session.php";

if(!isset($user_id)){
    header('location: index.php');
    exit();
} 

$appointments = new Appointment();
$appointments->setConnection($connection);
$appointments = array_reverse($appointments->getUserAppointments($user_id));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Appointments</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <!-- Script of Reservations confirm/decline -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

    <!-- Bootstrap Carousel CSS -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
      integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
      crossorigin="anonymous"
    />

    <link href="css/appointments.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

    <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
  </head>
  <body style="background-color: #f2f6f7">
    <!-- Navbar -->

    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>

  
      <!-- Navbar ends -->

    <!-- Featured section starts -->
    <?php if(count($appointments) != 0){?>
    <div class="container-fluid reservationBg">
        <section class="reservations">
          <div class="container-md">
            <div class="row">
                <div class="col-md-2"></div>
              <div class="col-md-4">
                <h1 class="text-center text-sm-start myApt"><strong>Appointments</strong></h1>
              </div>
            </div>

            <div class="box-container">
              <div class="row gx-5 mb-3 d-flex justify-content-center">

              <?php foreach($appointments as $appointment){ 
                $property_id = $appointment['property_id'];
                $appointment_id = $appointment['appointment_id'];
                $appointment_number = $appointment['appointment_number'];
                $property_type = $appointment['property_type'];
                $property_name = $appointment['property_name'];
                $status = $appointment['status'];
                $full_address = $appointment['property_number'] . ', ' . $appointment['street'] . ', ' . $appointment['barangay'] . ', ' . $appointment['city'];
                $date = date("F j, Y", strtotime($appointment['date']));
                $time = $appointment['time'];

                $datetime_str = $appointment['date'] . " " . $time;
                $timestamp = strtotime($datetime_str);
                $current_timestamp = time();
                
                ?>
                <div class="col-12 col-sm-7 col-xl-8">
                  <div class="box">
                    <div class="row"> 
                        <div class="col pt-3 ms-md-4 ps-md-3">
                            <p class="type"><span><?= $property_type?></span></p>
                            <h3 class="apptNum"><?= $appointment_number ?></h3>
                            <h3 class="name"><i class="fa-solid fa-location-dot"></i> <a href="view.php?<?= $property_id ?>" style="text-decoration: none; color: inherit;"><?= $property_name ?></a> </h3>
                            <h3 class="address"><?= $full_address ?></h3>
                        </div>

                        <!-- <a type="button" class="btn btn-primary btnCancel"  data-bs-toggle="modal" data-bs-target="#cancelAppointment" data-id=' . $appointment_id . ' id="cancelBtn">Cancel</a> -->

                        <div class="col-6 col-md-4">
                        <div class="col mt-4 mt-md-3 pt-3 pt-md-4">
                            <?php if ($timestamp > $current_timestamp && $status !=2) {
                                    
                                    echo '<p class="statusU text-center"><span>Upcoming</span></p>';
                                    echo '<button type="button" class="btn btn-primary btnCancel"  data-bs-toggle="modal" data-bs-target="#cancelAppointment" data-id=' . $appointment_id . ' id="cancelBtn">Cancel</button>';
                                } elseif($status == 2){
                                    echo '<p class="statusC text-center"><span>Cancelled</span></p>';
                                } else {
                                    echo '<p class="statusF text-center"><span>Finished</span></p>';
                                } ?>
                            <h3 class="date text-center"><?= $date ?></h3>
                            <h3 class="time text-center"><?= $time ?></h3>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

                <?php } ?>
                  

              </div>
            </div>


          </div>
        </section>

        <div class="col extraContainer"></div>

    </div>
  
    <?php

} else {
?>

    <div class="container-fluid reservationBg">
        <section class="reservations">
  
          <div class="container-md">
            <div class="row">
                <div class="col-md-1"></div>
              <div class="col-md-4">
                <h1 class="text-center text-sm-start myApt"><strong>Appointments</strong></h1>
              </div>
            </div>

            <div class="box-container">
              <div class="row gx-5 mb-3 d-flex justify-content-center">

                <div class="col-12 col-sm-6 col-xl-8 mt-5 pt-5">
                  <div class="box">
                    <div class="row">
                        <div class="col ms-md-4 ps-md-3 text-center">
                            <img src="resources/images/icon36.png" class="rounded opacity-50 img-fluid " alt="..." >
                            <h3 class="noApptYet mt-5">No appointments added, yet</h3>
                            <h5 class="subtitleNoAppt">You currently have no scheduled property visits </h5>
                        </div>

                      </div>

                    </div>

                  </div>
                </div>

            </div>

          </div>
        </section>

        <div class="col emptyContainer"></div>


    </div>


<?php } ?>


      <!-- Featured ends -->

      <!-- Modals -->
      <div class="modal fade modalSection" id="cancelAppointment" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cancel Appointment</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="h6">Are you sure you want to cancel this appointment?</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="set-appointment" method="POST">
                <input type="hidden" name="appointment_id" id="appointment-id">
                <button id="yesButton" name="cancel_appointment" type="submit" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Footer -->

    <?php include('footer.php'); ?>
  
      <!-- Footer ends -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        var cancelBtn = $('#cancelBtn');

        cancelBtn.on('click', function() {
            var ApptId = $(this).data('id'); // Retrieve the value of data-id
            var appointmentId = $('#appointment-id');
            appointmentId.val(ApptId);
            $('#cancelAppointment').modal('show');
        });
    });
        
    </script>
  </body>


  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>



  <!-- JS of Carousel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
      integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
      crossorigin="anonymous"></script>
  <script>
      $('.carousel-container').owlCarousel({
          loop: false,
          margin: 15,
          nav: true,
          navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                   "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
          responsive: {
              0: {
                  items: 1
              },
              600: {
                  items: 2
              },
              1000: {
                  items: 3
              }
          }
      })

      $('.testimonials-container').owlCarousel({
        loop:true,
        autoplay:false,
        autoplayTimeout:6000,
        margin:10,
        nav:true,
        navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1,
                nav:true
            },
            768:{
                items:2
            },
        }
        })
  </script>

              
            <!--   *****   JQuery Link   *****   -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            
            <!--   *****   Owl Carousel js Link  *****  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</html>

