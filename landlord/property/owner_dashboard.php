<?php
use Models\Property;
use Models\Image;
use Models\User;
use Models\Review;
include ("init.php");
include ("session.php");


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    
    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);
    
    $full_name = $user['first_name'] . ' ' . $user['last_name'];
    $_SESSION['full_name'] = $full_name;
}

if(isset($_SESSION['current_page'])){
    unset($_SESSION['current_page']);
}

//Get all properties
$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();


//For map display
$map_latitude = [];
$map_longitude = [];
$map_property = [];
$full_address = [];
foreach($properties as $property_item){
    $map_latitude[] = $property_item['latitude'];
    $map_longitude[] = $property_item['longitude'];
    $map_property[] = $property_item['property_name'];
    $full_address[] = $property_item['property_number'] . ' ' . $property_item['street'] . ', ' .  $property_item['barangay'];
}

//All available barangay
$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa</title>
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
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->
<?php include('navbar.php'); ?>
    <!-- Navbar ends -->


<!-- Hero -->
<section class="hero" id="home">
    <div class="container">

    <div class="row my-5 gap-5 gap-md-0">
      <div class="col-12 col-md-6 py-auto my-auto order-5 order-md-0" >

        <h1 class="hero-title text-center text-md-start fw-bold display-1">Your Second Home Search <span class="text" style="color:hsl(200, 69%, 14%)">Made Easy</span></h1>

        <div class="row">
          <p class="hero-text fs-5">
            Don’t spend hours online searching for an accommodation. With Apt.
            Iba Pa, you’ll find your new home in no time
          </p>
          <form action="accommodations.php" method="POST">
          <div class="row mt-3">
          </div>
        </div>
        </form>
      </div>
      <div class="col-12 col-md-6 order-1 order-md-0" >
        <img src="resources/images/hero-banner.png" alt="Modern house model" class="w-100">
      </div>
    </div>

    </div>
</section>

<!-- Hero -->



    <!-- Info Buttons starts-->

    <div class="container-fluid pt-5 pb-5 position-relative">
      <div class="row">
        <section class="info z-2">
          <div class="box-container">
            <a href="#" class="box">
              <img src="images/box4.png" alt="My Property" style="height: 120px;"/>
              <h3>My Property</h3>
            </a>

            <a href="#" class="box">
              <img src="images/box2.png" alt="Appointments" style="height: 120px;"/>
              <h3>Appointments</h3>
            </a>

            <a href="#" class="box">
              <img src="images/box3.png" alt="Reservations" style="height: 120px;"/>
              <h3>Reservations</h3>
            </a>

          </div>
        </section>
      </div>
    </div>
    <!-- Info Buttons ends-->

    <!-- Map Browse -->
    <div class="container-md">
        <div class="row mt-5">
              <div id="map"></div>
          </div>
      </div>
      <!-- Map Browse end -->

    <!-- offers starts  -->
        <div class="container-fluid jumbuildings">
          <section class="offers">
            <h1 class="offersHeading p-3">Apt Iba Pa Offers</h1>

            <div class="container-md mb-5">
              <div class="box-container">
                <div class="row">

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-book-atlas fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <div class="row mt-3">
                        <div class="col-12">
                          <h3>Online Catalog for Students</h3>
                        </div>
                      </div>
                      <p>Choose from different spaces, reserve, and schedule
                      your second home with one click</p>
                  </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-messages-question fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Customer Support</h3>
                      <p>Ask for help from the team, anytime. 
                      Just send us a message and get back to you 
                      immediately.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-house-user fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
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
                        <i class="fa-light fa-shield-heart fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
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
                        <i class="fa-light fa-lock fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
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
                        <i class="fa-light fa-calendar-week fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Regular Maintenance</h3>
                      <p>Regular maintenance to your spaces that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            
          </section>
        </div>

    <!-- offers section ends -->

    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->


      <style>
    
        #map {height: 600px; width: 1350px }
    </style>
    <script>
    var map_center = [15.145158062165162, 120.59477842687491];
            var mapOptions = {
            center: map_center,
            zoom: 18
            }
            var map = L.map('map', mapOptions);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
    
            var latitude = <?php echo json_encode($map_latitude); ?>;
            var longitude = <?php echo json_encode($map_longitude); ?>;
            var propertyNames = <?php echo json_encode($map_property); ?>;
            var full_address = <?php echo json_encode($full_address); ?>;
            for (var i = 0; i < latitude.length; i++) {
            var marker = L.marker([latitude[i], longitude[i]]).addTo(map);
            marker.bindPopup("<b>" + propertyNames[i] + "</b><br>" + full_address[i] + "<br><a href='view.php?property_id'>View</a>").openPopup();
            }
    </script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
    </body>
    </html>
  