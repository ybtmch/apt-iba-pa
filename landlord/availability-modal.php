<?php
use Models\Availability;
use Models\Property;

include ("../init.php");
$user_id = $_SESSION['user_id'];

$properties = new Property();
$properties->setConnection($connection);
$properties = $properties->getProperty($user_id);

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link href="css/appointments_view.css" rel="stylesheet" /> -->
</head>
<body style="background-color: #f2f6f7">
     <!-- View Appointment title/date starts -->

     <div class="container-fluid">
        <section class="appointments">
  
            <div class="row">
              <div class="col-md">
                <h1 class="p-3 viewAppoint">View <strong>Appointments</strong></h1>
              </div>
            </div>

            <div class="row justify-content-center ">
              <div class="col-12">
                
                  <h2 class="ms-3 apptDate" id="selected_date">No Date Selected</h2>
              </div>

                  <!-- <div class="row justify-content-center"> -->
                      <div class="col-12 col-sm-6 col-xl-3 mt-3">
                          <form action="#">
                          <h2 class="text-center">*You can pick the date by clicking the button below.</h2>
                          
                          <div class="form-group p-3 datePicker">
                              <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                          </div>
                      </div>
            </div>
              

                <!-- <div class="col-md-6">
                    

                    <div class="row justify-content-center">
                        <div class="col-md-3 mt-3">
                            
                            
                            <div class="form-group p-3">
                                <select name="property" id="propertySelect">
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
                    </div>
                </div> -->
            </div>

        </section>
      </div>
      
    <!-- View Appointment title/date ends -->

    <!-- View Appointment title/date ends -->

    

    <div class="container">

      <div class="row wrapper  justify-content-between ">
      
                    
        
            <div class="col-md-6 col-lg-4 mt-3">
                <form>
                  <div class="form-group p-3">
                    <select style="border-radius:5px;  height:30px; font-size: 15px;" name="property" id="propertySelect" class="w-100">
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
        
                    
                

        <div class="col-12 col-lg-8 col-xl-auto d-lg-block ps-0">
        
          
          <div class="d-flex justify-content-lg-start justify-content-md-center align-items-center my-2 bg-light checkbox border"> 

            <div class="row">
              <div class="col-md-12 d-none d-md-block justify-content-end">

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="selectedRadio" value="option1" disabled>
                      <label class="form-check-label" for="selectedRadio">Selected time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="morningRadio" value="option1" disabled>
                      <label class="form-check-label" for="morningRadio">All Morning time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="afternoonRadio" value="option2" disabled>
                      <label class="form-check-label" for="afternoonRadio">All Afternoon time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="eveningRadio" value="option3" disabled>
                      <label class="form-check-label" for="eveningRadio">All Evening time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="allRadio" value="option4" disabled>
                      <label class="form-check-label" for="allRadio">Whole day</label>
                    </div>

                  
                      <button type="button" id="disable_time" name="disable_time" class="btn text-end" onclick="disableTime()">Disable</button>
                   

              </div>

                <div class="col-12 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="selectedRadio" value="option1">
                    <label class="form-check-label" for="selectedRadio" disabled>Selected time</label>
                  </div>
                </div>

                <div class="col-12 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="morningRadio" value="option1" disabled>
                    <label class="form-check-label" for="morningRadio">All Morning time</label>
                  </div>
                </div>

                <div class="col-12 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="afternoonRadio" value="option2" disabled>
                    <label class="form-check-label" for="afternoonRadio">All Afternoon time</label>
                  </div>
                </div>

                <div class="col-12 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="eveningRadio" value="option3" disabled>
                    <label class="form-check-label" for="eveningRadio">All Evening time</label>
                  </div>
                </div>

                <div class="col-12 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="allRadio" value="option4" disabled>
                    <label class="form-check-label" for="allRadio">Whole day</label>
                  </div>
                </div>
                
                <div class="col-12 d-block d-md-none">
                  <button type="button" id="disable_time" name="disable_time" class="btn mt-2" onclick="disableTime()">Disable</button>
                </div>

            </div>


          </div>
        </div>


      </div>
    </div>
        <!-- Time slots starts -->
      <div class="container pt-5 pb-5 bgTimeSlots timeSlots">
      <div id="time_slots">
      <form id="disableForm">
      <input type="hidden" name="date" value="<?= $date ?>" id="date">
    <div class="row ps-4 h3">
          <h2 class="dayzone">
            <img src="resources/images/dayzone1.png" alt=""/>
            Morning
          </h2>
          <h2 class="timezone">6:00 AM to 11:30 AM</h2>
        </div>

          <div class="row pt-5 justify-content-center">

          <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="6" name="time_slots[]" value="6:00 AM" disabled>  
                <label for="6" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 6:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="63" name="time_slots[]" value="6:30 AM" disabled>  
                <label for="63" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 6:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
            <input type="checkbox" id="7" name="time_slots[]" value="7:00 AM" disabled>  
                <label for="7" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
            <input type="checkbox" id="73" name="time_slots[]" value="7:30 AM" disabled>  
                <label for="73" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">
            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="8" name="time_slots[]" value="8:00 AM" disabled>  
                <label for="8" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="83" name="time_slots[]" value="8:30 AM" disabled>  
                <label for="83" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:30 AM
                </label>
            </div>

        

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="9" name="time_slots[]" value="9:00 AM" disabled>  
                <label for="9" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="93" name="time_slots[]" value="9:30 AM" disabled>  
                <label for="93" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:30 AM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="10" name="time_slots[]" value="10:00 AM" disabled>  
                <label for="10" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="103" name="time_slots[]" value="10:30 AM" disabled>  
                <label for="103" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="11" name="time_slots[]" value="11:00 AM" disabled>  
                <label for="11" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 11:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="113" name="time_slots[]" value="11:30 AM" disabled>  
                <label for="113" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 11:30 AM
                </label>
            </div>

          </div>
        
        <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="resources/images/dayzone2.png" alt=""/>
            Afternoon
          </h2>
          <h2 class="timezone">1:00 PM to 5:30 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="12" name="time_slots[]" value="12:00 PM" disabled>  
                  <label for="12" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 12:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="123" name="time_slots[]" value="12:30 PM" disabled>  
                  <label for="123" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 12:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="1" name="time_slots[]" value="1:00 PM" disabled>  
                <label for="1" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="1:30 PM" disabled>  
                <label for="13" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="2" name="time_slots[]" value="2:00 PM" disabled>  
                  <label for="2" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="23" name="time_slots[]" value="2:30 PM" disabled>  
                  <label for="23" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:30 PM
                  </label>
            </div>

           <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="3" name="time_slots[]" value="3:00 PM" disabled>  
                <label for="3" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="33" name="time_slots[]" value="3:30 PM" disabled>  
                <label for="33" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:30 PM
                </label>
            </div>

        </div>
        <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="4" name="time_slots[]" value="4:00 PM" disabled>  
                  <label for="4" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="43" name="time_slots[]" value="4:30 PM" disabled>  
                  <label for="43" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:30 PM
                  </label>
            </div>

          <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="5" name="time_slots[]" value="5:00 PM" disabled>  
                <label for="5" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="53" name="time_slots[]" value="5:30 PM" disabled>  
                <label for="53" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:30 PM
                </label>
            </div>

            </div>

            <div class="row ps-4 h3 mt-5">
          <hr>
          <h2 class="dayzone pt-4">
            <img src="resources/images/dayzone3.png" alt=""/>
            Evening
          </h2>
          <h2 class="timezone">6:00 PM to 8:00 PM</h2>
        </div>
          <div class="row pt-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="12" name="time_slots[]" value="6:00 PM" disabled>  
                  <label for="12" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 6:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="123" name="time_slots[]" value="6:30 PM" disabled>  
                  <label for="123" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 6:30 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="1" name="time_slots[]" value="7:00 PM" disabled>  
                <label for="1" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="7:30 PM" disabled>  
                <label for="13" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 7:30 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="13" name="time_slots[]" value="8:00 PM" disabled>  
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
</div>
</form>
    <!-- Time slots ends -->

    <script>
    $(document).ready(function() {

        // selectedRadio.disabled = true;
        // morningRadio.disabled = true;
        // afternoonRadio.disabled = true;
        // eveningRadio.disabled = true;
        // allRadio.disabled = true;

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
            
            var selectedRadio = $('#selectedRadio');
            var morningRadio = $('#morningRadio');
            var afternoonRadio = $('#afternoonRadio');
            var eveningRadio = $('#eveningRadio');
            var allRadio = $('#allRadio');

            
            selectedRadio.prop('disabled', false);
            morningRadio.prop('disabled', false);
            afternoonRadio.prop('disabled', false);
            eveningRadio.prop('disabled', false);
            allRadio.prop('disabled', false);

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

        var disableButton = ('#disable_time');

        function disableTime(){
            var disableForm = ('#disableForm');
            var disableRadios = document.querySelectorAll('input[name="time_slots[]"]:not(:disabled)');
            //alert(disableRadios);
        }

    });

    </script>
</body>
</html>