<?php

// FOR USER WHEN SELECTING APPOINTMENT DATES

use Models\Schedule;
use Models\Appointment;

include ("../init.php");
include ("session.php");

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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa | Manage Availability</title>
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

    <link href="css/appointments_edit.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />

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
    

    <!-- Date Picker -->
    
    <link rel="stylesheet" href="css/datepicker_css/default.css">
    <link rel="stylesheet" href="css/datepicker_css/default.date.css">

    
    <!-- Style -->
    <link rel="stylesheet" href="css/datepicker_css/datepicker.css">

  </head>
  <body>

    <?php include('navbar.php'); ?>

    <?php include('availability-modal.php'); ?>

    <?php include('footer.php'); ?>

    <script>
    $(document).ready(function() {
        var pickDateInput = $("#pick-date");
        var selectedDateH2 = $("#selected_date");

        $('#propertySelect').change(function() {
            var selectedValue = $(this).val();
            updateSelectedDate();
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

            checkDate({ 
                property_id: propertySelect,
                set_date: inputDate, 
            });
        }
        // pickDateInput.trigger('change');
        pickDateInput.on('change', updateSelectedDate);

        function checkDate(data) {
            $.ajax({
                url: 'check-unavailable',
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


            
<!-- Date Picker -->

<script src="js/datepicker_js/jquery-3.3.1.min.js"></script>
<script src="js/datepicker_js/popper.min.js"></script>
<script src="js/datepicker_js/bootstrap.min.js"></script>
<script src="js/datepicker_js/picker.js"></script>
<script src="js/datepicker_js/picker.date.js"></script>

<script src="js/datepicker_js/main-datepicker.js"></script>



</html>
