<!-- View Appointment title/date starts -->

<div class="container-fluid">
        <section class="appointments">
  
            <div class="row">
              <div class="col-md">
                <h1 class="p-3 viewAppoint">Manage <strong>Availability of Appointments</strong></h1>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <h2 class="ms-3 apptDate">August 04, 2023</h2>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-3 mt-3">
                <form action="#">
                  <div class="form-group p-3 datePicker">
                    <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                  </div>
                </form>
              </div>
            </div>

        </section>
      </div>
      
    <!-- View Appointment title/date ends -->

    <div class="container">
      <div class="row">
        <h2 class="textInstruc">*You can disable the time that you are unavailable by clicking the buttons below.</h2>
      </div>
    </div>

    <div class="container">

      <div class="row wrapper">

        <div class="col-12 col-lg-auto col-xl-auto d-lg-block ps-0">
          <label class="filterTitle">Select:</label>
          <div class="d-flex justify-content-lg-start justify-content-md-center align-items-center my-2 bg-light checkbox border"> 

            <div class="row">

              <div class="col-md-12 d-none d-md-block">

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1">Selected time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                      <label class="form-check-label" for="inlineRadio2">All Morning time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                      <label class="form-check-label" for="inlineRadio3">All Afternoon time</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                      <label class="form-check-label" for="inlineRadio4">Whole day</label>
                    </div>

                   
                      <button type="button" class="btn">Disable</button>
                   

              </div>

                <div class="col-6 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Selected time</label>
                  </div>
                </div>

                <div class="col-6 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">All Morning time</label>
                  </div>
                </div>

                <div class="col-6 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">All Afternoon time</label>
                  </div>
                </div>

                <div class="col-6 d-block d-md-none">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">Whole day</label>
                  </div>
                </div>
                
                <div class="col-6 d-block d-md-none">
                  <button type="button" class="btn mt-2">Disable</button>
                </div>

            </div>


          </div>
        </div>



      </div>
    </div>

    <!-- Time slots starts -->
      <div class="container pt-5 pb-5 bgTimeSlots timeSlots">
        <div class="row ps-4 h3">
          <h2 class="dayzone">
            <img src="images/dayzone1.png" alt=""/>
            Morning
          </h2>
          <h2 class="timezone">8:00 AM to 11:30 AM</h2>
        </div>

          <div class="row pt-5 justify-content-center">

          <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="8">  
                <label for="8" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="83">  
                <label for="83" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 8:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="9">  
                <label for="9" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="93">  
                <label for="93" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 9:30 AM
                </label>
            </div>

          </div>



          <div class="row pt-5 pb-5 justify-content-center">

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="10">  
                <label for="10" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
            <input type="checkbox" id="103">  
                <label for="103" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 10:30 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="11">  
                <label for="11" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 11:00 AM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="113">  
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
              <input type="checkbox" id="1">  
                <label for="1" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="13">  
                <label for="13" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 1:30 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="2">  
                  <label for="2" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="23">  
                  <label for="23" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 2:30 PM
                  </label>
            </div>

          </div>
          <div class="row pt-5 justify-content-center">

           <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="3">  
                <label for="3" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="33">  
                <label for="33" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 3:30 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="4">  
                  <label for="4" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:00 PM
                  </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center">
              <input type="checkbox" id="43">  
                  <label for="43" class="btn btn-outline-secondary">
                    <i class="fa-regular fa-clock me-1"></i> 4:30 PM
                  </label>
            </div>

          </div>
          <div class="row pt-5">

          <div class="col-5 col-sm-3 col-lg-2"></div>
          <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="5">  
                <label for="5" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:00 PM
                </label>
            </div>

            <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center">
              <input type="checkbox" id="53">  
                <label for="53" class="btn btn-outline-secondary">
                  <i class="fa-regular fa-clock me-1"></i> 5:30 PM
                </label>
            </div>


          </div>
      </div>

    <!-- Modals -->
    <div class="modal fade modalSection" id="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Disabling the availability</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="h6">Are you sure you want to disable this?</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>


    <!-- Time slots ends -->