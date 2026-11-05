<?php
use Models\Property;
use Models\Image;
use Models\User;
use Models\Review;
use Models\Bookmark;
include ("init.php");
include ("session.php");

if(!isset($user_id)){
    header('location: index.php');
    exit();
}

if(isset($_SESSION['current_page'])){
    unset($_SESSION['current_page']);
}

//Get all properties
$property = new Bookmark();
$property->setConnection($connection);
$properties = $property->getSavedProperties($user_id);
//var_dump($properties);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>

    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />

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


<!-- Wishlists -->
<?php if(count($properties) != 0){?>
    <section class="listings">
        
        <h1 class="featureHeading p-3">Favorites</h1>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
                <?php foreach($properties as $property){ 
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
                    
                    <p class="type"><span><?= $property_type ?></span></p>

                    <?php if(isset($_SESSION['user_id'])) {?>
                    <form action="bookmark" method="POST" class="save">
                    <input type="hidden" value="<?= $property_id ?>" name="property_id" id="property_id">
                    <?php if (isset($bookmark['status']) && $bookmark['status']===1) {?>
                      <button
                        type="submit"
                        class="fa-solid fa-bookmark fa-3x"
                        value="1"
                        name="toggle_bookmark"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmark(<?= $property_id ?>)"
                        ></button>
                    <?php } elseif(isset($bookmark['status']) && $bookmark['status']===2) { ?>
                        <button
                        type="submit"
                        class="fa-regular fa-bookmark fa-3x"
                        value="2"
                        name="toggle_bookmark"
                        id="bookmarkBtn-<?= $property_id ?>"
                        onclick="bookmark(<?= $property_id ?>)"
                        ></button>
                    <?php } else {?>
                        <button
                        type="submit"
                        class="fa-regular fa-bookmark fa-3x"
                        value="0"
                        name="toggle_bookmark"
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
                    <div class="col-5 justify-content-start col-lg-4 rentName">
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
<?php
} else {
?>
    <section class="wishlists">
        
        <h1 class="wishlistHeading p-3">Favorites</h1>

        <!-- <div class="container-md"> -->
          <!-- <div class="container"> -->
            <div class="row">
              <div class="col-12">
                <div class="row ms-lg-2">
                  <h2 class="empty">Empty List</h2>
                  <h4 class="emptyDetails">As you search, click the heart icon to save your favorite property here.</h4>
                </div>
              </div>

              <div class="col emptyContainer"></div>
            </div>
          <!-- </div> -->


        <!-- </div> -->
      </section>
<?php } ?>
    <!-- Featured ends -->

    <!-- offers section ends -->

    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->




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
  