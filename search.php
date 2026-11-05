<!-- SHOWS RESULTS ON ACCOMMODATIONS PAGE -->

<?php
use Models\Property;
use Models\Image;
use Models\Review;
use Models\Bookmark;
include("init.php");
include("session.php");

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

if (isset($_POST['query']) || isset($_POST['price']) || isset($_POST['property_type']) || isset($_POST['barangay']) || isset($_POST['amenities'])){
    $query = $_POST['query'];

    // Define a callback function to filter the array
    $filteredProperties = array_filter($properties, function ($item) use ($query) {
        return (
            stripos($item['property_type'], $query) !== false ||
            stripos($item['property_name'], $query) !== false ||
            stripos($item['barangay'], $query) !== false ||
            stripos($item['city'], $query) !== false ||
            stripos($item['province'], $query) !== false ||
            stripos($item['region'], $query) !== false
        );
    });

    // Convert the filtered properties back to a numerically indexed array
    $filtered_search = array_values($filteredProperties);

    $price = $_POST['price'] ?? NULL;

    if ($price === "high") {
        usort($filtered_search, function ($a, $b) {
            return $b['lowest_rate'] - $a['lowest_rate'];
        });
    } elseif ($price === "low") {
        usort($filtered_search, function ($a, $b) {
            return $a['lowest_rate'] - $b['lowest_rate'];
        });
    }

    $property_type = $_POST['property_type'] ?? array();
    $barangay = $_POST['barangay'] ?? array();
    $amenities = $_POST['amenities'] ?? array();

    $filteredProperties2 = array_filter($filtered_search, function ($item) use ($property_type, $barangay) {
        return (empty($property_type) || in_array($item['property_type'], $property_type)) &&
            (empty($barangay) || in_array($item['barangay'], $barangay));
    });

    // Convert the filtered properties back to a numerically indexed array
    $filtered_search2 = array_values($filteredProperties2);

    // Initialize an empty array to store matching properties
    $matchingProperties = [];

    // Iterate through the $properties array
    foreach ($filtered_search2 as $property) {
        // Initialize a flag to check if all amenities are matched with value 1
        $match = true;
        
        // Iterate through the $amenities array
        foreach ($amenities as $amenity) {
            // Check if the amenity exists in the $property array and has a value of 1
            if (!isset($property[$amenity]) || $property[$amenity] !== 1) {
                $match = false;
                break;
            }
        }
        
        // If all amenities matched with value 1, add the property to the result array
        if ($match) {
            $matchingProperties[] = $property;
        }
    }

    $properties = $matchingProperties;

// $matchingProperties now contains only the properties that match the amenities

}
?>


    <link href="css/accommodations.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

    <?php $propertyCounter = 0; ?>
    <?php 
    foreach ($properties as $property) { 
        $property_name = $property['property_name'];
        $address = $property['barangay'] . ', ' . $property['city'];
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
    ?>
        <?php if ($propertyCounter % 2 == 0) { ?>
            <div class="row gx-5 mb-3">
            <?php } ?>
              <div class="col-md-6">
                <div class="box">
                    <div class="row">
                        <div class="col-10">
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
                        <?php 
                            if(isset($_SESSION['user_id'])){
                            $bookmark = new Bookmark();
                            $bookmark->setConnection($connection);
                            $bookmark = $bookmark->checkBookmark($property_id, $user_id);
                            }
                        ?>
                            <div class="col-2 justify-content-end d-flex">
                            <?php if(isset($_SESSION['user_id'])) {?>
                                <form class="save">
                                <?php if (isset($bookmark['status']) && $bookmark['status']===1) {?>
                                <button
                                    type="button"
                                    class="fa-solid fa-bookmark fa-4x"
                                    value="1"
                                    id="bookmarkBtn-<?= $property_id ?>"
                                    onclick="bookmark(<?= $property_id ?>)"
                                    ></button>
                                <?php } elseif(isset($bookmark['status']) && $bookmark['status']===2) { ?>
                                    <button
                                    type="button"
                                    class="fa-regular fa-bookmark fa-4x"
                                    value="2"
                                    id="bookmarkBtn-<?= $property_id ?>"
                                    onclick="bookmark(<?= $property_id ?>)"
                                    ></button>
                                <?php } else {?>
                                    <button
                                    type="button"
                                    class="fa-regular fa-bookmark fa-4x"
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
                                    class="fa-regular fa-bookmark fa-4x"
                                ></button> <!-- class="fa-regular fa-bookmark fa-4x" -->
                                </form>
                                <?php } ?>
                            </div>

                    </div>

                  <div class="thumb">
                    <p class="type"><span><?= $property_type ?></span></p>
                    <img src="resources/images/properties/<?= $image ?>" alt="" />
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-6 rentName">
                      Rent starts at
                      <div class="price">&#8369;<?= $lowest_rate ?></div>
                    </div>
                    <div class="col-sm-6">
                        <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $show_reviews ?></p>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm"> 
                      <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>
              <?php if ($propertyCounter % 2 == 1 || $propertyCounter == count($properties) - 1) { ?>
              
            </div>
            <?php } ?>
        <?php $propertyCounter++; ?>
    <?php } ?>
