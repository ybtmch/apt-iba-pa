<!-- About Apt Iba Pa -->
<?php
use Models\Property;
include ("init.php");
include ("session.php");

$current_page = "| About";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Apt Iba Pa | About Us</title>
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
        <link href="css/aboutUs.css" rel="stylesheet" />
        <link href="css/dashboard.css" rel="stylesheet" />
        <link href="css/all.css" rel="stylesheet" />

        <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
    </head>

  <body>
    <!-- Navbar -->
    
    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>


    <!-- Navbar ends -->

    <section class="hero" id="home">
    <div class="container mt-0">

    <div class="row my-5 gap-5 gap-md-0">
      <div class="col-12 col-md-6 py-auto my-auto order-5 order-md-0" >

        <h1 class="hero-title text-center text-md-start fw-bold display-1" style="font-size: 72px">ABOUT <span class="text" style="color:hsl(200, 69%, 14%)">US</span></h1>

        <div class="row">
          <p class="hero-text fs-4">
            At APT. IBA PA, we are dedicated to addressing the challenges faced by students at Angeles University Foundation (AUF) when it comes to finding suitable accommodations in close proximity to the University. With the limited availability of dormitories and apartments near AUF, students often struggle to secure the ideal living space.
          </p>
        </div>

      </div>
      <div class="col-12 col-md-6 order-1 order-md-0" >
        <img src="resources/images/AipSingle2.png" alt="Modern house model" class="w-100">
      </div>
    </div>

    </div>
</section>

    <!-- Services -->
    <div class="container-fluid pt-5 pb-5" style="background-color: #f2f6f7">
      
        <!-- <div class="row aboutUsTitle"> -->
          <div class="col">
          <hr>
          </div>
        <!-- </div> -->
        <div class="row aboutUsText">
          <p class="about-info"></p>
        </div>
      

      <div class="container-fluid pt-3">
        <section class="aboutUs">

          <div class="row justify-content-center">
            <!-- <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3>Map-based Directory</h3>
                <p>
                  Our map interface allows users to visualize the exact locations of dormitories and apartments near AUF. 
                </p>
              </div>
            </div>
            <div class="column mb-3" >
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-list"></i>
                </div>
                <h3>Extensive Listings</h3>
                <p>
                  Our listings include detailed information such as rental rates, facilities, nearby amenities, and contact details.
              </div>
            </div>
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-comments"></i>
                </div>
                <h3>Community Reviews</h3>
                <p>
                  This helps create an active community where individuals can exchange valuable insights, fostering a reliable platform.
                </p>
              </div>
            </div> -->
          
            
            <!-- <div class="row justify-content-center"> -->
            <!-- <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-sliders"></i>
                </div>
                <h3>Customized Living</h3>
                <p>
                  Users can narrow down their options based on preferences such as rental budget, room types, amenities, and more.
                </p>
              </div>
            </div>
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-phone-volume"></i>
                </div>
                <h3>Easy Communication</h3>
                <p>
                  Users can easily connect with the relevant contacts for inquiries, booking appointments, and securing their desired accommodations.
                </p>
              </div>
            </div> -->
            <!-- </div> -->

            <!-- <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-plug"></i>
                </div>
                <h3>Service Heading</h3>
                <p>
                  Users can easily connect with the relevant contacts for inquiries, booking appointments, and securing their desired accommodations.
                </p>
              </div>
            </div> -->

            <!-- <hr class="dasdas mt-5"> -->

              <div style=" padding-bottom:50px; " class="container">
                

                  <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-12 d-flex justify-content-center  align-items-center">
                      <h1 style="font-weight:600; font-size:45px; margin-right:10px;" >Mission</h1>
                      
                    </div>
                    <!-- <div class="col-1">
                        
                    </div> -->
                    
                    <div class="row justify-content-center ">
                      <div class="col-12 col-md-7 col-lg-8">
                        <p style=" font-size:20px;" class="text-center ">
                        At Apt. Iba Pa, our mission is to transform the way individuals discover ideal dormitories and apartments near Angeles University Foundation (AUF). Committed to simplicity, we strive to offer a user-friendly platform that streamlines the search, reservation, and property management procedures. By doing so, we aim to enhance the convenience for tenants and landlords alike, revolutionizing the accommodation experience.  </div>
                      <div class="col col-lg-7 d-flex justify-content-center mt-5">
                      <img style="width:115%;" src="images/mockup1.png">
                      </div>
                     
                      
                    </div>
  
                   
                    
                  </div>
                 
              </div>

              <hr class="mt-5">

              <div style="padding-bottom:50px; " class="container">
                

                  <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-12 d-flex justify-content-center  align-items-center">
                      <h1 style="font-weight:600; font-size:45px; margin-right:10px;" >Vision</h1>
                      
                    </div>
                    <!-- <div class="col-1">
                        
                    </div> -->
                    
                    <div class="row justify-content-center ">
                      <div class="col-12 col-md-7 col-lg-8">
                      <p style=" font-size:20px;" class="text-center">
                      To become the go-to platform for students and property owners seeking or offering accommodations within the vicinity of AUF, expanding our reach locally and potentially nationally.</p>
                      </div>
                      <div class="col-lg-7 col-md-8 d-flex justify-content-center">
                      <img  style="width:100%;" src="images/visionpic.png">
                      </div>
                    </div>
                    
                  </div>
              </div>

              <hr >

              <div style=" padding-bottom:25px; " class="container">
                

                  <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-12 d-flex justify-content-center  align-items-center mb-5">
                      <h1 style="font-weight:600; font-size:45px; margin-right:10px;" >Core Values</h1>
                      <!-- <i  class="fa-solid fa-eye fa-4x "></i> -->
                    </div>
                    <!-- <div class="col-1">
                        
                    </div> -->
                    
                    <div class="row justify-content-center ">
                    <div class="row justify-content-center">
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                <i class="fa-solid fa-lightbulb-gear"></i>
                </div>
                <h3>Innovation</h3>
                <p>
                Embrace technological advancements to enhance user experiences.                </p>
              </div>
            </div>
            <div class="column mb-3" >
              <div class="card">
                <div class="icon-wrapper">
                <i class="fa-sharp fa-regular fa-magnifying-glass-location"></i>
                </div>
                <h3>Accessibility</h3>
                <p>
                Ensure that the accommodation search process is easy and convenient for all users.              </div>
            </div>
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                <i class="fa-sharp fa-solid fa-circle-info"></i>
                </div>
                <h3>Transparency</h3>
                <p>
                Foster open communication and provide accurate information to both tenants and landlords.                </p>
              </div>
            </div>
          
            
            <!-- <div class="row justify-content-center"> -->
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-sliders"></i>
                </div>
                <h3>Collaboration</h3>
                <p>
                Work closely with property owners and users to create a supportive community.                </p>
              </div>
            </div>
            <div class="column mb-3">
              <div class="card">
                <div class="icon-wrapper">
                <i class="fa-solid fa-comments"></i>
                </div>
                <h3>Continuous Improvement</h3>
                <p>
                Adapt and evolve based on feedback and changing needs of the community                </p>
              </div>
            </div>
                    </div>
                    
                  </div>
              </div>
            
          </div>
        </section>
      </div>
      
          
        

          

      
 
  

    <!-- Services ends -->





  <!-- Footer -->
  <?php include('footer.php'); ?>
    <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
