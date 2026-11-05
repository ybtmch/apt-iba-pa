<?php
use Models\Property;
use Models\Image;
use Models\User;
use Models\Review;
use Models\Bookmark;
include ("init.php");
include ("session.php");

if(isset($_SESSION['current_page'])){
    unset($_SESSION['current_page']);
}

if (isset($_GET['apply']) && $_GET['apply'] == '1') {
    // JavaScript to show a popup
    echo "<script>
            window.addEventListener('DOMContentLoaded', (event) => {
                alert('Property application successful!');
            });
          </script>";
}

//Get all properties
$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();


$count_lourdes = 0;
$count_salapungan = 0;
$count_claro = 0;
$count_total = count($properties);
//For map display
$map_latitude = [];
$map_longitude = [];
$map_property = [];
$full_address = [];
$map_property_id = [];
foreach($properties as $property_item){
    $map_latitude[] = $property_item['latitude'];
    $map_longitude[] = $property_item['longitude'];
    $map_property[] = $property_item['property_name'];
    $full_address[] = $property_item['property_number'] . ' ' . $property_item['street'] . ', ' .  $property_item['barangay'];
    $map_property_id[] = $property_item['property_id'];
    $display_image[] = $property_item['image_path'];

    if($property_item['barangay']==='Lourdes Sur East'){
        $count_lourdes = $count_lourdes + 1;
    } elseif ($property_item['barangay']==='Salapungan'){
        $count_salapungan = $count_lourdes + 1;
    } elseif ($property_item['barangay']==='Claro M. Recto'){
        $count_claro = $count_lourdes + 1;
    }

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
    <!-- PAYPAL -->
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
    <!-- END OF PAYPAL -->

    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draggable/dist/leaflet-draggable.js"></script>
    <!-- End LeafletJS -->

    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
    <script>
   
</script>

  </head>
  <body style="background-color: white;">

    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>


<!-- Hero -->
<section class="hero" id="home">
    <div class="container mt-0">

    <div class="row my-5 gap-5 gap-md-0">
      <div class="col-12 col-md-6 py-auto my-auto order-5 order-md-0" >

        <h1 class="hero-title text-center text-md-start fw-bold display-1">Your Second Home Search <span class="text" style="color:hsl(200, 69%, 14%)">Made Easy</span></h1>

        <div class="row">
          <p class="hero-text fs-5">
            Don’t spend hours online searching for an accommodation. With Apt.
            Iba Pa, you’ll find your new home in no time
          </p>
          <form action="accommodations" method="POST">
          <div class="row mt-3">
            <div class="input-group mb-3">
            
              <input type="text" class="form-control" placeholder="Search for your home" aria-label="search-loc" aria-describedby="button-addon2" name="query" id="search_bar">
              <button class="btn" type="submit" name="search" id="button-addon2"><i class="fa-regular fa-magnifying-glass-location fa-2x"></i></button>

            </div>
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

    <div class="container-md">
      <div class="row mt-5 mb-5">
        <section class="info">
          <div class="row gy-4">
                <div class="col ">
                    <div class="box-container">
                        <form action="accommodations" method="POST">
                            <input type="hidden" name="barangay" value="Lourdes Sur East">
                        <button type="submit" class="box">
                            <img src="resources/images/icon-20.png" <?php //echo $count_lourdes ?> alt="" /> <!-- change number icon -->
                            <h3>Dormitories and Apartments located in Lourdes Sur East</h3>
                        </button>
                        </form>
                    </div>
                </div>
                <div class="col ">
                    <div class="box-container">
                        <form action="accommodations" method="POST">
                            <input type="hidden" name="barangay" value="Salapungan">
                        <button type="submit" class="box">
                            <img src="resources/images/icon-20.png" <?php //echo $count_salapungan ?> alt="" /> <!-- change number icon -->
                            <h3>Dormitories and Apartments located in Salapungan</h3>
                        </button>
                        </form>
                    </div>
                </div>
                <div class="col ">
                    <div class="box-container">
                        <form action="accommodations" method="POST">
                            <input type="hidden" name="barangay" value="Claro M. Recto">
                        <button type="submit" class="box">
                            <img src="resources/images/icon-20.png" <?php //echo $count_claro ?>alt="" /><!-- change number icon -->
                            <h3>Dormitories and Apartments located in Claro M. Recto</h3>
                        </button>
                        </form>
                    </div>
                </div>
              <div class="col ">
                <div class="box-container">
                        <form action="accommodations" method="POST">
                      <button type="submit" class="box">
                        <img src="resources/images/icon-21.png" alt="" />
                        <h3>Dormitories and Apartments located around AUF</h3>
                    </button>
                    </form>
                    </div>
              </div>

            
          </div>
        </section>
      </div>
    </div>
    <!-- Info Buttons ends-->

    <!-- Map Browse -->
    <div class="container-md">
        <div class="row mt-5 mb-5">
            <div class="map-container">
                <div id="center-text">Use two fingers to move the map.</div>
                <div id="map"></div>
            </div>
        </div>
    </div>
      <!-- Map Browse end -->

    <!-- offers starts  -->
        <!-- <div class="container-fluid jumbuildings"> -->
        <section class="offers section-title" style="background-color: #F2F6F7">
          <p class="statusU text-center"><span>Offers</span></p>
            <h2 class="offersHeading text-center p-3">Apt Iba Pa Offers</h2>

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
        <!-- </div> -->

    <!-- offers section ends -->

    






    <!-- ======= Skills Section ======= -->

    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
          <p class="statusU text-center"><span>BAYANIHAN</span></p>
            <h2 class="mt-3 text-center">NEED A HAND, KABAYAN? WE GOT YOU!</h2>

            <p class="subStatusU">
            Ready to find the perfect place to call your <strong>'MY HOME'</strong> near Angeles University Foundation? We've got your back, kabayan! It's as easy as 1, 2, 3!
            </p>

          </div>
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup7.png" class="img-fluid" alt="">
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
              <h3>2. Browse and Search for Home</h3>
              <p class="fst-italic">
              You have several options to find the perfect place, options to find <strong>'THE ONE 🥰'</strong>
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                  <p>
                    <strong>Option 1:</strong> On the homepage, enter your preferred barangay, then click "Search". 
                  </p>
                  <p>
                    <strong>Option 2:</strong> On the homepage, just choose and click between the four buttons with barangay names. 
                  </p>
                  
                  <p>
                    <strong>Option 3:</strong> Another option is go to "Accommodations" tab and select any  filters you want to apply (e.g., room type, price range, amenities). 
                  </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup9.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>
    
    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup10.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content" data-aos="fade-left" data-aos-delay="100">
              <h3>3. Explore Listings</h3>
              <p class="fst-italic">
                Pay attention to the listing description, amenities, house rules, and reviews from previous and current tenants. 
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                      Browse the listings that match your search criteria. You can view details such as photos, descriptions, reviews, and pricing for each property. Click on a listing to view more details about the property. 
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
              <h3>4. Schedule a Visit</h3>
              <p class="fst-italic">
                Of course, if you're not entirely sure if it is <strong>'THE ONE'</strong>, go take a look for yourself! Don't rush into anything; make sure it's a good fit. 
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                      Once you’ve found a suitable accommodation that fits your preferences, schedule a property viewing. Select the date and time available, and submit your visit request. You will see a reference code under "Appointments" tab and show it to the landlord upon arrival. 
                    </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup12.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>

    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup13.png" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-5 mt-lg-5 content" data-aos="fade-left" data-aos-delay="100">
              <h3>5. Reserve a room </h3>
              <p class="fst-italic">
                If you think it is 'THE ONE' for you, seal the deal with a reservation fee to secure it, and voila! You just got your <strong>HOME</strong> in just five (5) steps! 
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                      After making a decision to secure your room and settling your payment, you should receive a confirmation from the website and/or the property owner. This may include details about the the important details that is between you and the landlord.
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
                <h3>6. Chat and be notified!</h3>
              <p class="fst-italic">
                Of course, it's all about keeping it real and staying connected. We're not fans of ghosting, so don't just vanish on your landlord. 
              </p>
  
              <div class="skills-content">
                <div class="content mt-5">
                    <p>
                      This messaging system feature is all about making communication easy and straightforward between tenants and landlords. It's a good practice to confirm move-in details, ask questions, and coordinate any special requests. You can also receive notifications about your schedules and reservations.
                    </p>
                  </div>
              </div>
  
            </div>

                        
            <div class="col-lg-6 d-flex align-items-center order-1 order-lg-2" data-aos="fade-right" data-aos-delay="100">
                <img src="resources/images/mockup14.png" class="img-fluid" alt="">
            </div>

          </div>
  
        </div>
    </section>

    <!-- End Skills Section -->











        <!-- Featured section starts -->

    <!-- <div class="container-fluid featuredHtml"> -->
    <section class="listings section-title jumbuildings" style="background-color: #F2F6F7">
        <p class="statusU text-center"><span>Properties</span></p>
        <h2 class="featureHeading p-3 text-center">Featured Listings</h2>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
                <?php                     
                    shuffle($properties);
                    $random_properties = array_slice($properties, 0, 3);

                    foreach($random_properties as $property){ 
                    $property_name = $property['property_name'];
                    $barangay = $property['barangay'];
                    $lowest_rate = $property['lowest_rate'];
                    $property_type = $property['property_type'];
            
                    $property_id = $property['property_id'];
                    $images = new Image();
                    $images->setConnection($connection);
                    $images = $images->getDisplayImage($property_id);

                    if($images){
                      $image = $images['image_path'];
                      } else {
                      $image = 'logo.png';
                      }

                    $reviews = new Review();
                    $reviews->setConnection($connection);
                    $reviews = $reviews->getRatings($property_id);
                    
                    if(count($reviews)>0){
                        $total_ratings = 0;
                        $total_reviews = count($reviews);
                        
                        foreach ($reviews as $review) {
                            $total_ratings += $review["rating"];
                        }

                        $average_rating = number_format(($total_ratings / $total_reviews),1);

                        if($total_reviews>1){
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
                        } else{
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
                        }
                    } else{
                        $show_reviews = "No reviews yet";
                    }
                    
                    if(isset($_SESSION['user_id'])){
                    $bookmark = new Bookmark();
                    $bookmark->setConnection($connection);
                    $bookmark = $bookmark->checkBookmark($property_id, $user_id);
                    }
                    ?>
              <div class="col-12 col-md-6 col-xl-4 mt-3">
                <div class="box">
                  <div class="thumb">
                    <input type="hidden" value="<?= $property_id ?>" name="property_id" id="property_id">
                    <p class="type"><span><?= $property_type ?></span></p>

                    <?php if(isset($_SESSION['user_id'])) {?>
                    <form class="save">
                    <?php if (isset($bookmark['status']) && $bookmark['status']===1) {?>
                      <button
                        type="button"
                        class="fa-solid fa-bookmark fa-3x"
                        value="1"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmark(<?= $property_id ?>)"
                        ></button>
                    <?php } elseif(isset($bookmark['status']) && $bookmark['status']===2) { ?>
                        <button
                        type="button"
                        class="fa-regular fa-bookmark fa-3x"
                        value="2"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmark(<?= $property_id ?>)"
                        ></button>
                    <?php } else {?>
                        <button
                        type="button"
                        class="fa-regular fa-bookmark fa-3x"
                        value="0"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmark(<?= $property_id ?>)"
                        ></button>
                    <?php } ?>
                    </form>
                    <?php } else { ?>
                        <form action="login" method="post" class="save">
                      <button
                        type="submit"
                        name="save"
                        class="fa-regular fa-bookmark fa-3x"
                      ></button> <!-- class="fa-regular fa-bookmark fa-3x" -->
                    </form>
                    <?php } ?>

                    <img class="w-100" src="resources/images/properties/<?=$image?>" alt=""/>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-sm-8">
                      <h3 class="name"><?= $property_name?></h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> <?= $barangay?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 justify-content-start col-lg-4 mt-3 mt-lg-0 rentName">
                      <div class="float-start float-lg-end">Rent starts at</div>
                        <br>
                      <div class="float-start float-lg-end price">&#8369;<?= $lowest_rate?></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $show_reviews ?> </p>
                    </div>
                    <div class="col-lg-6">
                    <a href="view?property_id=<?= $property_id ?>" class="btnView">View</a> 
                    </div>
                    
                  </div>

                </div>
              </div>
                <?php } ?>

            </div>
              </div>

          <div class="row mt-5 mb-5 d-flex justify-content-center">
            <div class="col-12 col-md-4 d-flex justify-content-center">
              
            </div>
          </div>

        <!-- </div> -->
      </section>
    <!-- </div> -->

    <!-- Featured ends -->


    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
         var touchCount = 2;

        function handleTouchStart(e) {
            touchCount = e.touches.length;
        }

        function handleTouchMove(e) {
            if (e.touches.length !== touchCount) {
                // Two fingers touched the screen, execute your function here
                showCenterText();
            }
        }

        function showCenterText() {
            var centerText = document.getElementById('center-text');
            centerText.style.display = 'none';

            // You can add additional logic or actions when two fingers touch the screen
            // For example, you might want to perform specific operations or show additional information.
        }

        function handleTouchEnd() {
            var centerText = document.getElementById('center-text');
            centerText.style.display = 'block';
        }

        // Add event listeners to the document
        document.addEventListener('touchstart', handleTouchStart);
        document.addEventListener('touchmove', handleTouchMove);
        document.addEventListener('touchend', handleTouchEnd);
        })
    </script>
    <script>
    

    var map_center = [15.145604192850909, 120.59442965723909];
    var isMobile = L.Browser.mobile;

    var mapOptions = {
        center: map_center,
        zoom: 18,
        dragging: !isMobile, 
    };

    var map = L.map('map', mapOptions);

    if (isMobile) {
        map.dragging.disable();
    }

    var aufIcon = L.icon({
        iconUrl: 'resources/images/AUF.png',
        iconSize: [80, 100],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var aufMarker = L.marker([15.145604192850909, 120.59442965723909], { icon: aufIcon }).addTo(map);
    aufMarker.bindPopup("<b>ANGELES UNIVERSITY FOUNDATION</b>");

    var latitude = <?php echo json_encode($map_latitude); ?>;
    var longitude = <?php echo json_encode($map_longitude); ?>;
    var propertyNames = <?php echo json_encode($map_property); ?>;
    var full_address = <?php echo json_encode($full_address); ?>;
    var property_id = <?php echo json_encode($map_property_id); ?>;
    var displayImage = <?php echo json_encode($display_image); ?>;

    for (var i = 0; i < latitude.length; i++) {
        var marker = L.marker([latitude[i], longitude[i]]).addTo(map);
        marker.bindPopup(
            "<div style='text-align: center; font-size: 12px;'>" +
            "<img src='resources/images/properties/" + displayImage[i] + "' alt='" + propertyNames[i] + "' style='max-width: 150px; height: 200px;'>" +
            "<br><b>" + propertyNames[i] + "</b><br>" + full_address[i] +
            "<br><a href='view.php?property_id=" + property_id[i] + "'>View</a>" +
            "</div>"
        );
    }
    </script>


    <script>  
        function bookmark(propertyId) {
            const bookmarkBtn = document.getElementById(`bookmarkBtn-${propertyId}`);
            const bookmarkBtnVal = bookmarkBtn.value;

            ajaxBookmark({ 
                property_id: propertyId,
                status: bookmarkBtnVal
            });
        };

        function ajaxBookmark(data) {
            $.ajax({
                url: 'bookmark',
                type: 'POST',
                data: data,
                success: function(response) {
                    const bookmarkBtnChange = document.getElementById(`bookmarkBtn-${data.property_id}`);
                    if (response === '1') {
                        bookmarkBtnChange.classList.replace("fa-regular", "fa-solid");
                        bookmarkBtnChange.setAttribute("value", "1");
                    } else {
                        bookmarkBtnChange.classList.replace("fa-solid", "fa-regular");
                        bookmarkBtnChange.setAttribute("value", "0");
                    }
                    bookmarkBtnChange.setAttribute("onclick", `bookmark(${data.property_id})`);
                }
            }); 
        }
    </script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    </body>
    </html>
  