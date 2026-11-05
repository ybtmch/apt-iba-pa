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
        <title>Apply a Property</title>
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
        <link href="css/apply_property.css" rel="stylesheet" />
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
  

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h1>Ikaw, Apt. Iba Pa!</h1>
            <h2>Join and get tenants and earn reliable revenue when you list your property with us! Open your doors and share your space with heart on Apt Iba Pa.  </h2>
            <div class="d-flex justify-content-center justify-content-lg-start" >
                <a href="apply-property.php" class="btn-get-started scrollto">Get Started</a>
            </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
            <img src="images/hero-banner.png" class="img-fluid animated" alt="">
            </div>
        </div>
        </div>

    </section>

    <!-- End Hero -->


    <!-- ======= Services Section ======= -->
    
    <section id="services" class="services section-bg pt-5 pt-lg-5">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <p class="statusU text-center"><span>PARA SA BAYAN</span></p>
            <h2 class="mt-4">Look at the Brighter Side</h2>
            <p>
            Make the switch to Apt Iba Pa today and witness the brighter side of property management in the digital age!
            </p>
          </div>
  
          <div class="row">
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-regular fa-magnifying-glass-location fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>
                <h4>Increased Visibility</h4>
                <p>Your property gains exposure to a vast audience of students searching for accommodations near AUF, enhancing your chances of finding tenants quickly.</p>
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-regular fa-house-user fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>
                <h4>Effective Occupancy</h4>
                <p>Apt Iba Pa streamlines tenant interactions, making it easy to manage inquiries, appointments, and reservations. You can keep track of all communication in one place.</p>
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-regular fa-comment-heart fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>
                <h4>User Reviews </h4>
                <p>Tenants can leave reviews and ratings, helping you build a positive reputation. This encourages trust among future tenants and boosts the appeal of your property.</p>
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
              <div class="icon-box">
                <span class="fa-stack fa-3x mb-2">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-solid fa-hand-holding-dollar fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                </span>
                <h4>Income Generation </h4>
                <p>By listing your property on Apt Iba Pa, you open up opportunities for additional income. Whether you're looking to fill vacant units or maximize your property's potential.</p>
              </div>
            </div>
  
          </div>
  
        </div>
      </section>
    <!-- End Services Section -->

    <!-- ======= Skills Section ======= -->

    <section id="skills" class="skills" style="background-color: white;">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
          <p class="statusU text-center"><span>BAYANIHAN</span></p>
            <h2 class="mt-3">Need a hand, kabayan? We got You!</h2>

            <p class="subStatusU">Are you ready to take a leap into the future of property management? APT. IBA PA offers a range of benefits that can transform your property's visibility and tenant interactions.
            </p>

          </div>
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content" data-aos="fade-left" data-aos-delay="100">
              <h3>1. Create an Apt Iba Pa account</h3>
              <p class="fst-italic">
                You can do this on their website or through their mobile app, providing essential information like your email and password.
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    If you don't already have one, start by signing up for an account. You can do this on the website or through the mobile app.
                    </p>
                  </div>
              </div>
  
            </div>
          </div>
  
        </div>
    </section>


    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">

            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content order-2 order-lg-1" data-aos="fade-left" data-aos-delay="100">
              <h3>2. Complete Profile and Get Verified!</h3>
              <p class="fst-italic">
                Personalize your profile by adding a profile picture and a completing the details. Providing a bit about yourself can help build trust with potential tenants.
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    Fill out your profile information, including a profile picture. Apt Iba Pa may ask you to verify your identity by providing identification and a phone number.
                    </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup-2.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>
    
    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup-3.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content" data-aos="fade-left" data-aos-delay="100">
              <h3>3. List your property</h3>
              <p class="fst-italic">
                Begin the listing creation process by logging into your Apt Iba Pa account and selecting "Apply My Propety".
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    Provide your property details, set pricing, define house rules and tenant requirements, select amenities, upload photos, and write a captivating title and description.
                    </p>
                  </div>
              </div>
  
            </div>
          </div>
  
        </div>
    </section>

    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">

            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content order-2 order-lg-1" data-aos="fade-left" data-aos-delay="100">
              <h3>4. Preview and Publish</h3>
              <p class="fst-italic">
                Review all your listing information for accuracy and completeness to make your listing reliable and legit to potential tenants.
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    Review your listing to make sure all the information is accurate, and then click "Publish". Wait for the listing to be reviewed and approved by the platform administrators.
                    </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup-4.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>

    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup-5.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content" data-aos="fade-left" data-aos-delay="100">
              <h3>5. Manage Your Listing</h3>
              <p class="fst-italic">
                Use your APT. IBA PA dashboard to manage calendar availability (Don't worry! You can also block off dates when you're not available), manage your listing, respond promptly to tenants/potential tenants inquiries, and handle reservation requests.
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    Once your listing is live, you can manage it through your "My Properties" dashboard. Respond promptly to tenants/potential tenants appointments of visits and reservation requests.
                    </p>
                  </div>
              </div>
  
            </div>
          </div>
  
        </div>
    </section>

    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">

            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content order-2 order-lg-1" data-aos="fade-left" data-aos-delay="100">
              <h3>6. Communicate with Tenants</h3>
              <p class="fst-italic">
                Provide a great experience. Be responsive to tenant needs during their inquiries and when needed assistance regarding your property.
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                    Stay in touch with tenants, answer their questions, and provide them with information about schedule of visits, house rules, and nearby establishment.
                    </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
              <img src="resources/images/mockup-6.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>

    <!-- End Skills Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">
  
          <div class="row">
  
            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
  
              <div class="content">
                <h3>You ask, <br> <strong>We answer</strong></h3>
                <p>
                Have Questions About Applying Your Property to Apt Iba Pa? Here are the commonly asked questions: 
                </p>
              </div>
  
              <div class="accordion-list">
                <ul>
                  <li>
                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Is my property suitable for Apt Iba Pa? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                      <p>
                        Apt Iba Pa accommodates various types of properties, from dormitories to apartments. Whether you have a single unit or multiple listings, our platform can help you connect with potential tenants.
                      </p>
                    </div>
                  </li>
  
                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span>
                      Do I have to list my property all the time? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                        No, you have full control over your property's availability. You can list it year-round, just during the academic year, or for specific periods. It's entirely flexible and adapts to your schedule.
                      </p>
                    </div>
                  </li>
  
                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> How much should I interact with tenants? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                        The level of interaction with tenants is up to you. Some property owners prefer minimal contact, providing essential information and assistance as needed, while others may choose to be more hands-on. You can customize your approach to what suits you and your tenants best.
                      </p>
                    </div>
                  </li>

                  <li>
                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-4" class="collapsed"><span>04</span> Any tips on being a great Apt Iba Pa property owner? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
                      <p>
                        Providing a comfortable, clean, and well-maintained property is essential. Respond to tenant inquiries and requests promptly, making their stay as pleasant as possible. While it's not mandatory, adding personal touches like local recommendations or amenities can enhance the tenant experience.
                      </p>
                    </div>
                  </li>
  
                </ul>
              </div>
  
            </div>
  
            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("images/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
          </div>
  
        </div>
      </section>
    <!-- End Why Us Section -->



    

    
<!-- <section class="pricing" style="background-color: white;">
  <div class="container py-3 pricingContainer">
    <header>


      <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <p class="statusU text-center"><span>Pricing</span></p>
        <h1 class="display-4 fw-normal">Subscription Plans</h1>
        <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
      </div>
    </header>

    <main>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col d-flex justify-content-center ">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Free</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱0<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
            </div>
          </div>
        </div>
        <div class="col d-flex justify-content-center">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Basic</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱100<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>20 users included</li>
                <li>10 GB of storage</li>
                <li>Priority email support</li>
                <li>Help center access</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button>
            </div>
          </div>
        </div>
        <div class="col d-flex justify-content-center">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3 text-white bg-primary border-primary">
              <h4 class="my-0 fw-normal">Premium</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱150<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>30 users included</li>
                <li>15 GB of storage</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
            </div>
          </div>
        </div>
      </div>

      <p class="statusU text-center mt-5"><span>Compare</span></p>
      <h2 class="display-6 fw-normal text-center mb-4 mt-3">Compare plans</h2>

      <div class="table-responsive">
        <table class="table text-center">
          <thead>
            <tr>
              <th style="width: 34%;"></th>
              <th style="width: 22%;">Free</th>
              <th style="width: 22%;">Basic</th>
              <th style="width: 22%;">Premium</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" class="text-start">Public</th>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
            <tr>
              <th scope="row" class="text-start">Private</th>
              <td></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
          </tbody>

          <tbody>
            <tr>
              <th scope="row" class="text-start">Permissions</th>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
            <tr>
              <th scope="row" class="text-start">Sharing</th>
              <td></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
            <tr>
              <th scope="row" class="text-start">Unlimited members</th>
              <td></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
            <tr>
              <th scope="row" class="text-start">Extra security</th>
              <td></td>
              <td></td>
              <td><i class="fa-solid fa-location-check fa-2x"width="24" height="24"></i></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>


  </div>
</section> -->

    
  

    <!-- offers starts  -->
        <!-- <div class="container-fluid jumbuildings"> -->

        <!-- <section class="offers section-title" style="background-color: #F2F6F7">
          <p class="statusU text-center"><span>Offers</span></p>
            <h2 class="offersHeading text-center p-3">Apt Iba Pa Offers</h2>

            <div class="container-md mb-5">
              <div class="box-container">
                <div class="row">

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-1 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <div class="row mt-3">
                        <div class="col-12">
                          <h3>Create an Apt Iba Pa account</h3>
                        </div>
                      </div>
                      <p>If you don't already have one, start by signing up for an account. You can do this on the website or through the mobile app.</p>
                  </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-2 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Complete Profile and Get verified</h3>
                      <p>Fill out your profile information, including a profile picture and a short bio. Apt Iba Pa may ask you to verify your identity by providing identification and a phone number.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-3 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">A space to call Home</h3>
                      <p>A place you can call home, somewhere you can
                      work and relax at the same time.</p>
                    </div>
                  </div>


                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-4 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Built-In Comfort</h3>
                      <p>Functional spaces with amenities that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-5 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Well-secured Spaces</h3>
                      <p>Our homes come with CCTV, caretakers, and security
                      personnel you can rely on for your safety.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-6 fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Regular Maintenance</h3>
                      <p>Regular maintenance to your spaces that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            
        </section> -->

        <!-- </div> -->

    <!-- offers section ends -->





<?php include('footer.php'); ?>
  



    


  </body>

  <!-- javascript -->
  <script src="js/property_enlist.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
