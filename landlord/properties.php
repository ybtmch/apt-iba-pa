<?php
use Models\Property;
use Models\Image;
use Models\Review;
use Models\Unit;
include ("../init.php");
include ("session.php");

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperty($user_id); //change to property per landlord

//Get all properties
$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperty($user_id);
$count_properties = count($properties);
$count_units = 0;
foreach($properties as $property){
    $total_units = $property['total_units'];
    $count_units = $count_units + $total_units;
}



if (isset($_SESSION['property_id'])) {
unset($_SESSION['property_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa | My Properties</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <link href="css/accommodations.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

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
    <!-- Navbar -->

    <?php include('navbar.php'); ?>
  
      <!-- Navbar ends -->
      <?php //include('loader_process.php'); ?>

    <!-- Featured section starts -->
    <div class="container-fluid accomJumbuildings">
      <h1 class="text-center fw-bold display-1 mt-5">ACCOMMODATIONS</h1>
      <section class="accommodations">

      <div class="box-container" >
              <?php $propertyCounter = 0; ?>
              <?php 
              foreach ($properties as $property) { 
                  $property_id = $property['property_id'];
                  $property_name = $property['property_name'];
                  $address = $property['barangay'] . ', ' . $property['city'];
                  $lowest_rate = $property['lowest_rate'];
                  $property_type = $property['property_type'];
                  // $total_units = $property['total_units'];

                  $units = new Unit();
                  $units->setConnection($connection);
                  $units = $units->getUnits($property_id);

                  foreach($units as $unit){
                      $occupied_units = $unit['occupied_units'];
                      $count_units = $count_units - $occupied_units;
                  }

                  $property_id = $property['property_id'];
                  $images = new Image();
                  $images->setConnection($connection);
                  $images = $images->getDisplayImage($property_id);
                  
                  if($images){
                      $image = $images['image_path'];
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
              ?>
                  <?php if ($propertyCounter % 2 == 0) { ?>
                  <div class="row gx-5 mb-3">
                      <?php } ?>
                      <div class="col-12 col-lg-6">
                          <div class="box" style="background-color: white">
                              <div class="row">
                                  <div class="col-8">
                                      <h3 class="name"><?= $property_name ?></h3>
                                      <input type="hidden" value="<?=$property_id?>" name="property_id">
                                      <div class="row">
                                          <div class="h4 mt-3 col-sm-8">
                                              <div>
                                              <i class="fas fa-map-marker-alt"></i> <?= $address ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <a href="view.php?property_id=<?= $property_id ?>" class="btnViewIndex">View</a>
                                  </div>
                                  

                              </div>

                          <div class="thumb">
                              <p class="type"><span><?= $property_type ?></span></p>

                              <p class="unitsAvailable"><span> <?= $total_units ?> Total Units</span></p>

                              <img src="../resources/images/properties/<?= $image ?>" alt="" />
                          </div>
                          <div class="row">
                              
                              <div class="col-sm-6 rentName">
                              Rent starts at
                                <div class="price">&#8369;<?= $lowest_rate ?></div>
                              </div>
                              <div class="col-12 col-lg-6">
                                  <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $show_reviews ?></p>
                              </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-12 col-lg-6">
                            </div>
                            
                            <div class="col-6"></div>

                          </div>
                            <?php 
                            $units = new Unit();
                            $units->setConnection($connection);
                            $units = $units->getUnits($property_id);
                            foreach($units as $unit){
                                $unit_id = $unit['unit_id'];
                                $unit_type = $unit['unit_type'];
                                $total_units = $unit['total_units'];
                                $occupied_units = $unit['occupied_units'];
                                $available_units = intval($total_units) - intval($occupied_units);
                            ?>
                          <div class="row">
                                <!-- incremental button -->
                            <div class="col-12 col-lg-7 col-xl-6 mt-4"></div>
                            <div class="col-12 col-lg-7 col-xl-6 mt-4 order-1"> 
                                  <p class="unitsRemaining" style="font-weight: 600">Units Available</p>
                            </div>

                          </div>

                          <div class="row">


                              <!-- incremental button -->
                              <div class="col-12 col-lg-7 col-xl-6 mt-4 order-5 order-lg-0 justify-content-center justify-content-lg-start"> 
                                    <p class="unitsRemaining text-center text-lg-start" style="font-weight: 600; font-size: 1.6rem"><?php echo $unit_type ?></p>
                              </div>

                              <div class="col-12 col-xl-6 mt-0 mt-lg-0 order-4 order-lg-0"> 
                                <div class="d-flex justify-content-center w-100" style="border: 1px solid #ff5a3d; background-color: #ff5a3d; border-radius: 5px;">
                                    <div class="input-group w-100 justify-content-center align-items-center">
                                      <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-3" data-field="quantity">
                                      <input type="hidden" value="<?php echo $property_id ?>" name="property_id" id="property-id">
                                      <input type="hidden" value="<?php echo $unit_id ?>" name="unit_id" id="unit-id">
                                      <input style="font-size: 2rem" type="number" step="1" max="10" value="<?= $available_units ?>" name="quantity" class="quantity-field form-control-lg border-0 text-center w-50">

                                      <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm mx-3" data-field="quantity">
                                    </div>
                                </div>
                                <!-- <a href="view.php?property_id=<?= $property_id ?>" class="btnViewIndex">View property</a> -->
                              </div>
                          </div>
                            <?php } ?>       
                      </div>
                      <?php if ($propertyCounter % 2 == 1 || $propertyCounter == count($properties) - 1) { ?>
                      
                  </div>
                      <?php } ?>
                  <?php $propertyCounter++; ?>
              <?php } ?>
              </div>


                  
                  
          </div>
        <div class="col extraContainer"></div>
        </div>
    </section>
    </div>


 

    <?php include('footer.php'); ?>
  



    



  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>
  

  <!-- JS of Carousel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
        nav:true,
        navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
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
  
<script src="js/incremental.js"></script>
              
            <!--   *****   JQuery Link   *****   -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            
            <!--   *****   Owl Carousel js Link  *****  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
           

            </body>
            </html>
