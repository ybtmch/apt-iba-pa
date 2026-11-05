<?php
use Models\Availability;
use Models\Property;

include ("../init.php");
include ("session.php");

$user_id = $_SESSION['user_id'];

$properties = new Property();
$properties->setConnection($connection);
$properties = $properties->getProperty($user_id);



if(isset($_GET['property'])) {
    $property_id = $_GET['property'];
    $available_slots = new Availability();
    $available_slots->setConnection($connection);
    $available_slots = $available_slots->getAvailableSlots($user_id, $property_id);

    if($available_slots){
        $time_slots = $available_slots['time_slots'];
        $time_slots_array = explode(', ', $time_slots);
    } else {
        $time_slots_array = array();
    }

    $six_am = in_array('6:00 AM', $time_slots_array) ? 'checked' : '';
    $six30_am = in_array('6:30 AM', $time_slots_array)  ? 'checked' : '';
    $seven_am = in_array('7:00 AM', $time_slots_array)  ? 'checked' : '';
    $seven30_am = in_array('7:30 AM', $time_slots_array)  ? 'checked' : '';
    $eight_am = in_array('8:00 AM', $time_slots_array)  ? 'checked' : '';
    $eight30_am = in_array('8:30 AM', $time_slots_array)  ? 'checked' : '';
    $nine_am = in_array('9:00 AM', $time_slots_array)  ? 'checked' : '';
    $nine30_am = in_array('9:30 AM', $time_slots_array)  ? 'checked' : '';
    $ten_am = in_array('10:00 AM', $time_slots_array)  ? 'checked' : '';
    $ten30_am = in_array('10:30 AM', $time_slots_array)  ? 'checked' : '';
    $eleven_am = in_array('11:00 AM', $time_slots_array)  ? 'checked' : '';
    $eleven30_am = in_array('11:30 AM', $time_slots_array)  ? 'checked' : '';
    $twelve_pm = in_array('12:00 PM', $time_slots_array)  ? 'checked' : '';
    $twelve30_pm = in_array('12:30 PM', $time_slots_array)  ? 'checked' : '';
    $one_pm = in_array('1:00 PM', $time_slots_array)  ? 'checked' : '';
    $one30_pm = in_array('1:30 PM', $time_slots_array)  ? 'checked' : '';
    $two_pm = in_array('2:00 PM', $time_slots_array)  ? 'checked' : '';
    $two30_pm = in_array('2:30 PM', $time_slots_array)  ? 'checked' : '';
    $three_pm = in_array('3:00 PM', $time_slots_array)  ? 'checked' : '';
    $three30_pm = in_array('3:30 PM', $time_slots_array)  ? 'checked' : '';
    $four_pm = in_array('4:00 PM', $time_slots_array)  ? 'checked' : '';
    $four30_pm = in_array('4:30 PM', $time_slots_array)  ? 'checked' : '';
    $five_pm = in_array('5:00 PM', $time_slots_array)  ? 'checked' : '';
    $five30_pm = in_array('5:30 PM', $time_slots_array)  ? 'checked' : '';
    $six_pm = in_array('6:00 PM', $time_slots_array)  ? 'checked' : '';
    $six30_pm = in_array('6:30 PM', $time_slots_array)  ? 'checked' : '';
    $seven_pm = in_array('7:00 PM', $time_slots_array)  ? 'checked' : '';
    $seven30_pm = in_array('7:30 PM', $time_slots_array)  ? 'checked' : '';
    $eight_pm = in_array('8:00 PM', $time_slots_array)  ? 'checked' : '';
    
} else {
    $time_slots_array = array();
    $six_am = in_array('6:00 AM', $time_slots_array) ? 'checked' : 'disabled';
    $six30_am = in_array('6:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $seven_am = in_array('7:00 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $seven30_am = in_array('7:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $eight_am = in_array('8:00 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $eight30_am = in_array('8:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $nine_am = in_array('9:00 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $nine30_am = in_array('9:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $ten_am = in_array('10:00 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $ten30_am = in_array('10:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $eleven_am = in_array('11:00 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $eleven30_am = in_array('11:30 AM', $time_slots_array)  ? 'checked' : 'disabled';
    $twelve_pm = in_array('12:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $twelve30_pm = in_array('12:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $one_pm = in_array('1:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $one30_pm = in_array('1:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $two_pm = in_array('2:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $two30_pm = in_array('2:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $three_pm = in_array('3:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $three30_pm = in_array('3:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $four_pm = in_array('4:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $four30_pm = in_array('4:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $five_pm = in_array('5:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $five30_pm = in_array('5:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $six_pm = in_array('6:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $six30_pm = in_array('6:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $seven_pm = in_array('7:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $seven30_pm = in_array('7:30 PM', $time_slots_array)  ? 'checked' : 'disabled';
    $eight_pm = in_array('8:00 PM', $time_slots_array)  ? 'checked' : 'disabled';
}


if(isset($_POST['update_time'])){
    $time_slots = implode(", ", $_POST['time_slots']);
    $status = 1;
    $available = new Availability();
    $available->setConnection($connection);
    $available = $available->updateAvailableSlots($property_id, $time_slots, $status);

    if($available){
        echo '<script>alert("Available time slots updated."); window.location.href="manage-available?property=' . $property_id . '";</script>';
        exit();
    }
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

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">


  </head>
  <body style="background-color: #f2f6f7">

    <?php include('navbar.php'); ?>

    
<div class="container-fluid">
    <section class="appointments">

        <div class="row">
            <div class="col-md">
            <h1 class="p-3 viewAppoint">Manage <strong>Availability for Appointments</strong></h1>
            </div>
        </div>
        <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <h2 class="text-center">*Select the property you want to check.</h2>
                        <form id="propertyForm">
                        <div class="form-group p-3 d-flex justify-content-center">
                            <select style="border-radius:5px; width:70%; height:30px; border:1.5px solid black; font-size:15px;" name="property" id="propertySelect">
                                <option selected disabled>Choose a property</option>
                                <?php 
                                foreach ($properties as $property){
                                    $property_name = $property['property_name'];
                                    $property_id = $property['property_id'];
                                ?>
                                <option name="property_id" value="<?php echo $property_id ?>"><?php echo $property_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </form>
                    </div>
                </div>

    </section>
</div>
      
 <!-- View Appointment title/date ends -->
<form action="manage-available?property=<?php echo $property_id ?>" method="POST">
    <!-- Time slots starts -->
      <div class="container pt-5 pb-5 bgTimeSlots timeSlots">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                <h2 class="textInstruc">*You can disable the time that you are unavailable by clicking the buttons below.</h2>
                </div>

                        <div class="col-lg-4 d-none d-lg-block text-end wrapper">
                          <button type="button" class="btn" name="reset_time" id="reset_time" onclick="reloadPage()">Reset</button>
                          <button type="submit" class="btn" name="update_time">Update</button>
                        </div>

                        <div class="row wrapper">

                            <div class="col-12 col-md-6 d-block d-lg-none">
                              <button type="button" class="btn mt-2 w-100" name="reset_time" id="reset_time" onclick="reloadPage()">Reset</button>
                            </div>
                            <div class="col-12 col-md-6 d-block d-lg-none">
                              <button type="submit" class="btn mt-2 w-100" name="update_time">Update</button>
                            </div>

                        </div>


                    <!-- </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row ps-4 h3">
          <h2 class="dayzone">
            <img src="images/dayzone1.png" alt=""/>
            Morning
          </h2>
          <h2 class="timezone">6:00 AM to 11:30 AM</h2>
        </div>

          <div class="row pt-5 justify-content-center">

          <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="6" name="time_slots[]" value="6:00 AM" <?= $six_am ?>>  
                <label for="6" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 6:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="63" name="time_slots[]" value="6:30 AM" <?= $six30_am ?>>  
                <label for="63" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 6:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
            <input type="checkbox" id="7" name="time_slots[]" value="7:00 AM" <?= $seven_am ?>>  
                <label for="7" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
            <input type="checkbox" id="73" name="time_slots[]" value="7:30 AM" <?= $seven30_am ?>>  
                <label for="73" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="8" name="time_slots[]" value="8:00 AM" <?= $eight_am ?>>  
                <label for="8" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="83" name="time_slots[]" value="8:30 AM" <?= $eight30_am ?>>  
                <label for="83" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:30 AM
                </label>
            </div>

        

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="9" name="time_slots[]" value="9:00 AM" <?= $nine_am ?>>  
                <label for="9" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="93" name="time_slots[]" value="9:30 AM" <?= $nine30_am ?>>  
                <label for="93" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="10" name="time_slots[]" value="10:00 AM" <?= $ten_am ?>>  
                <label for="10" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="103" name="time_slots[]" value="10:30 AM" <?= $ten30_am ?>>  
                <label for="103" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="11" name="time_slots[]" value="11:00 AM"  <?= $eleven_am ?>>  
                <label for="11" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 11:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="113" name="time_slots[]" value="11:30 AM" <?= $eleven30_am ?>>  
                <label for="113" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 11:30 AM
                </label>
            </div>

          </div>
        
        <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="images/dayzone2.png" alt=""/>
            Afternoon
          </h2>
          <h2 class="timezone">1:00 PM to 5:30 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="12" name="time_slots[]" value="12:00 PM"  <?= $twelve_pm ?>>  
                  <label for="12" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 12:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="123" name="time_slots[]" value="12:30 PM" <?= $twelve30_pm ?>>  
                  <label for="123" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 12:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="1" name="time_slots[]" value="1:00 PM" <?= $one_pm ?>>  
                <label for="1" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="1:30 PM" <?= $one30_pm ?>>  
                <label for="13" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="2" name="time_slots[]" value="2:00 PM"  <?= $two_pm ?>>  
                  <label for="2" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="23" name="time_slots[]" value="2:30 PM"  <?= $two30_pm ?>>  
                  <label for="23" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:30 PM
                  </label>
            </div>

           <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="3" name="time_slots[]" value="3:00 PM"  <?= $three_pm ?>>  
                <label for="3" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="33" name="time_slots[]" value="3:30 PM"  <?= $three30_pm ?>>  
                <label for="33" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="4" name="time_slots[]" value="4:00 PM"  <?= $four_pm ?>>  
                  <label for="4" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="43" name="time_slots[]" value="4:30 PM"  <?= $four30_pm ?>>  
                  <label for="43" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:30 PM
                  </label>
            </div>

          <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="5" name="time_slots[]" value="5:00 PM"  <?= $five_pm ?>>  
                <label for="5" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="53" name="time_slots[]" value="5:30 PM"  <?= $five30_pm ?>>  
                <label for="53" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:30 PM
                </label>
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
              <input type="checkbox" id="12" name="time_slots[]" value="6:00 PM"  <?= $six_pm ?>>  
                  <label for="12" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 6:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="123" name="time_slots[]" value="6:30 PM"  <?= $six30_pm ?>>  
                  <label for="123" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 6:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="1" name="time_slots[]" value="7:00 PM"  <?= $seven_pm ?>>  
                <label for="1" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="7:30 PM"  <?= $seven30_pm ?>>  
                <label for="13" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="8:00 PM"  <?= $eight_pm ?>>  
                <label for="13" class="btn btn-outline-secondary">
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
    <!-- Time slots ends -->

    <?php include('footer.php'); ?>

    <script>
function reloadPage() {
        location.reload();
    }

$(document).ready(function() {
    $('#propertySelect').change(function() {
        // Submit the form when an option is selected
        $('#propertyForm').submit();
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