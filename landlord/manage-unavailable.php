<?php

use Models\Schedule;
use Models\Appointment;
use Models\Availability;

include ("../init.php");
include ("session.php");

$landlord_id = $_SESSION['user_id'];

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

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">

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

        function disableTime(){
            var disableForm = $('#disableForm');
            var disableRadios = document.querySelectorAll('input[name="time_slots[]"]:checked:not(:disabled)');
            var selectedValues = Array.from(disableRadios).map(radio => radio.value).join(', ');
            
             // Prepare the data to be sent
            var formData = new FormData();
            formData.append('disable_time', 1);
            formData.append('time_slots', selectedValues);

            // Send a POST request using the fetch API
            fetch('manage-unavailable.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                // Handle the response as needed
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // or response.json() if your PHP script returns JSON
            })
            .then(data => {
                // Handle the data returned by the PHP script
                console.log(data);
            })
            .catch(error => {
                // Handle errors
                console.error('There was a problem with the fetch operation:', error);
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
