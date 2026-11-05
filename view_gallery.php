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

    //landlord information
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];
    
    //get all images
    $images = new Image();
    $images->setConnection($connection);
    $images = $images->getImages($property_id);
    
    $display = new Image();
    $display->setConnection($connection);
    $display_image = $display->getDisplayImage($property_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Apt Iba Pa | <?php echo $property_name ?> </title>
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
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <link href="css/view_gallery_overview.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

    <!-- Vendor Files -->
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

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

    <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
  </head>

  <body>
<?php //include('navbar.php'); ?>
<br>
      <!-- Property Gallery Edit -->

<div class="container mb-5">
      <div class="container-fluid">
        <div class="row pt-3 pb-3 d-flex fixed-top justify-content-between" style="background-color: transparent;">
          <div class="col-2 col-md-5 backToView">
            <a href="view.php?property_id=<?php echo $property_id ?>">
              <i class="fa-solid fa-chevron-left fa-2x ms-3 ms-md-5 "></i>
            </a>
          </div>
        </div>
      </div>

      <div class="w-100 mb-5"></div>
        <div class="row g-3 mt-5 align-items-center position-relative  galleryOverview">
          <div class="col-auto">
            <label for="galleryTitle" class="col-form-label galleryTitle">Property Overview</label> 
          </div>
        </div>

      <!-- Edit Gallery section --desktop -->
      <div class="container d-none d-md-block">
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-2">

        <?php
        foreach($images as $image) { 
            $image_path = $image['image_path'];
            $title = $image['title'];
        ?>
        <div class="col py-0 px-1 mt-1 d-flex justify-content-center position-relative">
          <img class="img-fluid" width="800" height="200" src="resources/images/properties/<?= $image_path ?>" alt="">
        </div>
        <?php } ?>
      </div>
      </div>

      <!-- Edit Gallery section --mobile-->
      <div class="container d-md-none">
        <div class="row ">
          <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-1">
          <?php
        foreach($images as $image) { 
            $image_path = $image['image_path'];
            $title = $image['title'];
        ?>
            <div class="col py-0 px-1 mt-1 d-flex justify-content-center position-relative">
              <img class="img-fluid" width="2000" height="2000" src="resources/images/properties/<?= $image_path ?>" alt="">
            </div>
            <?php } ?>
          </div>
        <!-- </div> -->
      </div>

  <script src="js/upload-image.js"></script>

  <?php include ('footer.php'); ?>
</body>
</html>