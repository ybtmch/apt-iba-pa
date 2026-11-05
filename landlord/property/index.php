<?php
use Models\Property;
use Models\Image;
use Models\Review;
include ("../../init.php");
include ("session.php");

$landlord_id = $_SESSION['user_id'];

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperty($landlord_id); //change to property per landlord

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

    <link href="css/my_property.css" rel="stylesheet" />
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
  </head>
  <body>
    <!-- Navbar -->

    <?php include('navbar.php'); ?>
  
      <!-- Navbar ends -->

    <!-- Featured section starts -->

    <div class="container-fluid accomJumbuildings accomBlank">
        <section class="accommodations">
  
          <div class="container-md">
            <div class="row">
              <div class="col-md">
                <h1 class="text-center text-sm-start myApt">My <strong>Properties</strong></h1>
              </div>
            </div>

            <div class="box-container">
              <div class="row gx-5 mb-3">
                <?php 
                    foreach($properties as $property){
                        $full_address = $property['property_number'] . " " . $property['street'] . ", Barangay " . $property['barangay'] . ", " . $property['city'];
                        $property_name = $property['property_name'];
                        $barangay = $property['barangay'];
                        $lowest_rate = $property['lowest_rate'];
                        $property_type = $property['property_type'];

                        if($property['status']===1){
                            $status = 'Active';
                            } elseif($property['status']===2){
                            $status = 'Pending';
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

                            $average_rating = $total_ratings / $total_reviews;

                            if($total_reviews>1){
                                $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
                            } else{
                                $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
                            }
                        } else{
                            $show_reviews = "No reviews yet";
                        }
                ?>
                <!-- Properties -->
                <div class="col-md-6">
                  <div class="box">
                      <div class="row">
                          <div class="col-8 order-5 order-md-0">
                              <h3 class="name"><?= $property_name ?></h3>
                              <div class="row">
                                  <div class="h4 mt-3 col-sm-8">
                                      <div>
                                      <i class="fas fa-map-marker-alt"></i> <?= $full_address?>
                                      </div>
                                  </div>
                              </div>
                          </div>
  
                          <div class="col mt-2 mt-md-3 mb-3 ps-md-0 d-flex justify-content-start justify-content-md-end order-md-0">
                            <p class="statusP text-center"><span><?= $status?></span></p>
                          </div>
  
                      </div>
  
                    <div class="thumb">
                      <p class="type"><span><?= $property_type ?></span></p>
  
                      <img class="w-100" src="../../resources/images/properties/<?= $image ?>" alt="" />
                    </div>
                    <div class="row">
                      
                      <div class="col-sm-6 rentName">
                        Rent starts at
                        <div class="price">&#8369;<?= $lowest_rate ?></div>
                      </div>
                      <div class="col-sm-6">
                          <p class="btnRating"><i class="fa-solid fa-star-half-stroke starRating"></i> <?php echo $show_reviews?> </p>
                        </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm d-flex align-items-center">
                        <a href="view.php?property_id=<?= $property_id ?>" class="linkViewProperty"><button type="button" class="btn btnViewMyP">Edit</button></a>
                      </div>
                      <div class="col-sm d-flex align-items-center">
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                      </div>
                    </div>
  
                  </div>
                </div>
                <!-- End of properties -->
                <?php } ?>
              </div>




              
  
            
            </div>
          </div>
        </section>
      </div>
  
      <!-- Featured ends -->

 

    <?php include('footer.php'); ?>
  



    


  </body>

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

              
            <!--   *****   JQuery Link   *****   -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            
            <!--   *****   Owl Carousel js Link  *****  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</html>
