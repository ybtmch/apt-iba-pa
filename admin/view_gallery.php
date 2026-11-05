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

    
    $property_id = $_GET['property_id'];
    
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
          <div class="col-4 col-md-2 col-lg-1 d-flex align-items-center justify-content-center">
            <!-- Hidden file input styled to look like a button -->
            <input type="file" id="imageUpload" name="image" style="display: none;" accept="image/*">

            <!-- Button styled to look like an "Add Image" button -->
            <label for="imageUpload" class="btn btn-outline-primary saveEditButton">Add an image</label>
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
                    $image_id = $image['image_id'];
                    $image_path = $image['image_path'];
                    $title = $image['title'];
                ?>
                <div class="img-container col py-0 px-1 mt-1 d-flex justify-content-center position-relative">
                <img class="img-fluid" width="800" height="600" src="../resources/images/properties/<?= $image_path ?>" alt="">
                    <div class="dropdown position-absolute dropAction">
                        <a class="btn btn-light fa-solid fa-ellipsis fa-lg " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                      
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item btnEditG" href="#" role="button" data-bs-toggle="modal" data-bs-target="#editCarouselImg" data-image-id="<?php echo $image_id ?>">Edit</a></li>
                          <li><a class="dropdown-item btnDeleteG" href="#" role="button" data-bs-toggle="modal" data-bs-target="#deleteCarouselImg" data-image-id="<?php echo $image_id ?>">Delete</a></li>
                        </ul>
                    </div>
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
              <img class="img-fluid" width="2000" height="2000" src="../resources/images/properties/<?= $image_path ?>" alt="">
            </div>
            <?php } ?>
          </div>
        <!-- </div> -->
      </div>

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

  <script src="js/upload-image.js"></script>

  <?php include ('footer.php'); ?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</html>