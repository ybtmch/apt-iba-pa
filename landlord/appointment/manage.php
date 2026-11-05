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
            <!-- Navbar -->

    <?php include('navbar.php'); ?>
  
  <!-- Navbar ends -->

    <?php include('availability-modal.php'); ?>

    

 

    <!-- Footer -->
      <footer class="site-footer">
        <div class="container-fluid">
          <div class="container">
          <div class="row">
              <div class="col-sm-12 col-md-8">
              <h2>APT IBA PA</h2>
                <div class="row">
                  <div class="col-sm-12 col-md-8">
                    <p class="text-justify">
                      Our platform serves as a comprehensive guide, providing a vast database of dormitories and apartments in the area surrounding AUF. Through our interactive map interface, users can easily navigate and explore different locations, allowing them to make informed decisions based on their preferences and requirements.
                    </p>
                  </div>
                </div>
              </div>
  
              <div class="col-xs-6 col-md-2 me-auto pt-4">
              <h6>Pages</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/category/c-language/">Accomodations</a><li>
                  <li>
                  <a href="http://scanfcode.com/category/front-end-development/">About Us</a>
                  </li>
                  <li>
                  <a href="http://scanfcode.com/category/back-end-development/">Apply My Property</a>
              </ul>
              </div>
  
              <div class="col-xs-6 col-md-2 pt-4">
              <h6>Features</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/about/">Favorites</a></li>
                  <li><a href="http://scanfcode.com/contact/">Reserve a Room</a></li>
                  <li>
                  <a href="http://scanfcode.com/contribute-at-scanfcode/">Schedule a Visit</a>
              </ul>
              </div>
          </div>
          <hr />
          </div>
          <div class="container">
          <div class="row">
              <div class="col-md-8 col-sm-6 col-xs-12">
              <p class="copyright-text">
                  Copyright &copy; 2023 All Rights Reserved by
                  <a href="#">APT IBA PA</a>.
              </p>
              </div>
  
              <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                  <li>
                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                  <a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                  </li>
                  <li>
                  <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
              </ul>
              </div>
          </div>
          </div>
        </div>
      </footer>
      
  
      <!-- Footer ends -->
  


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
