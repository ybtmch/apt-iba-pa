<!-- Visit Confirmation Details -->

  <!-- Modal -->
  <div class="modal fade" id="confirmDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="confirmDetailsLabel">Confirmation Details</h1>
        </div>
        <div class="modal-body overflow-x-hidden  modalConfirmDetails">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-4 bgConfirmDetails confirmSlots">

                <!-- <div class="row">
                  <div class="col-12"> -->
                    
                      <img class="rounded img-fluid d-block mx-auto" src="images/hall-img-1.webp" width="400">
                    
                  <!-- </div>
                </div> -->

                <div class="row">
                  <div class="col-md">
                    <h2 class="ms-3 pt-2 mt-3 apptDormName">Batac Dormitory</h2>
                  </div>
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <hr>
                  <h2 class="visitDetailsTitle pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Contact Person
                  </h2>
                  <h2 class="visitDetailsSubtitle">Serena Van Der Woodsen</h2>
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <h2 class="visitDetailsTitle pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Contact Number
                  </h2>
                  <h2 class="visitDetailsSubtitle">+63 935 612 8143</h2>
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <h2 class="visitDetailsTitle">
                    <img src="images/dayzone1.png" alt=""/>
                    Address
                  </h2>
                  <h2 class="visitDetailsSubtitle"> 452 Cuatro de Julio Street, 
                    <br>Barangay Salapungan</h2> <!-- Paghiwalayin yung brgy sa number/street para di masyadong mahaba sa output/UI-->
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <h2 class="visitDetailsTitle">
                    <img src="images/dayzone1.png" alt=""/>
                    Schedule of Visit
                  </h2>
                  <h2 class="visitDetailsSubtitle">5:00 PM to 5:30 PM</h2>
                  <h2 class="visitDetailsSubtitle">29 September, 2023</h2>
                </div>


              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestVisit">Previous</button>
          <button type="button" class="btn btn-primary" class="btnConfirmSuccess" data-bs-toggle="modal" data-bs-target="#confirmSuccess">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirm Details Success -->

  <div class="modal fade" id="confirmSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmSuccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="confirmSuccessLabel">Successful Confirmation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-x-hidden  modalSuccessAppt">

          <div class="container">

            <form>

              <img class="rounded img-fluid d-block mx-auto mt-5" src="images/success-confirmation.png" width="200">

              <!-- Form start -->
              <div class="container pb-5 bgSuccessAppt successSlots">

                <div class="row">
                  <div class="col mb-3">
                    <h2 class="apptGreetings">Appointment Confirmed</h2>
                    <h2 class="apptGreetingsSub">Schedule for visit is lined up!</h2>
                  </div>
                </div>


                <div class="row h3 mt-4 mb-3">
                  <h2 class="successDetailsDate text-center">
                    Sat, 29 September, 2023
                  </h2>
                  <h2 class="successDetailsTime text-center">8:00 AM to 8:30 AM</h2>
                </div>
                
                <div class="row h3 d-flex justify-content-center mt-5">
                  <div class="col-10 col-md-9 d-flex justify-content-center">
                    <button type="button" class="btn w-100 btnConfirmApptGC"><i class="fa-light fa-calendar me-2"></i>Add to Google Calendar</button>
                  </div>
                </div>

                <div class="row h3 d-flex justify-content-center mt-2">
                  <div class="col-10 col-md-9 d-flex justify-content-center">
                    <button type="button" class="btn w-100 btnConfirmApptGo">Go to Appointments</button>
                  </div>
                </div>
              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>