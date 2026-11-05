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
    include ("../init.php");
    include ("session.php");
    
    if(isset($_GET['property_id'])){
        $property_id = $_GET['property_id'];
    } else {
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
    
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

    $electric_bill = $details['electric_bill'];
	$water_bill = $details['water_bill'];
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
    
    //var_dump($images);
    //$property_id = 26;
        //$user_id = 33; //change with session

    $disabled_dates = [];

    $date_time = new Schedule('','','');
    $date_time->setConnection($connection);
    $date_time = $date_time->getDateTime($property_id);

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
            $show_reviews = $average_rating . ' out of 5';
        } else{
            $show_reviews = $average_rating . ' out of 5';
        }
    } else{
        $total_reviews = 0;
        $show_reviews = "No reviews yet";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>

    <link href="css/view_owner.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
    <!-- <link href="css/view_property.css" rel="stylesheet" /> -->

    <!-- Vendor Files -->
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

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

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
  </head>
  <body style="background-color: #f2f6f7">
    <style>
        <?php 
        //include('css/view_property.css'); 
        //include('css/all.css');
        ?>
    </style>
        <?php 
        //include('css/view_property.css'); 
        //include('css/all.css');
        ?>
    </style>
    <!-- Navbar -->
<?php //include('navbar.php'); ?>
<div class=" backAdmin mt-4 ms-3 fs-5">
    <a class="backAdmin" href="properties">Go back </a>
</div>
    <!-- Navbar ends -->


    <input type="hidden" value="<?php echo $property_id ?>" name="property_id" id="property_id">
<input type="hidden" value="<?php echo $property_name ?>" name="property_name" id="property_name">
<input type="hidden" value="<?php echo $landlord_id ?>" name="landlord_id" id="landlord_id">
    <!-- Carousel code starts here -->
    <div class="container-fluid">
      <h1 class="text-center fw-bold display-1 mt-5 mb-5"> <?= $property_name ?> </h1>
      <div class="row">
        <div class="col mb-3 d-flex justify-content-between ">
            <a class="btn btn btn-outline-primary viewAllGallery" href="edit-property.php?property_id=<?php echo $property_id ?>" role="button">Edit Information</a>
            
            <!-- Hidden file input styled to look like a button -->
            <!-- <input type="file" id="imageUpload" name="image" style="display: none;" accept="image/*"> -->

            <!-- Button styled to look like an "Add Image" button -->
            <label for="imageUpload" id="imageUpload" class="btn btn-outline-primary saveEditButton">Add an image</label>
        </div>
      </div>
      <div class="row">
          <div class="col-12 m-auto">
              <div class="owl-carousel owl-theme carousel-container">
                <?php foreach($images as $img){
                    $image_id = $img['image_id'];
                    $image_path = $img['image_path'];
                    $title = $img['title'];
                ?>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src='../resources/images/properties/<?php echo $image_path ?>' name="image" alt="" class="card-img-center">
                            <i class="fa-solid fa-pencil fa-3x btnEditG position-absolute" href="#" role="button" data-bs-toggle="modal" data-bs-target="#editCarouselImg" data-image-id="<?php echo $image_id ?>"></i>
                            <i class="fa-solid fa-trash-can fa-3x btnDeleteG position-absolute" href="#" role="button" data-bs-toggle="modal" data-bs-target="#deleteCarouselImg" data-image-id="<?php echo $image_id ?>"></i>
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
      <div class="row">
      

        <div class="col justify-content-center mt-5 mt-lg-0 p-lg-5">
          <h4 class="aptStarts" style="text-align: center;">
            Rent starts at
          </h4>
          <h3 class="aptPrice">
            &#8369;<?= $lowest_rate ?><span class="monthly">/Monthly</span>
          </h3>
        </div>

       
        <div class="col-12 col-lg-5 mt-0" style="padding-top: 20px;">
            <div class="btnRating">
              <div class="row">
              <i class="fa-solid fa-star starRating me-2"><span class="ratingOutOf ms-3"><?= $show_reviews ?></span></i>
              </div>

              
              <div class="row" style="padding-top: 10px;">
              <span class="revs">(<?= $total_reviews?> reviews)</span>
              </div>
              
            </div>
            
          </div>

      </div>

      

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

    <div class="col-md-6 text-md-start order-2 order-xl-0">

        <div class="h5 d-none d-md-block">
          <span class="name h3">House Rules</span>
        </div>

        <div class="name h3 d-block d-md-none mt-5 mt-md-0">House Rules</div>

      <hr />
    </div>

    <div class="col-12 col-xl-6">
      <div class="row">
        <div class="text-center" >
          <div class="row mt-3">
            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $aircon===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-air-conditioner"></i><span> Aircon</span></p>
                </div>
                <div class="row">
                    <p <?php echo $bathroom===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-toilet"></i><span> Bathroom</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $cabinet===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-cabinet-filing"></i><span> Cabinet</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $cctv===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-camera-cctv"></i><span> CCTV</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $drinking_water===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-jug"></i><span> Drinking Water</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $elevator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-elevator"></i><span> Elevator</span></p>
                </div> 
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $emergency_exit===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-person-to-door"></i><span> Emergency Exit</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $food_hall===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-utensils"></i><span> Food Hall</span></p>
                </div>
                <div class="row">
                    <p <?php echo $laundry===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-washing-machine"></i><span> Laundry</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $lounge===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-couch"></i><span> Lounge</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $microwave===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-microwave"></i><span> Microwave</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $parking===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-square-parking"></i><span> Parking</span></p>
                </div> 
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $refrigerator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-refrigerator"></i><span> Refrigerator</span></p>
                </div>          
                <div class="row">
                    <p <?php echo $security===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-shield-check"></i><span> Security</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $sink===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-sink"></i><span> Sink</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $study_area===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-books"></i><span> Study Area</span></p>
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
      <div class="col-12 col-xl-6 order-3 order-xl-0">

        <div class="row">
        
        <div class="row mt-0 mt-md-3">
            <div class="col-12 col-md-4 description2">
            
            <div class="row">
                <div class="col">
                <?php if($pets==0){ ?>
                    <p style="text-decoration: line-through">
                    <i style="text-decoration: line-through" class="fa-solid fa-paw"></i>
                    <?php } else{ ?> 
                    <p> 
                    <i class="fa-solid fa-paw"></i>
                    <?php } ?>
                    
                    <span> Pets</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <?php if($visitors==0){ ?>
                        <p style="text-decoration: line-through">
                        <?php } else{ ?> 
                        <p> 
                        <?php } ?>
                    <i class="fa-solid fa-user-group-simple"></i>
                    <span> Guests</span>
                </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                <?php if($smoking==0){ ?>
                        <p style="text-decoration: line-through">
                        <?php } else{ ?> 
                        <p> 
                        <?php } ?>
                    <i class="fa-regular fa-smoking"></i>
                    <span> Smoking/Vaping</span>
                </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <?php if($alcohol==0){ ?>
                        <p style="text-decoration: line-through">
                        <?php } else{ ?> 
                        <p> 
                        <?php } ?>
                    <i class="fa-regular fa-wine-bottle"></i>
                    <span> Alcoholic drinks</span>
                </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <?php if($cooking==0){ ?>
                        <p style="text-decoration: line-through">
                        <?php } else{ ?> 
                        <p> 
                        <?php } ?>
                    <i class="fa-regular fa-kitchen-set"></i>
                    <span> Cooking</span>
                </p>
                </div>
            </div>
            

            </div>

            <div class="col-12 col-md-4 description2">
            
            <div class="row">
                <div class="col">
                <?php if($mixgender==0){ ?>
                    <p style="text-decoration: line-through">
                    <?php } else{ ?> 
                    <p> 
                    <?php } ?>
                    <i class="fa-solid fa-venus-mars"></i>
                    <span> Mixed Gender</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <?php if($short==0){ ?>
                        <p style="text-decoration: line-through">
                        <?php } else{ ?> 
                        <p> 
                        <?php } ?>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span> Short term stay</span>
                </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <?php if($electric_bill==NULL){ ?>
                        <p> 
                            <i class="fa-regular fa-plug"></i>
                            <span> Electric bill is included</span>
                        </p>
                        <?php } else{ ?> 
                        <p> 
                            <i class="fa-regular fa-plug"></i>
                            <span> Electric bill is seperated</span>
                        </p>
                    <?php } ?>
                    
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php if($water_bill==NULL){ ?>
                        <p> 
                            <i class="fa-regular fa-droplet"></i>
                            <span> Water bill is included</span>
                        </p>
                        <?php } else{ ?> 
                        <p> 
                            <i class="fa-regular fa-droplet"></i>
                            <span> Water bill is seperated</span>
                        </p> 
                    <?php } ?>
                </div>
            </div>
            

            </div>

            <div class="col-md-4 description2 ps-md-5 mt-4 mt-lg-0">
                    <?php if($curfew==0){ ?>
                    <div class="row">
                        <p style="text-decoration: line-through">
                        <i class="fa-solid fa-user-clock"></i>
                        <span> Curfew Hours</span>
                        </p>
                    </div>
                    <?php } elseif($curfew==1){ ?> 
                    <div class="row">
                        <p>
                        <i class="fa-regular fa-user-clock"></i>
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
                    <?php if($visitors==0){ ?>
                    <div class="row">
                        <p style="text-decoration: line-through">
                        <i class="fa-sharp fa-regular fa-users"></i>
                        <span> Guests Hours</span>
                        </p>
                    </div>

                    <?php } else{ ?> 
                        <p>
                            <i class="fa-sharp fa-regular fa-users"></i>
                            <span> Guests Hours</span>
                        </p>
                    </div>

                    <div class="row" style="padding-left: 22px">
                    <p>
                        <span> <?php echo $from_visit . ' to ' . $to_visit ?></span>
                    </p>
                    </div>
                    <?php } ?>
                

                    <div class="row">
                    <?php if($minweeks==0){ ?>
                    <div class="row">
                        <p style="text-decoration: line-through">
                        <i class="fa-sharp fa-regular fa-calendar-clock"></i>
                        <span> Minimum stay</span>
                        </p>
                    </div>

                    <?php } else{ ?> 
                        <p>
                            <i class="fa-sharp fa-regular fa-calendar-clock"></i>
                            <span> Minimum stay</span>
                        </p>
                    </div>

                    <div class="row" style="padding-left: 22px">
                    <p>
                        <span><?php echo $minweeks ?> weeks</span>
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
var map_center = [15.145763463436099, 120.59339729138502];
        var mapOptions = {
        center: map_center,
        zoom: 30
        }
        var map = L.map('map', mapOptions);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([15.145763463436099, 120.59339729138502]).addTo(map);
        marker.bindPopup("<b>Batac Dormitory</b><br>Lourdes Sur East<br><a href='view.php?property_id=<?php echo $property_id ?>'>View</a>").openPopup();

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

              </div>
              <!-- Section Header Ends -->
            
                <!-- Owl Carousel Slider Starts -->
                <div class="owl-carousel owl-theme testimonials-container">

                    <?php 
                    
                    if (empty($display_reviews)) {
                      // Display alternative card if there are no reviews
                      ?>
                      <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile-desc">
                            <span class="ratings">
                              <i class="fa-solid fa-star"></i>
                            </span>
                            <span>No Reviews Yet</span>
                          </div>
                          <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <h2>Contribute to help make people right choices.</h2>
                          </div>
                          <p>Share your experience to help others decide for their home. It's not just a review, it's an experience.</p>
                        </main>
                      </div>
                      <?php
                    } else {
                      // Display reviews if available

                    foreach($reviews as $review) { 
                        $review_name = $review['first_name'] . ' ' . $review['last_name'];
                        $get_date = $review['review_date'];
                        $date = new DateTime($get_date);
                        $review_date = $date->format('F j, Y \a\t g:i A');
                        $rating = $review['rating'];
                        $description = $review['description'];
                        $review_image = $review['image_name'];
                    ?>
                    <!-- Item1 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="../resources/images/users/<?=$review_image?>" alt=" ">
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
                    <?php
            }
          }
          ?>
            
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

                
            if (empty($property_faqs)) {
              ?>
                <li data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-help-circle icon-help"></i> 
                  <a data-bs-toggle="collapse" class="collapse" style="text-decoration: none; color: #ff5a3d;">No FAQs have been added yet, but we're on it!
                  </a>
                  <div id="faq-list-1" class="collapse show">
                    <p>
                      We want to make sure we cover all the bases and provide you with the information you're looking for. Check back soon for updates, and in the meantime, feel free to reach out if you have any specific questions.
                    </p>
                  </div>
                </li>
              <?php 
                } else {
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
          <?php 
              $faqlist++; 
              } 
            }
          ?>

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
        <h2 class="featureHeading p-3 text-center">My Properties</h2>
      </div>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
                <?php 
                //Get all properties
                    $featured_properties = new Property();
                    $featured_properties->setConnection($connection);
                    $featured_properties = $featured_properties->getProperty($user_id);
                    foreach($featured_properties as $featured_property){ 
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
                    

                    ?>
              <div class="col-12 col-md-6 col-xl-4 mt-4">
                <div class="box">
                  <div class="thumb">
                    <input type="hidden" value="<?= $featured_property_id ?>" name="property_id" id="property_id">
                    <p class="type"><span><?= $featured_property_type ?></span></p>

                    <img class="w-100" src="../resources/images/properties/<?=$featured_image?>" alt=""/>
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

                                      <a class="btnView" role="button" href="view.php?property_id=<?php echo $featured_property_id ?>">View property</a>
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
  


<!-- Edit Carousel Image Modal -->

<div class="modal fade" id="editCarouselImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCarouselImgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered editCarouselImg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3 imgCarouselTitle" id="editCarouselLabel">Update image and title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="edit-image" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="imageId" name="image_id">
      <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
      <div class="modal-body editCarouselImg">
          <div class="container">
            <div class="row">
              <div class="col-auto">
                <label class="form-label" for="inputPicsTitle">Update title</label>
              </div>
            </div>
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Title</label>
              </div>
              <div class="col-auto">
                <input class="form-control form-control-md" type="text" id="inputPicsTitle" name="image_title" value="" placeholder="Update title" aria-label=".form-control-md example"aria-describedby="titleHelpInline">
              </div>
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Set as thumbnail </label>
                <input type="checkbox" id="checkThumbnail" name="set_thumbnail" value="1">
              </div>
            </div>
            <label class="form-label mt-5" for="customFile">Update image</label>
            <input type="file" class="form-control" id="customFile" name="new_image" value="" accept="image/*" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update_image">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addCarouselImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCarouselImgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered addCarouselImg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3 imgCarouselTitle" id="editCarouselLabel">Add image and title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="edit-image" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
      <div class="modal-body addCarouselImg">
          <div class="container">
            <div class="row">
              <div class="col-auto">
                <label class="form-label" for="inputPicsTitle">Add title</label>
              </div>
            </div>
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Title</label>
              </div>
              <div class="col-auto">
                <input class="form-control form-control-md" type="text" id="inputPicsTitle" name="image_title" value="" placeholder="Update title" aria-label=".form-control-md example"aria-describedby="titleHelpInline">
              </div>
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Set as thumbnail </label>
                <input type="checkbox" id="checkThumbnail" name="set_thumbnail" value="1">
              </div>
            </div>
            <label class="form-label mt-5" for="addCustomFile">Add image</label>
            <input type="file" class="form-control" id="addCustomFile" name="new_image" value="" accept="image/*" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add_image">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Script for Edit Image Modal -->
<script>
$(document).ready(function() {
    $('.btnEditG').on('click', function() {
        var imageId = $(this).data('image-id');
        var title = $(this).closest('.item').find('.card-title h4').text();
        var imagePath = $(this).closest('.item').find('img').attr('src');

        $('#editCarouselImg').find('#imageId').val(imageId);
        $('#editCarouselImg').find('#inputPicsTitle').val(title);
        $('#editCarouselImg').find('#customFile').val(imagePath);

        // Optionally, if you need to pass the image ID for further processing:
        $('#editCarouselImg').attr('data-id', imageId);
    });
});
</script>

<!-- Delete Carousel Image -->

<div class="modal fade" id="deleteCarouselImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCarouselImgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered deleteCarouselImg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3 imgCarouselTitle" id="editCarouselLabel">Delete Hall container</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body deleteCarouselImg">
          <div class="container">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <div class="deleteDescrip">Are you sure you want to delete Hall container?</div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <form action="edit-image" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="imageId" name="image_id">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <button id="declineButton" name="delete_image" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
        <form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Script for Delete Image -->
<script>
$(document).ready(function() {
    $('.btnDeleteG').on('click', function() {
        var imageId = $(this).data('image-id');
        $('#deleteCarouselImg').find('#imageId').val(imageId);
    });
});
</script>

<div class="modal fade" id="addAnImg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAnImgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered addAnImg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3 imgCarouselTitle" id="addAnLabel">Add image and title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="edit-image" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <div class="modal-body addAnImg">
          <div class="container">
            <div class="row">
              <div class="col-auto">
                <label class="form-label" for="inputPicsTitle">Add title</label>
              </div>
            </div>
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Title</label>
              </div>
              <div class="col-auto">
                <input class="form-control form-control-md" type="text" id="inputPicsTitle" name="image_title" value="" placeholder="Update title" aria-label=".form-control-md example"aria-describedby="titleHelpInline">
              </div>
              <div class="col-auto">
                <label for="inputPicsTitle" class="col-form-label inputImgTitle">Set as thumbnail </label>
                <input type="checkbox" id="checkThumbnail" name="set_thumbnail" value="1">
              </div>
            </div>
            <label class="form-label mt-5" for="customFile">Add image</label>
            <input type="file" class="form-control" id="customFile" name="new_image" value="" accept="image/*" />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="add_image">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Add an image Modal JS -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    var addImageButton = document.getElementById('imageUpload');
    var editCarouselImgModal = new bootstrap.Modal(document.getElementById('addAnImg'));

    addImageButton.addEventListener('click', function () {
      editCarouselImgModal.show();
    });
  });
</script>

</body>

  <!-- JS of Carousel -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

      $(document).ready(function(){
        var testimonialsContainer = $('.testimonials-container');
        testimonialsContainer.owlCarousel({
            loop: testimonialsContainer.find('.item').length > 1, // Set loop to false if there is only one item
            center: testimonialsContainer.find('.item').length === 1, // Center the item if there is only one item
            autoplay: false,
            autoplayTimeout: 6000,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: true
                },
                768: {
                    items: 2
                },
            }
        });
    });
  </script>


    <!-- Gallery Modal JS -->
<script src="js/upload-image.js"></script>

</html>



