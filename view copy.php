<?php
use Models\Property;
use Models\Amenity;
use Models\Unit;
use Models\Image;
use Models\Review;
use Models\Rule;
use Models\Schedule;
use Models\Appointment;
use Models\User;
use Models\Bookmark;
use Models\PropertyFaq;
use Models\Availability;
include ("init.php");
include ("session.php");

    if(isset($_GET['property_id'])){
        $_SESSION['property_view_id'] = $_GET['property_id'];
    } else{
        $_SESSION['property_view_id'] = $_SESSION['property_view_id'];
    }
    
    $property_id = $_SESSION['property_view_id'];
    
    $property = new Property();
    $property->setConnection($connection);
    $details = $property->getPropertyDetails($property_id);

    //print_r($details);

    //property information
    $property_name = $details['property_type'];
	$property_name = $details['property_name'];
	$landlord_id = $details['landlord_id'];
    $description = $details['description'];
    $total_floors = $details['total_floors'];
	$total_units = $details['total_units'];
    $lowest_rate = $details['lowest_rate'];
    $reservation_fee = $details['reservation_fee'];
    $advance_deposit = $details['advance_deposit'];
	$property_number = $details['property_number'];
	$street = $details['street'];
    $barangay = $details['barangay'];
    $city = $details['city'];
    $province = $details['province'];
	$region = $details['region'];
	$latitude = $details['latitude'];
	$longitude = $details['longitude'];

    $aircon = $details['aircon'];
    $bathroom = $details['bathroom'];
    $cabinet = $details['cabinet'];
    $cctv = $details['cctv'];
    $drinking_water = $details['drinking_water'];
    $elevator = $details['elevator'];
    $emergency_exit = $details['emergency_exit'];
    $food_hall = $details['food_hall'];
    $laundry = $details['laundry'];
    $lounge = $details['lounge'];
    $microwave = $details['microwave'];
    $parking = $details['parking'];
    $refrigerator = $details['refrigerator'];
    $security = $details['security'];
    $sink = $details['sink'];
    $study_area = $details['study_area'];
    $tv = $details['tv'];
    $wifi = $details['wifi'];

    $full_address = $property_number . ' ' . $street . ', ' . $barangay . '
     ' . $city . ' ' . $province;

    //landlord information
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];

    //get all rooms of property
	$unit = new Unit();
	$unit->setConnection($connection);
	$units = $unit->getUnits($property_id);

    //get all rules
    $rules = new Rule();
    $rules->setConnection($connection);
    $rules = $rules->getRules($property_id);

    $short = $rules['short_term']; //1 or 0 
    $minweeks = $rules['min_weeks']; //00-99
    $mixgender = $rules['mix_gender']; //1 or 0 
    $curfew = $rules['curfew']; //1 or 0 
    $from_curfew = $rules['from_curfew']; //time
    $to_curfew = $rules['to_curfew']; //time
    $cooking = $rules['cooking']; //1 or 0 
    $pets = $rules['pets']; //1 or 0 
    $visitors = $rules['visitors']; //1 or 0 
    $from_visit = $rules['from_visit']; //time
    $to_visit = $rules['to_visit']; //time
    $alcohol = $rules['alcohol']; //1 or 0 
    $smoking = $rules['smoking']; //1 or 0 
    
    //get all images
    $images = new Image();
    $images->setConnection($connection);
    $images = $images->getImages($property_id);
    
    $display = new Image();
    $display->setConnection($connection);
    $display = $display->getDisplayImage($property_id);

    if($display){
    $display_image = $display['image_path'];
    } else {
    $display_image = 'logo.png';
    }

    //var_dump($images);
    //$property_id = 26;
        //$user_id = 33; //change with session

    $disabled_dates = [];

    $date_time = new Schedule('','','');
    $date_time->setConnection($connection);
    $date_time = $date_time->getDateTime($property_id);

    $ratings = new Review();
    $ratings->setConnection($connection);
    $ratings = $ratings->getRatings($property_id);

    $display_reviews = new Review();
    $display_reviews->setConnection($connection);
    $display_reviews = $display_reviews->getReviews($property_id);
    
    if(count($ratings)>0){
        $total_ratings = 0;
        $total_reviews = count($ratings);
        
        foreach ($ratings as $rating) {
            $total_ratings += $rating["rating"];
        }

        $average_rating = number_format(($total_ratings / $total_reviews),1);

        if($total_reviews>1){
            $show_reviews = $average_rating . ' out of 5';
        } else{
            $show_reviews = $average_rating . ' out of 5';
        }
    } else{
        $total_reviews = 0;
        $show_reviews = "No reviews yet";
    }

    $available_slots = new Availability();
    $available_slots->setConnection($connection);
    $available_slots = $available_slots->getAvailableSlots($landlord_id);
    $time_slots = $available_slots['time_slots'];

    $time_slots_array = explode(', ', $time_slots);

    $six_am = in_array('6:00 AM', $time_slots_array) ? '' : 'disabled';
    $six30_am = in_array('6:30 AM', $time_slots_array)  ? '' : 'disabled';
    $seven_am = in_array('7:00 AM', $time_slots_array)  ? '' : 'disabled';
    $seven30_am = in_array('7:30 AM', $time_slots_array)  ? '' : 'disabled';
    $eight_am = in_array('8:00 AM', $time_slots_array)  ? '' : 'disabled';
    $eight30_am = in_array('8:30 AM', $time_slots_array)  ? '' : 'disabled';
    $nine_am = in_array('9:00 AM', $time_slots_array)  ? '' : 'disabled';
    $nine30_am = in_array('9:30 AM', $time_slots_array)  ? '' : 'disabled';
    $ten_am = in_array('10:00 AM', $time_slots_array)  ? '' : 'disabled';
    $ten30_am = in_array('10:30 AM', $time_slots_array)  ? '' : 'disabled';
    $eleven_am = in_array('11:00 AM', $time_slots_array)  ? '' : 'disabled';
    $eleven30_am = in_array('11:30 AM', $time_slots_array)  ? '' : 'disabled';
    $twelve_pm = in_array('12:00 PM', $time_slots_array)  ? '' : 'disabled';
    $twelve30_pm = in_array('12:30 PM', $time_slots_array)  ? '' : 'disabled';
    $one_pm = in_array('1:00 PM', $time_slots_array)  ? '' : 'disabled';
    $one30_pm = in_array('1:30 PM', $time_slots_array)  ? '' : 'disabled';
    $two_pm = in_array('2:00 PM', $time_slots_array)  ? '' : 'disabled';
    $two30_pm = in_array('2:30 PM', $time_slots_array)  ? '' : 'disabled';
    $three_pm = in_array('3:00 PM', $time_slots_array)  ? '' : 'disabled';
    $three30_pm = in_array('3:30 PM', $time_slots_array)  ? '' : 'disabled';
    $four_pm = in_array('4:00 PM', $time_slots_array)  ? '' : 'disabled';
    $four30_pm = in_array('4:30 PM', $time_slots_array)  ? '' : 'disabled';
    $five_pm = in_array('5:00 PM', $time_slots_array)  ? '' : 'disabled';
    $five30_pm = in_array('5:30 PM', $time_slots_array)  ? '' : 'disabled';
    $six_pm = in_array('6:00 PM', $time_slots_array)  ? '' : 'disabled';
    $six30_pm = in_array('6:30 PM', $time_slots_array)  ? '' : 'disabled';
    $seven_pm = in_array('7:00 PM', $time_slots_array)  ? '' : 'disabled';
    $seven30_pm = in_array('7:30 PM', $time_slots_array)  ? '' : 'disabled';
    $eight_pm = in_array('8:00 PM', $time_slots_array)  ? '' : 'disabled';

    $morning_slots = [];
    $afternoon_slots = [];
    $evening_slots = [];

    foreach ($time_slots_array as $time) {
        $time_parts = explode(' ', $time);
        $time_value = str_replace([':'], '', $time_parts[0]); // Remove colon from time

        if ($time_parts[1] === 'AM') {
            if ($time_value >= '600' && $time_value <= '1130') {
                $morning_slots[] = $time;
            }
        } elseif ($time_parts[1] === 'PM') {
            if ($time_value >= '100' && $time_value <= '530') {
                $afternoon_slots[] = $time;
            } elseif ($time_value >= '600' && $time_value <= '800') {
                $evening_slots[] = $time;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Apt Iba Pa | <?php echo $property_name ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"/>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
    <link href="css/view_property.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

    <!-- Vendor Files -->
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>


    <!-- Google reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
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
    
  </head>
  <body style="background-color: 	#f2f6f7">
    <style>
        <?php 
        //include('css/view_property.css'); 
        //include('css/all.css');
        ?>
    </style>

    <!-- Navbar -->
    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>

    <!-- Navbar ends -->


<input type="hidden" value="<?php echo $property_id ?>" name="property_id" id="property_id">
<input type="hidden" value="<?php echo $property_name ?>" name="property_name" id="property_name">
<input type="hidden" value="<?php echo $landlord_id ?>" name="landlord_id" id="landlord_id">
    <!-- Carousel code starts here -->
    <div class="container-fluid">
      <h1 class="text-center fw-bold display-1 mt-5 mb-5"> <?= $property_name ?> </h1>
      <div class="row">
        <div class="col mb-3 d-flex justify-content-end ">
          <a class="btn btn btn-outline-primary viewAllGallery" href="view_gallery.php?property_id=<?= $property_id ?>" role="button">View all photos</a>
        </div>
      </div>
      <div id="imageModal" class="modal">
        <div id="contentImg" class="modal-content">
                <span class="close">&times;</span>
                <img id="modalImage" style="width:100%">
                <div id="modalCaption">
            </div>
      </div>
    </div>
      <div class="row">
          <div class="col-12 m-auto">
              <div class="owl-carousel owl-theme carousel-container">
              <?php foreach($images as $index => $img){
              $image = $img['image_path'];
              $title = $img['title'];
              $modalID = 'modal' . $index;
              ?>
              <div class="item">
                  <div class="card border-0 shadow">
                      <img src='resources/images/properties/<?php echo $image ?>' alt="<?php echo $title ?>" class="card-img-center modal-trigger" data-image-src='<?php echo $image ?>'>
                      <div class="card-body">
                          <div class="card-title text-center">
                              <h4><?php echo $title ?></h4>
                          </div>
                      </div>                   
                  </div>
              </div>
              <?php } ?>
              </div>
          </div>
      </div>
  </div>

  

    <!-- Carousel code ends here -->

<!-- Start of Property Information -->

<div class="container pt-5 pb-5 viewP">
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-10">
          <h3 class="name"><?= $property_name ?></h3>
        </div>

        <div class="col-2 ps-4 justify-content-end">
          <!-- <button onclick="Toggle1()" id="btnBm" class="btn btnBookmark">
            <i class="fa-solid fa-bookmark fa-3x"></i>
          </button> -->
          <?php if(isset($_SESSION['user_id'])) {

                $bookmark = new Bookmark();
                $bookmark->setConnection($connection);
                $bookmark = $bookmark->checkBookmark($property_id, $user_id);
                
            ?>
                    <form class="save">
                    <?php if (isset($bookmark['status']) && $bookmark['status']===1) {?>
                      <button
                        type="button"
                        class="fa-solid btnBookmark fa-bookmark fa-3x"
                        value="1"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmarkProperty(<?= $property_id ?>)"
                        ></button>
                    <?php } elseif(isset($bookmark['status']) && $bookmark['status']===2) { ?>
                        <button
                        type="button"
                        class="fa-regular btnBookmark fa-bookmark fa-3x"
                        value="2"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmarkProperty(<?= $property_id ?>)"
                        ></button>
                    <?php } else {?>
                        <button
                        type="button"
                        class="fa-regular btnBookmark fa-bookmark fa-3x"
                        value="0"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmarkProperty(<?= $property_id ?>)"
                        ></button>
                    <?php } ?>
                    </form>
                    <?php } else { ?>
                        <form action="login" method="post" class="save">
                      <button
                        type="submit"
                        name="save"
                        class="fa-regular fa-bookmark btnBookmark fa-3x"
                      ></button> <!-- class="fa-regular fa-bookmark fa-3x" -->
                    </form>
                    <?php } ?>
        </div>

        <div class="row">
            <div class="h4 mt-3 col location">
              <div>
                <i class="fas fa-map-marker-alt"></i> <?= $full_address ?>
              </div> 
            </div>
        </div>

      </div>

      <div class="row">
        <div class="col-sm-11 mt-5 viewpDescription">
          Description
          <div class="description">
            <?= $description ?>
          </div>
        </div>
      </div>


    </div>
    <!-- closing tag of 1st col-md-6 -->

    <div class="col-md-6">
      <div class="row style="padding-right: 60px;">

      

        <div class="col col-lg-6 justify-content-center mt-5 mt-lg-0 p-lg-5 ml-auto">
          <h4 class="aptStarts" style="text-align: center;">
            Rent starts at
          </h4>
          <h3 class="aptPrice">
            &#8369;<?= $lowest_rate ?><span class="monthly">/Monthly</span>
          </h3>
        </div>

       
          <div class="col-12 col-lg-6 mt-0" style="padding-top: 20px;">
            <div class="btnRating">

              <div class="row">
              <i class="fa-solid fa-star starRating me-2"><span class=ratingOutOf><?= $show_reviews ?></span></i>
              </div>

              <div class="row" style="padding-top: 10px;">
              <span class="revs">(<?= $total_reviews?> reviews)</span>
              </div>
              
            </div>
            
          </div>

      </div>

      <?php if(!isset($_SESSION['user_id'])){ ?>
      <div class="row py-3">
        <div class="col-12 col-lg-6">
          <a href="login.php" class="btnViewP">Request a Visit</a>
        </div>
        <div class="col-12 col-lg-6">
          <a href="login.php" class="btnViewP">Reserve a Room</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="row py-3">
        <div class="col-12 col-lg-6">
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#requestVisit">Request a Visit</a>
        </div>
        <div class="col-12 col-lg-6">
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#reserveRoom">Reserve a Room</a>
        </div>
      </div>
    <?php } ?>

    </div>
    <!-- closing tag of 1st col-md-6 -->
  </div>
  <!-- closing tag of container viewP row -->
</div>
<!-- closing tag of container viewP-->


    

<!-- Start of Property Amenities under Property Information -->
<div class="container pt-3 amenities">
  <div class="row">
    <div class="col-md-6">
      <h3 class="name">Property Amenities</h3>
      
    <hr />
    </div>

    <div class="col-md-6 text-md-start order-2 order-md-0">

        <div class="h5 d-none d-md-block">
          <span class="name h3">House Rules</span>
        </div>

        <div class="name h3 d-block d-md-none">House Rules</div>

      <hr />
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="text-center" >
          <div class="row mt-3">
            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $aircon===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-air-conditioner"></i><span> Aircon</span></p>
                </div>
                <div class="row">
                    <p <?php echo $bathroom===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-person-to-door"></i><span> Bathroom</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $cabinet===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $cctv===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-camera-cctv"></i><span> CCTV</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $drinking_water===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-bucket"></i><span> Drinking Water</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $elevator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Elevator</span></p>
                </div> 
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $emergency_exit===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-person-to-door"></i><span> Emergency Exit</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $food_hall===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-kitchen-set"></i><span> Food Hall</span></p>
                </div>
                <div class="row">
                    <p <?php echo $laundry===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-washing-machine"></i><span> Laundry</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $lounge===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-chair"></i><span> Lounge</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $microwave===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-microwave"></i><span> Microwave</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $parking===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-blinds-raised"></i><span> Parking</span></p>
                </div> 
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $refrigerator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-refrigerator"></i><span> Refrigerator</span></p>
                </div>          
                <div class="row">
                    <p <?php echo $security===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Security</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $sink===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-sink"></i><span> Sink</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $study_area===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-fan-table"></i><span> Study Area</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $tv===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-tv"></i><span> TV</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $wifi===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-wifi"></i><span> Wifi</span></p>
                </div>          
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- House Rules -->
    <div class="col-12 col-lg-6 order-3 order-md-0">

      <div class="row">
        
        <div class="row mt-3">
          <div class="col-12 col-lg-6 description">
            
            <div class="row">
              <div class="col">
                <?php if($pets===0){ ?>
                  <p style="text-decoration: line-through">
                    <? } else{ ?> 
                    <p> 
                    <?php } ?>
                    <i class="fa-solid fa-paw"></i>
                    <span> Pets are allowed</span>
                  </p>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <?php if($visitors===0){ ?>
                      <p style="text-decoration: line-through">
                      <? } else{ ?> 
                      <p> 
                      <?php } ?>
                  <i class="fa-solid fa-user-group-simple"></i>
                  <span> Guests are allowed</span>
                </p>
              </div>
            </div>
            
            <div class="row">
              <div class="col">
                <?php if($smoking===0){ ?>
                      <p style="text-decoration: line-through">
                      <? } else{ ?> 
                      <p> 
                      <?php } ?>
                  <i class="fa-regular fa-smoking"></i>
                  <span> Smoking/Vaping not allowed</span>
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <?php if($alcohol===0){ ?>
                      <p style="text-decoration: line-through">
                      <? } else{ ?> 
                      <p> 
                      <?php } ?>
                  <i class="fa-regular fa-wine-bottle"></i>
                  <span> Alcoholic drinks not allowed</span>
                </p>
              </div>
            </div>
            

          </div>

          <div class="col-12 col-lg-4 description ps-md-5 ms-md-3">
            <?php if($curfew===0){ ?>
            <div class="row">
                <p style="text-decoration: line-through">
                <i class="fa-solid fa-clock-three"></i>
                <span> Curfew Hours</span>
                </p>
            </div>
            <?php } elseif($curfew===1){ ?> 
            <div class="row">
                <p>
                <i class="fa-regular fa-clock-three"></i>
                <span> Curfew Hours</span>
                </p>
            </div>
            <div class="row" style="padding-left: 22px">
              <p>
                <span> <?php echo $from_curfew . ' to ' . $to_curfew ?></span>
              </p>
            </div>
            <?php } ?>

            <div class="row">
            <?php if($visitors===0){ ?>
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-sharp fa-regular fa-hourglass-clock"></i>
                  <span> Guests Hours</span>
                </p>
              </div>

              <?php } else{ ?> 
                <p>
                    <i class="fa-sharp fa-regular fa-hourglass-clock"></i>
                    <span> Guests Hours</span>
                </p>
            </div>

            <div class="row" style="padding-left: 22px">
              <p>
                <span> <?php echo $from_visit . ' to ' . $to_visit ?></span>
              </p>
            </div>
            <?php } ?>

          </div>

          
        </div>
          
        
  
      </div>

    </div>



  </div>
</div>

<!-- Start of Room Amenities under Property Information -->
<div class="container pt-5 amenities">
  <div class="row">
    <div class="col-12 text-center">
      <h3 class="name">Types of Rooms</h3>
    </div>
  </div>

    <hr />
    <?php 
$counter = 0;
echo '<div class="container-fluid jumbuildings">'; // Open the main container outside the loop
echo '<section class="typesOfRooms">'; // Open the typesOfRooms section
echo '<div class="container">';
echo '<div class="box-container">';

foreach ($units as $unit_list) {
    $unit_total = $unit_list['total_units'];
    $occupied_units = $unit_list['occupied_units'];
    $available_units = intval($unit_total) - intval($occupied_units);

    if ($counter % 3 == 0) {
        // Open a new row for every three columns
        echo '<div class="row column-gap-3 justify-content-center">';
    }
    ?>

    <div class="col-12 col-sm-6 col-md-4 mt-4">
        <div class="box">
            <div class="row justify-content-center">
                <span class="fa-stack fa-3x">
                    <i class="fa-solid fa-circle fa-stack-2x"></i>
                    <h1 class="fa-stack-1x" style="font-size: 4rem; font-weight: 600; color: #ff5a3d;"><?= $available_units; ?></h1>
                </span>
            </div>
            <div class="col-12 mt-3">
                <h5 style="font-size: 1.5rem; font-weight: 600; color: #ff5a3d;"> units available</h5>
                <h1 style="font-size: 3rem; font-weight: 600;">₱<?= $unit_list['monthly_rent']; ?></h1>
                <h4 style="font-size: 2rem; font-weight: 600; "><?= $unit_list['unit_type']; ?></h4>
            </div>
        </div>
    </div>

    <?php

    if ($counter % 3 === 2 || $counter === count($units) - 1) {
        // Close the row after displaying three columns or if it's the last room
        echo '</div>';
    }

    $counter++;
}

echo '</div>'; // Close the box-container
echo '</div>'; // Close the container
echo '</section>'; // Close the typesOfRooms section
echo '</div>'; // Close the main container
?>

<!--  -->
    </div>


    </div>

  </div>

  <!-- End of Room Amenities under Property Information -->
</div>

</div>




<!-- Start of Google Map under Property Information -->

<div class="container pt-5">
  <div class="row">
    <div id="map"></div>
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d962.807197098562!2d120.59276596960956!3d15.145774899088007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f313262cc467%3A0xa12b7889c166e418!2sJaeden%20Kent%20Residence%20%2F%20Batac%20-Valencia!5e0!3m2!1sen!2sph!4v1690310871739!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
  </div>
</div>
<style>
        #map {height: 600px; width: 1350px }
    </style>
<script>
var map_center = [<?= $latitude ?>, <?= $longitude ?>];
        var mapOptions = {
        center: map_center,
        zoom: 30
        }
        var map = L.map('map', mapOptions);

        var aufIcon = L.icon({
            iconUrl: 'resources/images/AUF.png',
            iconSize: [80, 100], // Set the size of the icon
            iconAnchor: [16, 32], // Set the anchor point of the icon
            popupAnchor: [0, -32] // Set the anchor point for the popup
        });

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        var aufMarker = L.marker([15.145604192850909, 120.59442965723909], { icon: aufIcon }).addTo(map);
        aufMarker.bindPopup("<b>ANGELES UNIVERSITY FOUNDATION</b>").openPopup();

        var marker = L.marker([<?= $latitude ?>, <?= $longitude ?>]).addTo(map);
        marker.bindPopup("<b><?= $property_name ?></b><br><?= $barangay?><br><a href='view.php?property_id=<?php echo $property_id ?>'>View</a>").openPopup();

        

</script>
<!-- End of Google Map under Property Information -->


<!-- Start of Reviews under Property Information -->
<div class="container-fluid mt-5" style="background-color: #0a2c3d;">
<div class="container pt-5">
    <div class="row">
            <div class="testimonials-section px-5">
                
                <!-- Section Header Starts -->
              <div class="row">
                <div class="col-10">
                  <header class="section-header">
                      <h1>Reviews</h1>
                  </header>
                    <div class="row">
                      <div class="col-sm">
                        <div class="review-p">
                          <p>How others rated this apartment</p>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="col-lg-2 section-header-btn">
                    <?php if(isset($_SESSION['user_id'])) { 
                        $check_review = new Review();
                        $check_review->setConnection($connection);
                        $check_review = $check_review->checkReview($user_id, $property_id);
                        
                    ?>
                    <a <?php echo isset($check_review) ? 'class="btnDisabledReview tooltip" id="disabledReview" title="Only one review per property is allowed."' : 'class="btnReview"  data-bs-toggle="modal" data-bs-target="#addReview"'?>>Add a review</a>
                    <?php } else { ?>
                    <a class="btnReview" href="login.php">Add a review</a>
                    <?php } ?>
                </div>

              </div>
              <!-- Section Header Ends -->
            
                <!-- Owl Carousel Slider Starts -->
                <div class="owl-carousel owl-theme testimonials-container">

                    <?php 
                    foreach($display_reviews as $display_review) { 
                        $review_name = $display_review['first_name'] . ' ' . $display_review['last_name'];
                        $get_date = $display_review['review_date'];
                        $date = new DateTime($get_date);
                        $review_date = $date->format('F j, Y \a\t g:i A');
                        $rating = $display_review['rating'];
                        $description = $display_review['description'];
                        $review_image = $display_review['image_name'];
                    ?>
                    <!-- Item1 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="resources/images/users/<?=$review_image?>" alt=" ">
                            </div>
                            <div class="profile-desc">
                                <span><?= $review_name ?></span>
                                <span class="ratings">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fa-solid fa-star"></i>';
                                } else {
                                    echo '<i class="fa-regular fa-star"></i>';
                                }
                                }
                                ?>
                                  <i class="num"> <?= $rating ?></i>
                                </span>
                                <span class="date"><?= $review_date ?></span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <p><?= $description ?></p>
                        </main>

                    </div>
                    <!-- Item1 Ends -->
                    <?php } ?>
            
                </div>
                <!-- Owl Carousel Slider Ends -->
            
            </div>

            
    </div>
  </div>
</div>
  
  <!-- End of Reviews under Property Information -->

<!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <p class="statusU text-center"><span>FAQs</span></p>
        <h2 class="mt-3">Frequently Asked Questions</h2>

        <p>Questions about the property that are frequently asked by tenants are shown here. If you have any queries that are not provided, you may send a message to the owner of the property.</p>
      </div>

      <div class="faq-list">
        <ul>
            <?php 
                $faqlist = 1;
                $property_faqs = new PropertyFaq();
                $property_faqs->setConnection($connection);
                $property_faqs = $property_faqs->getFaqs($property_id);
                foreach($property_faqs as $faqs){
                    $question = $faqs['question'];
                    $answer = $faqs['answer'];
            ?>
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-<?php echo $faqlist ?>"><?php echo $question ?> <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-<?php echo $faqlist ?>" class="collapse show" data-bs-parent=".faq-list">
              <p>
                <?php echo $answer ?>
              </p>
            </div>
          </li>
          <?php $faqlist++; } ?>

        </ul>
      </div>
      <hr style="margin-top: 30px">
    </div>
    
  </section>
<!-- End Frequently Asked Questions Section -->


         <!-- Featured section starts -->

    <!-- <div class="container-fluid featuredHtml"> -->
  <section class="listings">
      <div class="section-title1">
        <p class="statusU text-center"><span>Properties</span></p>
        <h2 class="featureHeading p-3 text-center">Featured Listings</h2>
      </div>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
                <?php 
                //Get all properties
                    $featured_properties = new Property();
                    $featured_properties->setConnection($connection);
                    $featured_properties = $featured_properties->getProperties();
                    
                    shuffle($featured_properties);
                    $random_properties = array_slice($featured_properties, 0, 3);

                    foreach($random_properties as $featured_property){ 
                        
                    $featured_property_name = $featured_property['property_name'];
                    $featured_barangay = $featured_property['barangay'];
                    $featured_lowest_rate = $featured_property['lowest_rate'];
                    $featured_property_type = $featured_property['property_type'];
            
                    $featured_property_id = $featured_property['property_id'];
                    
                    $featured_images = new Image();
                    $featured_images->setConnection($connection);
                    $featured_images = $featured_images->getDisplayImage($featured_property_id);

                    if($featured_images){
                        $featured_image = $featured_images['image_path'];
                    } else {
                        $featured_image = "logo.png";
                    }

                    $reviews = new Review();
                    $reviews->setConnection($connection);
                    $reviews = $reviews->getRatings($featured_property_id);
                    
                    if(count($reviews)>0){
                        $total_ratings = 0;
                        $total_reviews = count($reviews);
                        
                        foreach ($reviews as $review) {
                            $total_ratings += $review["rating"];
                        }

                        $average_rating = number_format(($total_ratings / $total_reviews), 1);

                        if($total_reviews>1){
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
                        } else{
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
                        }
                    } else{
                        $show_reviews = "No reviews yet";
                    }
                    
                    if(isset($_SESSION['user_id'])){
                    $featured_bookmark = new Bookmark();
                    $featured_bookmark->setConnection($connection);
                    $featured_bookmark = $featured_bookmark->checkBookmark($featured_property_id, $user_id);
                    }
                    ?>
              <div class="col-12 col-md-6 col-xl-4 mt-4">
                <div class="box">
                  <div class="thumb">
                    <input type="hidden" value="<?= $featured_property_id ?>" name="property_id" id="property_id">
                    <p class="type"><span><?= $featured_property_type ?></span></p>
                    <?php if(isset($_SESSION['user_id'])) {?>
                    <form class="save">
                    <?php if (isset($featured_bookmark['status']) && $featured_bookmark['status']===1) {?>
                      <button
                        type="button"
                        class="fa-solid fa-bookmark fa-3x"
                        value="1"
                        id="featBookmarkBtn-<?= $featured_property_id ?>"
                        onclick="bookmark(<?= $featured_property_id ?>)"
                        ></button>
                    <?php } elseif(isset($featured_bookmark['status']) && $featured_bookmark['status']===2) { ?>
                        <button
                        type="button"
                        class="fa-regular fa-bookmark fa-3x"
                        value="2"
                        id="featBookmarkBtn-<?= $featured_property_id ?>"
                        onclick="bookmark(<?= $featured_property_id ?>)"
                        ></button>
                    <?php } else {?>
                        <button
                        type="button"
                        class="fa-regular fa-bookmark fa-3x"
                        value="0"
                        id="featBookmarkBtn-<?= $featured_property_id ?>"
                        onclick="bookmark(<?= $featured_property_id ?>)"
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
                    <img class="w-100" src="resources/images/properties/<?=$featured_image?>" alt=""/>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-sm-8">
                      <h3 class="name"><?= $featured_property_name?></h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> <?= $barangay?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 justify-content-start col-lg-4 rentName">
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
                    <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a> 
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



  <!-- End of Similar Apartment Listings -->



<!-- End of Property Information -->
 

    <!-- Footer -->

    
      <?php include("footer.php"); ?>
      
  
      <!-- Footer ends -->
  
<!-- Add a Review Modal -->

<!-- Modal -->
<div class="modal fade" id="addReview" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="addReviewLabel">Add a Review</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="review-form">
          <h3>Overall rating</h3>
          <form action="review" method="POST" id="reviewForm">
          <input type="hidden" id="recaptcha_token" name="recaptcha_token">
            <div class="rating">
              <input type="number" name="rating" hidden>
              <i class='bx bx-star star' style="--i: 0;"></i>
              <i class='bx bx-star star' style="--i: 1;"></i>
              <i class='bx bx-star star' style="--i: 2;"></i>
              <i class='bx bx-star star' style="--i: 3;"></i>
              <i class='bx bx-star star' style="--i: 4;"></i>
            </div>
            <br>
            <h4 class="text-start">Leave a review about the property</h4>
            <textarea name="description" cols="30" rows="5" placeholder="Property is really accesible to all establishments, and the amenities are complete."></textarea>
            <br>
            <div class="g-recaptcha" data-sitekey="6LfiFwwpAAAAAFKLAQULvN4zVe2sda0DRu5yxT95"></div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary fs-5" onclick="event.preventDefault()" data-bs-dismiss="modal">Cancel</button>
        <button type="button" name="add_review" id="add-review" class="btn btn-primary fs-5"  onclick="submitForm()">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <!-- Request a Visit Modal -->

  <!-- Modal -->

  <?php include('appointment-modal.php'); ?>

<!-- Modal -->
<div class="modal fade" id="requestVisit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestVisitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="requestVisitLabel">Schedule a Visit </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-x-hidden  modalTimeslots">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgTimeSlots timeSlots">

                <div class="row">
                  <h3 class="text-center">View the property on</h3>
                  <div class="col-md">
                    <h2 class="ms-3 apptDate" id="selected_date">  </h2>
                  </div>
                </div>

                <div class="row justify-content-center">

                  
                  <div class="col-md-4">

                    <form action="#">
                      <div class="form-group p-3 datePicker">
                        <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                        <input type="hidden" name="property_id" value="<?= $property_id ?>" id="property_id">
                        <input type="hidden" name="landlord_id" value="<?= $landlord_id ?>" id="landlord_id">
                      </div>
                      
                      <h5 class="text-center">*Click to change date</h5>
                    </form>

                  </div>
                </div>


                <div id="time_slots">
                <?php if(count($morning_slots) > 0) { ?>
                <div class="row ps-4 h3 mt-2">
                  <h2 class="dayzone">
                    <img src="resources/images/dayzone1.png" alt=""/>
                    Morning
                  </h2>
                  <h2 class="timezone">8:00 AM to 11:30 AM</h2>
                </div>
                
                <?php
                //$morning_slots = array("6:00 AM","6:30 AM","7:00 AM","7:30 AM","8:00 AM","8:30 AM","9:00 AM","9:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM");

                $row_count = 0;
                $col_count = 0;
                
                ?>
                <div class="row pt-lg-5 justify-content-center">
                <?php
                foreach ($morning_slots as $time_slot) {
                if ($col_count == 4) {
                ?>
                    </div><div class="row pt-lg-5 justify-content-center">
                <?php
                    $col_count = 0;
                }
                ?>
                
                <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
                <button class="btnDisabled" disabled>
                        <label class="radio w-100 justify-content-center d-flex">
                          <input type="radio" name="time_slot" id="time_slot" value="<?= $time_slot ?>" required disabled/>

                          <div class="row justify-content-between radioVisitTime align-items-center"
                            id="pickVisitTime">

                            <div class="col-12">
                              <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i><?= $time_slot ?></span>
                            </div>

                          </div>
                        </label>
                    </div>

                <?php
                $col_count++;
                }
                ?>
                </div>
                
                <?php } if(count($afternoon_slots) > 0) { ?>
                <div class="row ps-4 h3 mt-5">
                  <hr>
                  <h2 class="dayzone pt-4">
                    <img src="resources/images/dayzone2.png" alt=""/>
                    Afternoon
                  </h2>
                  <h2 class="timezone">1:00 PM to 5:30 PM</h2>
                </div>
                  
                <?php
                //$afternoon_slots = array("1:00 PM","1:30 PM","2:00 PM","2:30 PM","3:00 PM", "3:30 PM","4:00 PM","4:30 PM","5:00 PM","5:30 PM");

                $row_count = 0;
                $col_count = 0;
                ?>

                <div class="row pt-lg-5 justify-content-center">
                <?php
                foreach ($afternoon_slots as $time_slot) {
                if ($col_count == 4) {
                ?>
                    </div><div class="row pt-lg-5 justify-content-center">
                <?php
                    $col_count = 0;
                }
                ?>
                <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
                <button class="btnDisabled" disabled>
                        <label class="radio w-100 justify-content-center d-flex">
                          <input type="radio" name="time_slot" id="time_slot" value="<?= $time_slot ?>" required disabled/>

                          <div class="row justify-content-between radioVisitTime align-items-center"
                            id="pickVisitTime">

                            <div class="col-12">
                              <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i><?= $time_slot ?></span>
                            </div>

                          </div>
                        </label>
                    </div>
                <?php
                $col_count++;
                }
                ?>
                </div>
                <?php } if(count($evening_slots) > 0) { ?>
                <div class="row ps-4 h3 mt-5">
                  <hr>
                  <h2 class="dayzone pt-4">
                    <img src="resources/images/dayzone3.png" alt=""/>
                    Evening
                  </h2>
                  <h2 class="timezone">6:00 PM to 8:00 PM</h2>
                </div>
                  
                <?php
                //$evening_slots = array("6:00 PM","6:30 PM","7:00 PM","7:30 PM","8:00 PM");

                $row_count = 0;
                $col_count = 0;
                ?>

                <div class="row pt-lg-5 justify-content-center">
                <?php
                foreach ($evening_slots as $time_slot) {
                if ($col_count == 4) {
                ?>
                    </div><div class="row pt-lg-5 justify-content-center">
                <?php
                    $col_count = 0;
                }
                ?>
                <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-lg-0 d-flex justify-content-center">
                <button class="btnDisabled" disabled>
                        <label class="radio w-100 justify-content-center d-flex">
                          <input type="radio" name="time_slot" id="time_slot" value="<?= $time_slot ?>" required disabled/>

                          <div class="row justify-content-between radioVisitTime align-items-center"
                            id="pickVisitTime">

                            <div class="col-12">
                              <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i><?= $time_slot ?></span>
                            </div>

                          </div>
                        </label>
                    </div>
                <?php
                $col_count++;
                }
                ?>
                </div>
                <?php } ?>
                </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" class="btnConfirmDetails" data-bs-toggle="modal" data-bs-target="#confirmDetails" id="btnConfirm">Next</button>
        </div>
      </div>
    </div>
  </div>
  </div>


  
  <!-- Visit Confirmation Details -->

  <!-- Modal -->
  <div class="modal fade" id="confirmDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="confirmDetailsLabel">Confirmation Details</h1>
        </div>
        <div class="modal-body overflow-x-hidden overflow-y-hidden modalConfirmDetails">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-3 bgConfirmDetails confirmSlots">

                <!-- <div class="row">
                  <div class="col-12"> -->
                    
                      <img class="rounded img-fluid d-block mx-auto" src="resources/images/properties/<?= $display_image ?>" width="400">
                    
                  <!-- </div>
                </div> -->

                <div class="row">       
                  <div class="col-md">
                    <h2 class="ms-3 pt-2 mt-3 apptDormName"><?= $property_name ?></h2>
                    <h2 class="ms-3 pt-2 apptDormAddress"><?= $full_address ?></h2>
                  </div>
                </div>
                
                <div class="row ps-md-4 h3 mt-2">
                  <hr>
                  <h2 class="visitDetailsTitle pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Contact Person
                  </h2>
                  <h2 class="visitDetailsSubtitle"><?= $full_name ?></h2>
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <h2 class="visitDetailsTitle pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Contact Number
                  </h2>
                  <h2 class="visitDetailsSubtitle"><?= $contact_number ?></h2>
                </div>

                <div class="row ps-md-4 h3 mt-2">
                  <h2 class="visitDetailsTitle">
                    <img src="images/dayzone1.png" alt=""/>
                    Schedule of Visit
                  </h2>
                  <h2 class="visitDetailsSubtitle" id="requested_time"></h2>
                  <h2 class="visitDetailsSubtitle" id="requested_date"></h2>
                </div>


              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestVisit">Previous</button>
          <button type="button" class="btn btn-primary" class="btnConfirmSuccess" data-bs-toggle="modal" data-bs-target="#confirmSuccess" id="set_appointment" value="set_appointment">Confirm</button>
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

            <form method="POST" action="appointments">

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
                  <h2 class="successDetailsDate text-center" id="requested_date2">
                    
                  </h2>
                  <h2 class="successDetailsTime text-center" id="requested_time2"></h2>
                </div>
                
                <!-- <div class="row h3 d-flex justify-content-center mt-5">
                  <div class="col-10 col-md-9 d-flex justify-content-center">
                    <button type="button" class="btn w-100 btnConfirmApptGC"><i class="fa-light fa-calendar me-2"></i>Add to Google Calendar</button>
                  </div>
                </div> -->

                <div class="row h3 d-flex justify-content-center mt-2">
                  <div class="col-10 col-md-9 d-flex justify-content-center">
                    <button type="submit" class="btn w-100 btnConfirmApptGo">Go to Appointments</button>
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



  <script>
    $(document).ready(function() {
    var pickDateInput = $("#pick-date");
    var selectedDateH2 = $("#selected_date");
    var property_id = $("#property_id");
    var landlord_id = $("#landlord_id");

    // Set the min attribute to today's date
    var currentDate = new Date();
    currentDate.setUTCHours(currentDate.getUTCHours() + 8); // Convert UTC to Philippine time
    pickDateInput.attr("min", formatDate(currentDate));

    // Format a date as yyyy-mm-dd for setting min attribute
    function formatDate(date) {
        var yyyy = date.getFullYear();
        var mm = String(date.getMonth() + 1).padStart(2, '0');
        var dd = String(date.getDate()).padStart(2, '0');
        return yyyy + "-" + mm + "-" + dd;
    }

    // When the date input changes, update the text on the h2 element
    pickDateInput.on('change', function() {
        var inputDate = pickDateInput.val();
        var propertyId = property_id.val();
        var landlordId = landlord_id.val();

        var date = new Date(inputDate);

        // Continue with the rest of your code
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var year = date.getFullYear();
        var month = date.getMonth();
        var day = date.getDate();
        var formattedDate = monthNames[month] + " " + (day < 10 ? '0' : '') + day + ", " + year;
        selectedDateH2.text(formattedDate);

        performAjax({ 
            set_date: inputDate, 
            property_id: propertyId, 
            landlord_id: landlordId 
        });
    });

    function performAjax(data) {
        $.ajax({
            url: 'check-date',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#time_slots').html(response);
            }
        });
    }
    var confirmDetailsModal = document.getElementById('btnConfirm');
    confirmDetailsModal.addEventListener('click', function() {
        var requestedTime = $('#requested_time');
        var requestedDate = $('#requested_date');
        var requestedTime2 = $('#requested_time2');
        var requestedDate2 = $('#requested_date2');
        var selectedDate = document.querySelector('input[name="time_slot"]:checked').value;

        requestedTime.text(selectedDate);
        requestedDate.text(selectedDateH2.text());
        requestedTime2.text(selectedDate);
        requestedDate2.text(selectedDateH2.text());
    });
    
    var setAppointment = $('#set_appointment');
    setAppointment.on('click', function() {
        //var setAppointment = setAppointment.val();
        var property_id = $('#property_id').val();
        var inputDate = pickDateInput.val();
        var inputTime = document.querySelector('input[name="time_slot"]:checked').value;

        performAjaxAppointment({ 
            set_appointment: setAppointment.val(),
            set_date: inputDate, 
            set_time: inputTime,
            property_id: property_id
        });

        function performAjaxAppointment(data) {
        $.ajax({
            url: 'set-appointment',
            type: 'POST',
            data: data,
            success: function(response) {
            }
        }); 
        }
     });
});

    </script>


  <!-- Reserve a Room Modal -->

  <div class="modal fade" id="reserveRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reserveRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="reserveRoomLabel">Reservation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modalReserveroom">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgReserveroom reserveRoomType">

                <div class="row">
                  <h3 class="text-center">Reserve a Unit</h3>
                </div>

                <div class="row justify-content-center mt-2">
                  <div class="col-10">

                    <form action="#">
                      <?php 
                      foreach($units as $unit_list){
                        $unit_total = $unit_list['total_units'];
                        $occupied_units = $unit_list['occupied_units'];
                        $available_units = intval($unit_total) - intval($occupied_units);
                        $unit_id = $unit_list['unit_id'];
                        $unit_type = $unit_list['unit_type'];
                        $monthly_rent = $unit_list['monthly_rent'];
                      ?>
                      <div class="row mt-2">
                        <div class="col-12 col-lg-7 mt-4">
                          <label class="radio w-100">
                            <input type="checkbox" name="unit_id[]" id="unit_id" value="<?= $unit_id ?>" />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName" id="unit_type_<?= $unit_id ?>"><?= $unit_type ?></span>
                                <div class="row">
                                  <span class="roomTypeDetails">₱<?= $monthly_rent ?> | <?= $available_units ?> units left</span>
                                </div>

                              </div>
                      
                              <div class="col-3 my-auto">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                              
                            </div>
                            
                          </label>
                        </div>
                        
                        <div class="col-12 col-lg-5 my-auto" style="background-color:  #f0f7ff55; border-radius:5px;">
                          
                          <div class="reservePriceDetails mb-2 mt-4 text-center">Reservation Fee: ₱<?= $reservation_fee ?></div>
                          
                          <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="button groups">
                            <div class="input-group">

                            <button type="button" class="button minus-btn hollow circle input-group-text" id="btnGroupAddon" data-quantity="minus" data-unit-id= "<?php echo $unit_id ?>" data-field="no_of_units" disabled>
                            <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>

                              <input type="number" name="no_of_units[]"  class="form-control " style="width:70px; text-align:center;" value="0" id="no_of_units_<?php echo $unit_id ?>" disabled>
                              
                            <button type="button" class="button plus-btn hollow circle input-group-text" id="btnGroupAddon" data-quantity="plus" data-unit-id="<?php echo $unit_id ?>" data-field="no_of_units" disabled>
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>

                            </div>
                          </div>
                        

                        </div>
                      </div>
                      
                      <?php } ?>
                        
                      </form>

                  </div>
                  
                </div>

              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentDetails" id="paymentBtn">Next</button>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Reserve confirmed from landlord = proceeds to flash Payment details -->

  <div class="modal fade" id="paymentDetails"  data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="paymentDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="paymentDetailsLabel">Confirm Reservation Payment</h1>
        </div>
        
        <div class="modal-body overflow-x-hidden modalPaymentDetails">

          <div class="container bgPaymentDetails py-5">

            <div class="row justify-content-around">

              <div class="col-5 d-flex justify-content-end align-items-center">
                <img class="rounded img-fluid d-block mx-auto" src="resources/images/users/<?= $image_name ?>" width="150">
              </div>

              <div class="col-12 col-lg-5 justify-content-end my-auto">
              <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control paymentUserFname" disabled id="fullname" name="full_name" value="<?= $full_name ? $full_name : '' ?>">
              </div>

              <div class="mb-3">
                <label for="contactnumber" class="form-label">Contact Number</label>
                <input type="number" class="form-control paymentDetailsDormNumber" disabled id="contactnumber" name="contact_number" value="<?= $contact_number ? $contact_number : '' ?>">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control paymentDetailsDormAddress" disabled id="email" name="email" value="<?= $email ? $email : '' ?>">
              </div>

              </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mx-auto mt-5">
                    <div>
                        <h3>Reservation Summary</h3>
                        <hr>

                        <div class="row mb-2 justify-content-center ">
                          <div class="col-2">
                              <b>No.</b>
                          </div>
                          <div class="col-4">
                              <b>Room Type</b>
                          </div>
                          <div class="col-4">
                              <b>Reservation Fee</b>
                          </div>
                        </div>

                        <div class="row justify-content-center" id="unitDetails">
                          <div class="col-2">
                            
                              <p id="unitQuantity"></p>
                          </div>
                          <div class="col-4">
                          
                              <p id="unitType"></p>
                          </div>
                          <div class="col-4">
                          
                              <p id="reserveFee"></p>
                          </div>
                        </div>
                        
                        <br>

                        <div class="row justify-content-center ">
                          <hr>
                          <div class="col-2">
                              <p></p>
                          </div>
                          <div class="col-4">
                              <b>Total</b>
                          </div>
                          <div class="col-4">
                            
                              <p id="totalFee"></p>
                          </div>
                        </div>
                    </div>
                    </div>
                <div class="col-lg-6 mx-auto mt-5">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2 qr">
                                <!-- Credit card form tabs -->
                                <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                    <li class="nav-item"> <a data-toggle="pill" href="#gcash" class="nav-link active "> <i class="fa-solid fa-wallet me-2"></i> GCash </a> 
                                    </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#maya" class="nav-link"> <i class="fas fa-qrcode mr-2"></i> Maya
                                    </a>
                                    </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> 
                                    </li>

                                </ul>
                            </div> <!-- End -->
                            <!-- Credit card form content -->
                            <div class="tab-content">
                                <!-- credit card info-->
                                <div id="credit-card" class="tab-pane fade pt-3">
                                <form id="payment-form">
                                <input type="hidden" id="full_name" name="full_name" value="<?= $full_name ?>">
                                <input type="hidden" id="email" name="email" value="<?= $email ?>">
                                <input type="hidden" id="total_fee" name="total_fee" value="">
                                <input type="hidden" id="property_id" name="property_id" value="<?= $property_id ?>">
                                <input type="hidden" id="property_name" name="property_name" value="<?= $property_name ?>">

                                <div class="form-group">
                                <label for="card_holder">
                                    <h6>Card Owner</h6>
                                </label>
                                <input type="text" name="card_holder" placeholder="Card Owner Name" required class="form-control" id="card_holder">
                                </div>
                                <div class="form-group">
                                <label for="card-element">
                                    <h6>Card number</h6>
                                </label>
                                <div id="card-element" class="form-control">
                                    <!-- A Stripe Card Element will be mounted here -->
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                    <label><span class="hidden-xs">
                                        <h6>Expiration Date</h6>
                                    </span></label>
                                    <div id="card-expiry" class="form-control">
                                        <!-- Stripe Card Expiry Element will be mounted here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                    <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                    </label>
                                    <div id="card-cvc" class="form-control">
                                        <!-- Stripe Card CVC Element will be mounted here -->
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div id="card-errors" role="alert"></div>
                                <button type="submit" id="submit-payment" class="btn btn-primary">Submit Payment</button>
                            </form>

                                </div>
                            
                            <!-- Paypal info -->
                            <div id="gcash" class="tab-pane fade show active pt-3">
                                <h6 class="pb-2 qr">Scan the GCASH QR Code here: </h6>
                                

                                <img class="rounded img-fluid d-block mx-auto mt-3 mb-3" src="resources/images/qr-code.jpg" width="200">
                                
                                <!-- <p> <button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into my Paypal</button> </p> -->
                                <p class="text-muted"> Note: After settling your payment, you must send the proof of payment to the landlord through inbox. </p>
                            </div> <!-- End -->

                            <div id="maya" class="tab-pane fade pt-3">
                                <h6 class="pb-2 qr">Scan the Maya QR Code here:</h6>
                                <img class="rounded img-fluid d-block mx-auto mt-3 mb-3" src="resources/images/qr-code.jpg" width="200">
                                <p class="text-muted"> Note: After settling your payment, you must send the proof of payment to the landlord through inbox. </p>
                            </div>
                        </div>
                    </div>
                </div>

          </div>
        </div>
      <div>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveRoom">Previous</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveConfirm" id="confirmReserve">Next</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="reserveConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reserveConfirm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="reserveConfirmm">Reservation Confirmation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modalReserveConfirm">

          <div class="container">

          <form method="POST" action="reservations">

              <!-- <img class="rounded img-fluid d-block mx-auto mt-5" src="resources/images/pending-confirmation.webp" width="250"> -->

              <div class="container pb-5 bgReserveConfirm pendingReserveConfirm">

                <div class="row">
                  <div class="col mb-4">
                    <h2 class="apptGreetings">Reservation Accepted</h2>
                    <h2 class="apptGreetingsSub">Waiting for the response and you're all set!</h2>
                  </div>
                </div>


                <div class="row h3 mt-5 mb-3">
                  <h2 class="pendingDetailsTitle text-center">
                    For the mean time you can check the status here:
                  </h2>
                  <h2 class="pendingDetailsSubtitle text-center">
                    The owner of the property will respond within 3 days. If not, kindly send a message for follow ups.</b>.</h2>
                </div>

                <div class="row h3 d-flex justify-content-center mt-2">
                  <div class="col-10 col-md-9 d-flex justify-content-center">
                    <button type="button" class="btn w-100 btnConfirmApptGo">Go to Appointments</button>
                  </div>
                </div>
              </div>
          </form>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <script>

    
    // function performAjaxReservation(data) {
    //     $.ajax({
    //         url: 'reserve',
    //         type: 'POST',
    //         data: data,
    //         success: function(response) {
    //             //openReservationModal();
    //         }
    //     }); 
    // }

    // function performAjaxPayment(data) {
    //     $.ajax({
    //         url: 'payment',
    //         type: 'POST',
    //         data: data,
    //         success: function(response) {
    //             $('#paymentDetails').modal('hide');
    //             $('#reserveConfirm').modal('show');
    //         }
    //     }); 
    // }
  </script>
    <script>  
        function bookmarkProperty(propertyId) {
            var propertyBookmark = document.getElementById(`bookmarkBtn-${propertyId}`);
            var propertyBookmarkVal = propertyBookmark.value;

            ajaxBookmarkProperty({ 
                property_id: propertyId,
                status: propertyBookmarkVal
            });
        };

        function ajaxBookmarkProperty(data) {
            $.ajax({
                url: 'bookmark',
                type: 'POST',
                data: data,
                success: function(response) {
                    var bookmarkBtnChange = document.getElementById(`bookmarkBtn-${data.property_id}`);
                    if (response === '1') {
                        bookmarkBtnChange.classList.replace("fa-regular", "fa-solid");
                        bookmarkBtnChange.setAttribute("value", "1");
                    } else {
                        bookmarkBtnChange.classList.replace("fa-solid", "fa-regular");
                        bookmarkBtnChange.setAttribute("value", "2");
                    }
                    bookmarkBtnChange.setAttribute("onclick", `bookmarkProperty(${data.property_id})`);
                }
            }); 
        }

        function bookmark(propertyId) {
            var Bookmark = document.getElementById(`featBookmarkBtn-${propertyId}`);
            var BookmarkVal = Bookmark.value;

            ajaxBookmark({ 
                property_id: propertyId,
                status: BookmarkVal
            });
        };

        function ajaxBookmark(data) {
            $.ajax({
                url: 'bookmark',
                type: 'POST',
                data: data,
                success: function(response) {
                    var bookmarkBtnChange = document.getElementById(`featBookmarkBtn-${data.property_id}`);
                    if (response === '1') {
                        bookmarkBtnChange.classList.replace("fa-regular", "fa-solid");
                        bookmarkBtnChange.setAttribute("value", "1");
                    } else {
                        bookmarkBtnChange.classList.replace("fa-solid", "fa-regular");
                        bookmarkBtnChange.setAttribute("value", "2");
                    }
                    bookmarkBtnChange.setAttribute("onclick", `bookmark(${data.property_id})`);
                }
            }); 
        }
    </script>
  <script>
// Add event listeners to plus and minus buttons for each unit's input field
$(document).ready(function() {
    $('#reserveConfirm').modal('show');
    var selectedRoomIds = [];
    $('.plus-btn').click(function() {
        var unitId = $(this).data('unit-id');
        var noOfRooms = $('#no_of_units_' + unitId);
        var currentValue = parseInt(noOfRooms.val());
        if (!isNaN(currentValue)) {
        noOfRooms.val(currentValue + 1);
        } else {
        noOfRooms.val(0);
        }
    });

    $('.minus-btn').click(function() {
        var unitId = $(this).data('unit-id');
        var noOfRooms = $('#no_of_units_' + unitId);
        var currentValue = parseInt(noOfRooms.val());
        if (!isNaN(currentValue) && currentValue > 0) {
        noOfRooms.val(currentValue - 1);
        } else {
        noOfRooms.val(0);
        }
    });

    $('input[type="checkbox"]').change(function() {
        
        var unitId = $(this).val();
        var noOfRoomsInput = $('#no_of_units_' + unitId);
        var plusButton = $('.plus-btn[data-unit-id="' + unitId + '"]');
        var minusButton = $('.minus-btn[data-unit-id="' + unitId + '"]');

        if (this.checked) {
        // Checkbox is checked, enable the input and buttons
        noOfRoomsInput.prop('disabled', false);
        plusButton.prop('disabled', false);
        minusButton.prop('disabled', false);
        } else {
        // Checkbox is unchecked, disable the input and buttons
        noOfRoomsInput.prop('disabled', true);
        plusButton.prop('disabled', true);
        minusButton.prop('disabled', true);
        }

        if ($(this).prop('checked')) {
            selectedRoomIds.push(unitId);
            } else {
            // If the checkbox is unchecked, remove its value from the array.
            var index = selectedRoomIds.indexOf(unitId);
            if (index !== -1) {
                selectedRoomIds.splice(index, 1);
            }
        // function getRoomId(selectedRoomIds){

        // }
        }
    });

    $('#paymentBtn').click(function() {
        var unitIds = $('input[name="unit_id[]"]:checked');

        // Clear any existing rows
        $('#unitDetails').empty();

        var totalFee = 0;

        unitIds.each(function() {
            var unitId = $(this).val();
            var unitCount = parseInt($('#no_of_units_' + unitId).val());
            var unitTypeName = $('#unit_type_' + unitId).text();

            var reservationFee = parseInt(<?php echo $reservation_fee ?>); // Replace with your fixed reservation fee
            var unitFee = unitCount * reservationFee;

            totalFee += unitFee;

            // Create a row for each unit
            var newRow = $('<div class="row justify-content-center ">');
            var col1 = $('<div class="col-2">').append('<p class="unit-quantity">' + unitCount + '</p>');
            var col2 = $('<div class="col-4 me-3">').append('<p class="unit-type">' + unitTypeName + '</p>');
            var col3 = $('<div class="col-4">').append('<p class="reserve-fee">' + unitFee + '</p>');

            newRow.append(col1, col2, col3);

            // Append the new row to the container
            $('#unitDetails').append(newRow);
        });
        // Update the total fee
        $('#total_fee').val(totalFee);
        $('#totalFee').text(totalFee);
    });

    var submitBtn = document.getElementById('submit-payment');

    submitBtn.addEventListener('click', function(event) {
       
        $('#paymentDetails').modal('hide');
        $('#reserveConfirm').modal('show');
        
    });

});
</script>


<script src="modal_img.js"></script>

<script>
    function submitForm() {
   
        var captchaToken = grecaptcha.getResponse();
        
        if (captchaToken === "") {
            alert("Please complete the captcha verification.");
            return;
        }

        // Set the captcha token to the hidden field
        $("#recaptcha_token").val(captchaToken);

        // Submit the form
        alert(captchaToken);
        $("#reviewForm").submit();
    }
</script>
  </body>


  

  <!-- javascript -->
  
  <!-- <script src="js/addreview.js"></script> -->
  <!-- <script src="js/accommodations.js"></script> -->
  


  <!-- JS of Carousel -->
  <!-- <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        nav:false,
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

</html>
