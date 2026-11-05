<!-- First Page for Apply Property -->
<?php 
include ("init.php");
include ("session.php");

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Contact Us</title>
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
        <link href="css/contactUs.css" rel="stylesheet" />
        <link href="css/all.css" rel="stylesheet" />

        <!-- Vendor Files -->
        <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
        <meta name="theme-color" content="#7952b3">

        <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">


    </head>
    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  <body>
    <!-- Navbar -->

    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>


    <!-- Navbar ends -->
  

    <!-- ======= Services Section ======= -->
    
    <section id="services" class="services section-bg pt-5 pt-lg-5">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <p class="statusU text-center"><span>KOMUNIDAD</span></p>
            <h2 class="mt-4">Reach Us Out!</h2>
            <p>
              Should you have any inquiries or require assistance, our dedicated support team is here to help. Feel free to reach out to us using the contact details below:
            </p>
          </div>
  
          <div class="row">

  
            <div class="col-12 col-lg-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-regular fa-users fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>

                <h4><a href="">For Tenants</a></h4>

                <div class="">
                  <p class="contactDetails"><span class="strong"> Email: </span> hello.tenants@gmail.com</p>
                  <p class="contactDetails"><span class="strong"> Phone Number: </span> (+63) 9534870851</p>
                </div>

              </div>
            </div>
  
            <div class="col-12 col-lg-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-regular fa-house-user fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>

                <h4><a href="">For Landlords</a></h4>

                <div class="row">
                
                  <div class="col-12">
                    <div class="contactDetails"><span class="strong"> Email: </span>hello.landlords@gmail.com</div>
                  </iv>

                  <div class="col-12">
                    <div class="contactDetails"><span class="strong"> Phone Number: </span> (+63) 9534870851</div>
                  </div>
                
                </div>

              </div>
            </div>
  

  
          </div>
  
        </div>
      </section>
    <!-- End Services Section -->


    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1 mb-5 pb-5">

                <div class="content">
                    <h3><strong>FEEDBACK</strong> matters!</h3>
                    <p>Your input matters, and we've made it easy for you to share your thoughts.</p>

                    <form class="row g-3 needs-validation mt-5" id="feedbackForm" action="feedback" method="POST">
                      <div class="col-12">
                        <label for="toDo" class="form-label">What would you like to do?</label>
                        <select id="toDo" class="form-select" name="feedback_type" onchange="enableWhichPart()" required 
                        oninvalid="this.setCustomValidity('Please select what you would like to do.')"
                        oninput="setCustomValidity('')">

                            <option value="" selected disabled>Select an option</option>
                            <option value="1" >Give Feedback</option>
                            <option value="2" >Request a Feature</option>
                            <option value="3" >Report a Bug</option>
                        </select>
                        <div class="invalid-feedback" id="invalidFeedbackToDo">Please select what you would like to do.</div>
                      </div>

                      <div class="col-12">
                          <label for="whichPart" class="form-label">Which part of the platform?</label>
                          <select id="whichPart" class="form-select" name="feedback_part"onchange="showSections()" required disabled 
                          oninvalid="this.setCustomValidity('Please select which part of the platform.')"
                          oninput="setCustomValidity('')">
                              <option value="" selected disabled>Select which part</option>
                              <option option value="1" >User Side - Tenants/Potential Tenants</option>
                              <option option value="2" >User Side - Landlords</option>
                          </select>
                          <div class="invalid-feedback" id="invalidFeedbackWhichPart">Please select which part of the platform.</div>
                      </div>

                        <!-- tenants/potential tenants -->
                        <div class="col-12" id="tenantSection" style="display: none;">
                          <label for="whichPageTenant" class="form-label">Which page?</label>
                          <select id="whichPageTenant" class="form-select" name="feedback_page" required 
                          oninvalid="this.setCustomValidity('Please select which page.')"
                          oninput="setCustomValidity('')">
                                <option selected disabled>Select page</option>
                                <option option value="1" >Dashboard</option>
                                <option option value="2" >Accommodations</option>
                                <option option value="3" >Wishlists</option>
                                <option option value="4" >Visit Appointments</option>
                                <option option value="5" >Reservations</option>
                                <option option value="6" >Reservations' Transaction</option>
                                <option option value="7" >My Profile</option>
                            </select>
                            <div class="invalid-feedback" id="invalidFeedbackWhichPageTenant">Please select which page.</div>
                        </div>

                        <!-- landlords -->
                        <div class="col-12" id="landlordSection" style="display: none;">
                          <label for="whichPageLandlord" class="form-label">Which page?</label>
                          <select id="whichPageLandlord" name="feedback_page" class="form-select" required
                          oninvalid="this.setCustomValidity('Please select which page.')"
                          oninput="setCustomValidity('')">
                                <option selected disabled>Select page</option>
                                <option option value="1" >Dashboard</option>
                                <option option value="2" >My Properties</option>
                                <option option value="3" >My Property FAQs</option>
                                <option option value="4" >Visit Appointments</option>
                                <option option value="5" >Unit Reservations</option>
                                <option option value="6" >Reservations' Transaction</option>
                                <option option value="7" >My Profile</option>
                            </select>
                            <div class="invalid-feedback" id="invalidFeedbackWhichPageLandlord">Please select which page.</div>
                        </div>

                        <div class="col-12">
                          <label for="textAreaInsights" class="form-label">Tell us more about it:</label>
                          <textarea class="form-control" name="feedback_text" id="textAreaInsights" aria-label="With textarea" required
                          oninvalid="this.setCustomValidity('Please provide more details.')"
                          oninput="setCustomValidity('')"></textarea>
                            <div class="invalid-feedback" id="invalidFeedbackTextArea">Please provide more details.</div>
                        </div>
                        
                        <div class="col-12 justify-content-start justify-content-lg-end d-flex">
                            <button class="btn" type="submit"name="send_feedback">Submit feedback</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("resources/images/fback.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

    </div>
</section>
    <!-- End Why Us Section -->


    
  



<?php include('footer.php'); ?>
  



<script>


  function enableWhichPart() {
    var toDo = document.getElementById("toDo").value;
    var whichPartSelect = document.getElementById("whichPart");

    // Enable "Which part of the platform?" select based on the selection in "What would you like to do?"
    whichPartSelect.disabled = !(toDo === "1" || toDo === "2" || toDo === "3");
    showSections(); // Call showSections immediately to handle visibility based on the initial selection
  }

  function showSections() {
    var toDo = document.getElementById("toDo").value;
    var whichPart = document.getElementById("whichPart").value;

    // Reset visibility
    document.getElementById("tenantSection").style.display = "none";
    document.getElementById("landlordSection").style.display = "none";

    // Show relevant section based on selections
    if (toDo === "1" || toDo === "2" || toDo === "3") {
      if (whichPart === "1") {
        document.getElementById("tenantSection").style.display = "block";
      } else if (whichPart === "2") {
        document.getElementById("landlordSection").style.display = "block";
      }
    }
  }
</script>

  </body>

  <!-- javascript -->
  <script src="js/property_enlist.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
