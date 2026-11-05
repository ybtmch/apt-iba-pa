<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\Request;
use Models\User;
use Models\Auth;
include "../../init.php";
include "session.php";

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);

    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $email = $user['email'];
    $contact_number = $user['contact_number'];

} else {
    $user_id = NULL;
}

if(isset($_GET['property_id'])){
  $_SESSION['property_view_id'] = $_GET['property_id'];
} else{
  $_SESSION['property_view_id'] = $_SESSION['property_view_id'];
}

$property_id = $_SESSION['property_view_id'];
$_SESSION['current_page'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$property = new Property();
$property->setConnection($connection);
$details = $property->getPropertyDetails($property_id);

//print_r($details);

//property information
$property_type = $details['property_type'];
$property_name = $details['property_name'];
$landlord_id = $details['landlord_id'];
$description = $details['description'];
$total_floors = $details['total_floors'];
$total_rooms = $details['total_rooms'];
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
$roof_deck = $details['roof_deck'];
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
$room = new Room();
$room->setConnection($connection);
$rooms = $room->getRooms($property_id);

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



//var_dump($images);
//$property_id = 26;
  //$user_id = 33; //change with session

$disabled_dates = [];

// $date_time = new Schedule('','','');
// $date_time->setConnection($connection);
// $date_time = $date_time->getDateTime($property_id);

// $reviews = new Review();
// $reviews->setConnection($connection);
// $reviews = $reviews->getRatings($property_id);

// if(count($reviews)>0){
//   $total_ratings = 0;
//   $total_reviews = count($reviews);
  
//   foreach ($reviews as $review) {
//       $total_ratings += $review["rating"];
//   }

//   $average_rating = $total_ratings / $total_reviews;

//   if($total_reviews>1){
//       $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
//   } else{
//       $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
//   }
// } else{
//   $show_reviews = "No reviews yet";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Apt Iba Pa | Apply Property</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Form -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

  <!-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> -->

  <!-- Others -->
  <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
  <!-- <link href="css/property_enlist.css" rel="stylesheet" /> -->
  <link href="css/all.css" rel="stylesheet" />
  <link href="css/property_enlist.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- LeafletJS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>
<?php include('navbar.php')?>
<style>
    <?php //include('css/property_enlist.css')?>
</style>

  <!-- Enlist starts -->

  <div class="container ps-md-0 enlistDetailscon">
    <section class="enlistDetails">
      <!-- <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
        <img class="img-fluid" src="images/hero-img.png">
      </div> -->
      <!-- <divd class="col-md-8 col-lg-6 " > -->
      <div class="w-100 d-none d-md-block">
        <div class="row m-2"></div>
      </div>
      <div class="multisteps-form">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 ml-auto mr-auto">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" id="basic-modal" type="button" title="BasicDetails">Basic
                Details</button>
              <button class="multisteps-form__progress-btn" id="location-modal" type="button" title="PropertyLocation">Property
                Location</button>
            <button class="multisteps-form__progress-btn" id="amenities-modal" type="button" title="PropertyAmenities">Property
                Amenities</button>
              <button class="multisteps-form__progress-btn" id="room-modal" type="button" title="RoomDetails">Room
                Details</button>
              <button class="multisteps-form__progress-btn" id="description-modal" type="button" title="PropertyDes">Property Description </button>
              <button class="multisteps-form__progress-btn" id="rules-modal" type="button" title="PropertyDes">House Rules </button>
            </div>
          </div>
        </div>
        <div class="container multisteps-form__form mt-sm-0 mt-lg-5">

            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div  class="multisteps-form__panel shadow p-4  bg-white js-active" data-animation="fadeIn">

                  <div class="multisteps-form__content">


                    <!-- Enlist Form -->
                    <form action="add.php" method="POST" id="property-form" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? '' : NULL ?>">

                    <div class="row mt-5  ">
                      <h2>Property Details</h2>
                    </div>

                    <div class="row ">
                      <div class="col-12 pt-4 pb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control fs-2  "  id="floatingPropertyName" name="property_name" placeholder="propertyname"  value=<?= htmlspecialchars($property_name) ?>>
                          <label for="floatingPropertyName" class="form-label  ">Property Name</label>
                        </div>
                      </div>

                    </div>

                    <div class="row justify-content-center mt-2 reserveRoomType">
                      <div class="col-md-12 ">
                        <div class="row mt-3">
                          <h4>
                            Property Type*
                          </h4>
                        </div>

                          <div class="row mt-2">


                            <div class="col-12 mb-3">
                              <label class="radio w-100 justify-content-center d-flex ">
                                <input type="radio" name="property_type" value="Dormitory" <?php echo ($property_type === 'Dormitory') ? 'checked' : ''; ?>/>
                                <div class="row justify-content-between p-3 radioRoomType align-items-center " 
                                  id="pickRoomType"  >
                                  <div class="col-8 ">
                                    <span class="roomTypeName fs-3 ">Dormitory</span>
                                  </div>

                                  <div class="col-3">
                                    <i class="fa-light fa-house-building fa-4x float-end"></i>
                                  </div>
                                </div>
                              </label>
                            </div>



                            <div class="col-12 mb-3 ">
                              <label class="radio w-100 justify-content-center d-flex">
                                <input type="radio" name="property_type" value="Apartment" <?php echo ($property_type === 'Apartment') ? 'checked' : ''; ?>/>
                                <div class="row justify-content-between p-3 radioRoomType align-items-center"
                                  id="pickRoomType">
                                  <div class="col-8">
                                    <span class="roomTypeName fs-3">Apartment</span>
                                  </div>

                                  <div class="col-3">
                                    <i class="fa-light fa-apartment fa-4x float-end"></i>
                                  </div>
                                </div>
                              </label>
                            </div>

                            <div class="col-12 mb-3 ">
                              <label class="radio w-100 justify-content-center d-flex">
                                <input type="radio" name="property_type" value="Apartelle" <?php echo ($property_type === 'Apartelle') ? 'checked' : ''; ?>/>
                                <div class="row justify-content-between p-3 radioRoomType align-items-center"
                                  id="pickRoomType">
                                  <div class="col-8">
                                    <span class="roomTypeName fs-3">Apartelle</span>
                                  </div>

                                  <div class="col-3">
                                    <i class="fa-light fa-house fa-4x float-end"></i>
                                  </div>
                                </div>
                              </label>
                            </div>


                          </div>

                      </div>

                    </div>

                    <div class="row mt-4 mb-3 ">
                      <div class="col-12 d-flex justify-content-end">
                        <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="next2">Next</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div class="multisteps-form__panel shadow p-4  bg-white " data-animation="fadeIn">

                  <div class="multisteps-form__content">




                    <div class="row mt-5 mb-4 ">
                      <h2>Property Location</h2>
                    </div>

                    <div class="row g-2">
                      <div class="col-12 col-md-4">
                        <div class="form-floating fs-5 " >
                            <input type="text" class="proploc form-control fs-3"  id="property_number" name="property_number" placeholder="property_number" value="<?= htmlspecialchars($property_number) ?>">
                          <label for="property_number" class="form-label ">Bldg/House No.</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating fs-5">
                            <input type="text" class="proploc form-control fs-3" id="street" name="street" placeholder="housenumber" value="<?= htmlspecialchars($street) ?>">
                          <label for="street" class="form-label">Street</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="region" id="region" >
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" value="<?= htmlspecialchars($region) ?>">
                          <label for="floatingSelectBrgy">Region</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="province" id="province" >
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" value="<?= htmlspecialchars($province) ?>">
                          <label for="floatingSelectBrgy">Province</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="city" id="city" >
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" value="<?= htmlspecialchars($city) ?>">
                          <label for="floatingSelectBrgy">City</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="barangay" id="barangay" >
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" value="<?= htmlspecialchars($barangay) ?>">
                          <label for="floatingSelectBrgy">Barangay</label>
                        </div>
                      </div>

                    </div>

                    <div class="row mt-4 mb-4  ">
                      <h2>Property Owner Details</h2>
                    </div>

                    <?php if(isset($user_id)){ ?>
                        <div class="row g-2">
                      <div class="col-12 col-md-6 ">
                        <div class="form-floating fs-5">
                          <input type="text" class="propown form-control fs-4 " id="first_name" value="<?= $first_name ?>" name="first_name" placeholder="fname" disabled>
                          <label for="first_name" class="form-label  ">First Name</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                          <input type="text" class="propown form-control fs-4" id="last_name" value="<?= $last_name ?>" name="last_name"  placeholder="lname" disabled>
                          <label for="last_name" class="form-label">Last Name</label>
                        </div>
                      </div>

                    </div>

                    <div class="row g-2 mt-3 pb-3 ">

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                          <input type="email" class=" propown form-control fs-4" id="email" value="<?= $email ?>" name="email"  placeholder="email" disabled>
                          <label for="email" class="form-label">Email</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                            <input type="number" class="propown form-control fs-4" id="contact_number" maxlength="14" value="<?= $contact_number ?>" name="contact_number" placeholder="Contact Number" disabled>
                          <label for="contact_number" class="form-label">Phone number</label>
                        </div>
                      </div>

                    </div>

                    <input type="hidden" class=" propown form-control fs-4" id="password" name="password" value="1" placeholder="password">

                    <input type="hidden" class=" propown form-control fs-4" id="confpass" name="confpass" value="1" placeholder="password">
                      
                        <?php } else { ?>
                            <div class="row g-2">
                      <div class="col-12 col-md-6 ">
                        <div class="form-floating fs-5">
                          <input type="text" class="propown form-control fs-4 " id="first_name" name="first_name" placeholder="fname" >
                          <label for="first_name" class="form-label  ">First Name</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                          <input type="text" class="propown form-control fs-4" id="last_name" name="last_name"  placeholder="lname" >
                          <label for="last_name" class="form-label">Last Name</label>
                        </div>
                      </div>

                    </div>

                    <div class="row g-2 mt-3 pb-3 ">

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                          <input type="email" class=" propown form-control fs-4" id="email" name="email"  placeholder="email" >
                          <label for="email" class="form-label">Email</label>
                        </div>
                        <span id="email-error" style="color: red;"></span><br>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating fs-5">
                            <input type="number" class="propown form-control fs-4" id="contact_number" name="contact_number" placeholder="Contact Number" >
                          <label for="contact_number" class="form-label">Phone number</label>
                        </div>
                        <span id="contact-error" style="color: red;"></span><br>
                      </div>

                    </div>

                    <div class="row g-2 mt-3 pb-3 ">

                        <div class="col-12 col-md-6">
                          <div class="form-floating fs-5">
                            <input type="password" class=" propown form-control fs-4" id="password" name="password"  placeholder="password">
                            <label for="password" class="form-label">Password</label>
                          </div>
                          <span id="password-error" style="color: red;"></span><br>
                        </div>
  
                        <div class="col-12 col-md-6">
                          <div class="form-floating fs-5">
                            <input type="password" class=" propown form-control fs-4" id="confpass" name="confpass"  placeholder="password">
                            <label for="confpass" class="form-label">Confirm Password</label>
                          </div>
                          <span id="confpass-error" style="color: red;"></span><br>
                        </div>
  
                      </div>

                    <?php } ?>


                    <div class="row mt-4 mb-3">
                      <div class="col-12 d-flex justify-content-between ">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                        <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="next3">Next</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>

            <div class="row justify-content-center">
            

            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div class="  multisteps-form__panel shadow p-4  bg-white " data-animation="fadeIn">

                  <div class="multisteps-form__content">




                    <div class="row mt-5 mb-5  ">
                      <h2>Property Amenities*</h2>
                    </div>


                    <div class="checkbox-group mb-5  ">

                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="btn-check-1" name="aircon" value="1" <?php echo $aircon === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-air-conditioner fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Aircon</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-2" name="cabinet" value="1" <?php echo $cabinet === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-cabinet-filing fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Cabinet</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-3" name="cctv" value="1" <?php echo $cctv === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-camera-cctv fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">CCTV</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-4" name="drinkingwater" value="1"  <?php echo $drinking_water === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-regular fa-glass-water fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-4 ps-4">Drinking Water</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-5" name="elevator" value="1" <?php echo $elevator === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-elevator fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Elevator</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-6" name="emergency_exit" value="1" <?php echo $emergency_exit === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-person-from-portal fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-4 ps-3">Emergency Exit</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-7" name="foodhall" value="1" <?php echo $food_hall === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-regular fa-plate-utensils fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Food Hall</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-8" name="laundry" value="1" <?php echo $laundry === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-regular fa-washing-machine fa-3x"></i>>
                            </span>
                            <span class="checkbox-label fs-3">Laundry</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-9" name="lounge" value="1" <?php echo $lounge === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-couch fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Lounge</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-10" name="microwave" value="1" <?php echo $microwave === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-microwave fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Microwave</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-11" name="parking" value="1" <?php echo $parking === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-circle-parking fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Parking</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-13" name="refrigerator" value="1" <?php echo $refrigerator === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-refrigerator fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-4">Refrigerator</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-14" name="roofdeck" value="1" <?php echo $roof_deck === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-people-roof fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Roof Deck</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-15" name="security" value="1" <?php echo $security === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-shield-check fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Security</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-16" name="sink" value="1" <?php echo $sink === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-sink fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Sink</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-17" name="studyarea" value="1" <?php echo $study_area === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-lamp-desk fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-4">Study Area</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-18" name="tv" value="1" <?php echo $tv === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-tv fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">TV</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-19" name="wifi" value="1" <?php echo $wifi === 1 ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-wifi fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Wi-Fi</span>
                          </span>
                        </label>
                      </div>
                     
                      </div>

                    <div class="row mt-4 mb-3">
                      <div class="col-12 d-flex justify-content-between ">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                        <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="next5" >Next</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>


            <!-- Room Details -->


            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                <div class="multisteps-form__panel shadow p-4  bg-white" data-animation="fadeIn" >
                  <div class="multisteps-form__content">

                    <!-- Enlist Form -->
                    <div class="row mt-3 mb-5">
                      <div class="col-12 d-flex justify-content-between">
                      <h2>Room Details</h2>
                      

                      <button class="addForm" id="add-room" onclick="addAnotherForm(event)">
                        <span class="addForm__text">Add Room</span>
                      </button>
                    </div>
                    </div>

                    
                    <div  id="roomForm">
                    <div class="row g-2 pb-5 ">
                      <div class="col-12 col-md-6">
                        <div class="selectRoomType">
                          <label for="roomType"  class="form-label h5 ">Room Type</label>
                          <select  class="form-select" name="bed_per_room[]" id="roomFloat" >
                            <option value="" selected disabled> - Select Type of Room - </option>
                            <option value="1">Room for 1</option>
                            <option value="2">Room for 2</option>
                            <option value="3">Room for 3</option>
                            <option value="4">Room for 4</option>
                            <option value="5">Room for 5</option>
                            <option value="6">Room for 6</option>
                            <option value="7">Room for 7</option>
                            <option value="8">Room for 8</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="selectRoomType">
                          <label for="roomType" class="form-label h5">Furnish Type</label>
                          <select class="form-select" name="furnished_type[]" id="furnishFloat" >
                            <option value="" selected disabled> - Select Type of Furnish - </option>
                            <option value="Furnished">Furnished</option>
                            <option value="Semi-furnished">Semi-furnished</option>
                            <option value="Unfurnished">Unfurnished</option>
                          </select>
                        </div>
                      </div>

                       </div>

                      <div class="row g-2  ">

                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="roomRate" class="form-label h5">Rate per room</label>
                            <input type="number" class="form-control" id="roomRate" name="monthly_rent[]" placeholder="₱ 0.00" >
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="roomRate" class="form-label h5">No. of rooms</label>
                            <input type="number" class="form-control" id="roomNo" name="total_rooms[]"  placeholder="No. of rooms" >
                          </div>
                        </div>
                      </div>


                          </div>


                          <div></div>



                          



                            <div class="row mt-4 mb-4">
                              <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" id="next6" >Next</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

            <!-- Property Details -->


            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                <div class="multisteps-form__panel shadow p-4  bg-white" data-animation="fadeIn">
                  <div class="multisteps-form__content">

                    <!-- Enlist Form -->
                    <div class="row mt-3 mb-4">
                      <h2>Property Details</h2>
                    </div>

                    <div class="row g-2 mb-5" >
                      <div class="col-12" >
                        <div class="propertyDescrip" >
                            <textarea class="form-control fs-5"   id="description" name="description" rows="3" placeholder="Please provide a detailed description of your property."><?= htmlspecialchars($description) ?></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row g-2 mt-2 mb-5">

                      <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="totalFloors" class="form-label h5 ">How many floors?</label>
                            <input type="number" class="howmany form-control fs-3" id="totalFloors" name="total_floors" min="0" placeholder="No. of floors" value="<?= htmlspecialchars($total_floors) ?>">
                        </div>
                      </div>

                    </div>

                    <div class="row g-2 mt-2 mb-5">

                    <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="reservationFee" class="form-label h5">Reservation Fee</label>
                            <input type="number" class="form-control" id="reservationFee" name="reservation_fee" placeholder="₱ 0.00" value="₱ <?= htmlspecialchars($reservation_fee) ?>">
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="advanceDeposit" class="form-label h5 ">Advance Deposit</label>
                            <input type="number" class="howmany form-control fs-3" id="advanceDeposit" name="advance_deposit" min="0" placeholder="₱ 0.00" value="₱ <?= htmlspecialchars($advance_deposit) ?>">
                        </div>
                      </div>

                      
                    </div>

                    <div class="row mt-3 mb-3">
                      <h2>Property Bills</h2>
                    </div>

                    <div class="row g-2 mt-2 mb-5">
                      
                      <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="totalbillWater" class="form-label h5">Average water bill?</label>
                            <input type="number" class="form-control" id="totalbillWater" name="water_bill" placeholder="₱ 0.00" value="₱ <?= htmlspecialchars($water_bill) ?>">
                        </div>
                      </div>

                      <div class="col-12 col-md-6 mb-3 ">
                        <div class="form2">
                          <label for="totalbillElectric" class="form-label h5">Average electric bill?</label>
                            <input type="number" class="form-control" id="totalbillElectric" name="electric_bill" placeholder="₱ 0.00" value="₱ <?= htmlspecialchars($electric_bill) ?>">
                        </div>
                      </div>

                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-between">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                          <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" id="next8">Next</button>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
            </div>


                <div class="row">
                  <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="login-heading mb-4 multisteps-form__title">Welcome back!</h3>
                    <div class="multisteps-form__content">
      
                      <!-- Enlist Form -->
                    <div class="row g-2 mt-4">
                        <div class="row">
                            <h5>Is short-term stay allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check shortermCheck" id="short_term_yes" name="short_term" value="1" <?php echo $short_term === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="short_term_yes">Yes</label>

                            <input type="radio" class="btn-check shortermCheck" id="short_term_no" name="short_term" value="0" <?php echo $short_term === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="short_term_no">No</label>
                            </div>
                        </div>
                    </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Minimum stay allowed</h5>
                        </div>
                        <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="min_weeks" id="min_weeks">
                                <option value="1" selected>1 Week</option>
                                <option value="2">2 Weeks</option>
                                <option value="3">3 Weeks</option>
                                <option value="4">4 Weeks</option>
                                <option value="5">5 Weeks</option>
                                <option value="6">6 Weeks</option>
                                <option value="7">7 Weeks</option>
                                <option value="8">8 Weeks</option>
                            </select>
                          </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is coed or mixed-gender allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_yes" name="mix_gender" value="1" <?php echo $mix_gender === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="mix_gender_yes">Yes</label>
                            
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_no" name="mix_gender" value="0" <?php echo $mix_gender === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="mix_gender_no">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Do you have a curfew?</h5>
                        </div>
                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_yes" value="1" <?php echo $curfew === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="curfew_yes">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_no" value="2" <?php echo $curfew === 2 ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-primary" for="curfew_no">No</label>
    
                          </div>
    
                        </div>
                        
                        <div class="row g-2 mt-2" id="ifYes1" style="display:none;" >
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="from_curfew" id="from_curfew">
                              <option value="6PM" <?php echo ($from_curfew === "6PM") ? 'selected' : ''; ?>>6PM</option>
                              <option value="7PM" <?php echo ($from_curfew === "7PM") ? 'selected' : ''; ?>>7PM</option>
                              <option value="8PM" <?php echo ($from_curfew === "8PM") ? 'selected' : ''; ?>>8PM</option>
                              <option value="9PM" <?php echo ($from_curfew === "9PM") ? 'selected' : ''; ?>>9PM</option>
                              <option value="10PM" <?php echo ($from_curfew === "10PM") ? 'selected' : ''; ?>>10PM</option>
                              <option value="11PM" <?php echo ($from_curfew === "11PM") ? 'selected' : ''; ?>>11PM</option>
                              <option value="12MN" <?php echo ($from_curfew === "12MN") ? 'selected' : ''; ?>>12MN</option>
                              <option value="1AM" <?php echo ($from_curfew === "1AM") ? 'selected' : ''; ?>>1AM</option>
                            </select>
                          </div>
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="to_curfew" id="to_curfew">
                              <option value="3AM" <?php echo ($to_curfew === "3AM") ? 'selected' : ''; ?>>3AM</option>
                              <option value="4AM" <?php echo ($to_curfew === "4AM") ? 'selected' : ''; ?>>4AM</option>
                              <option value="5AM" <?php echo ($to_curfew === "5AM") ? 'selected' : ''; ?>>5AM</option>
                              <option value="6AM" <?php echo ($to_curfew === "6AM") ? 'selected' : ''; ?>>6AM</option>
                              <option value="7AM" <?php echo ($to_curfew === "7AM") ? 'selected' : ''; ?>>7AM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row g-2 mt-4">                  
                          <div class="row">
                            <h5>Are pets allowed?</h5>
                          </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check petsCheck" name="pets" value="1" id="pets_yes" <?php echo $pets === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="pets_yes">Yes</label>
                            
                            <input type="radio" class="btn-check petsCheck" name="pets" value="0" id="pets_no" <?php echo $pets === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="pets_no">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are guests allowed?</h5>
                        </div>
                        <div class="col-4 col-md-4 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="1" id="visitors_yes" <?php echo $visitors === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="visitors_yes">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="0" id="visitors_no" checked <?php echo $visitors === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="visitors_no">No</label>
    
                          </div>
    
                        </div>
    
                        <div class="row g-2 mt-4"  id="ifYes2" style="display:none;" >                  
                            <div class="row">
                              <h5>Visitation Hours</h5>
                            </div>
                            <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                              <select class="form-select" name="from_visit" id="from_visit">
                                <option value="3AM" <?php echo ($from_visit === "3AM") ? 'selected' : ''; ?>>3AM</option>
                                <option value="4AM" <?php echo ($from_visit === "4AM") ? 'selected' : ''; ?>>4AM</option>
                                <option value="5AM" <?php echo ($from_visit === "5AM") ? 'selected' : ''; ?>>5AM</option>
                                <option value="6AM" <?php echo ($from_visit === "6AM") ? 'selected' : ''; ?>>6AM</option>
                                <option value="7AM" <?php echo ($from_visit === "7AM") ? 'selected' : ''; ?>>7AM</option>
                                <option value="8AM" <?php echo ($from_visit === "8AM") ? 'selected' : ''; ?>>8AM</option>
                                <option value="9AM" <?php echo ($from_visit === "9AM") ? 'selected' : ''; ?>>9AM</option>
                                <option value="10AM" <?php echo ($from_visit === "10AM") ? 'selected' : ''; ?>>10AM</option>
                                <option value="11AM" <?php echo ($from_visit === "11AM") ? 'selected' : ''; ?>>11AM</option>
                                <option value="12NN" <?php echo ($from_visit === "12NN") ? 'selected' : ''; ?>>12NN</option>
                              </select>
                              </div>
                              <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <select class="form-select" name="to_visit" id="to_visit">
                                  <option value="4PM" <?php echo ($to_visit === "4PM") ? 'selected' : ''; ?>>4PM</option>
                                  <option value="5PM" <?php echo ($to_visit === "5PM") ? 'selected' : ''; ?>>5PM</option>
                                  <option value="6PM" <?php echo ($to_visit === "6PM") ? 'selected' : ''; ?>>6PM</option>
                                  <option value="7PM" <?php echo ($to_visit === "7PM") ? 'selected' : ''; ?>>7PM</option>
                                  <option value="8PM" <?php echo ($to_visit === "8PM") ? 'selected' : ''; ?>>8PM</option>
                                  <option value="9PM" <?php echo ($to_visit === "9PM") ? 'selected' : ''; ?>>9PM</option>
                                  <option value="10PM" <?php echo ($to_visit === "10PM") ? 'selected' : ''; ?>>10PM</option>
                                  <option value="11PM" <?php echo ($to_visit === "11PM") ? 'selected' : ''; ?>>11PM</option>
                                  <option value="12MN" <?php echo ($to_visit === "12MN") ? 'selected' : ''; ?>>12MN</option>
                                  <option value="1AM" <?php echo ($to_visit === "1AM") ? 'selected' : ''; ?>>1AM</option>
                                  <option value="2AM" <?php echo ($to_visit === "2AM") ? 'selected' : ''; ?>>2AM</option>
                                </select>
                              </div>
                        </div>
    
    
                      </div>
    
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is cooking allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="cooking" id="cookin_yes" value="1" <?php echo $cooking === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="cookin_yes">Yes</label>
                            
                            <input type="radio" class="btn-check" name="cooking" id="cooking_no" value="0" <?php echo $cooking === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="cooking_no">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are alcoholic drinks allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check alcoholCheck" id="alcohol_yes" name="alcohol" value="1" <?php echo $alcohol === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="alcohol_yes">Yes</label>
                            
                            <input type="radio" class="btn-check alcoholCheck" id="alcohol_no" name="alcohol" value="0" <?php echo $alcohol === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="alcohol_no">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is vaping or smoking allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check smokingCheck" id="smoking_yes" name="smoking" value="1" <?php echo $smoking === 1 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="smoking_yes">Yes</label>
                            
                            <input type="radio" class="btn-check smokingCheck" id="smoking_no" name="smoking" value="0" <?php echo $smoking === 0 ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-primary" for="smoking_no">No</label>
    
                          </div>
                        </div>
                      </div>
 
                      <div class="row g-2 mt-3">
                        <div class="col-12 d-flex justify-content-between">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                          <button class="btn btn-primary" type="submit" name="apply_property">Submit</button>
                        </div>
                      </div>
                  </div>
                  </div>
                </div>
                </div>
              </div>
              
            </div>
            <!-- <button class="btn btn-sm btn-outline-danger" id="submit-button" type="submit">Add</button> -->

              </form>
            </div>
  </section>
  </div>





  <!-- Enlist Form ends -->







</body>

<!-- javascript -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="js/property_enlist.js"></script>
<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/add_images.js"></script>
<script src="ph-address-selector.js"></script>
<script src="geo.js"></script>
<!-- <script src="form-validate.js"></script> -->

<!-- Radio Button -->
<script>
  function yesnoCheck() {
    if (document.getElementById('wifiCheck1').checked) {
      document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

  }
</script>

<script>
    function yesnoCheck1() {
        if (document.getElementById('curfew_yes').checked) {
            document.getElementById('ifYes1').style.display = 'block';
        }
        else document.getElementById('ifYes1').style.display = 'none';

    }
</script>

<script>
  function yesnoCheck2() {
    if (document.getElementById('visitors_yes').checked) {
      document.getElementById('ifYes2').style.display = 'block';
    }
    else document.getElementById('ifYes2').style.display = 'none';

  }
</script>

<script>
  function yesnoCheck3() {
    if (document.getElementById('visitHr1').checked) {
      document.getElementById('ifYes3').style.display = 'block';
    }
    else document.getElementById('ifYes3').style.display = 'none';

  }
</script>

<script>

let formCount = 1;

        function addAnotherForm(event) {
            event.preventDefault();
            const roomForm = document.getElementById('roomForm');
            const clonedForm = roomForm.cloneNode(true);
            const hrElement = document.createElement('hr');
            const removeButton = document.createElement('button');
            const clonedInputs = clonedForm.querySelectorAll('input, select, textarea');
            clonedInputs.forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false; // Uncheck checkboxes
            } else {
                input.value = ''; // Reset other input values
            }
            });

            removeButton.classList.add('removeForm');
            removeButton.style.paddingLeft = "19px";
            removeButton.style.fontSize = "13px";
            removeButton.style.fontWeight = "600";
            removeButton.innerHTML = 'Remove Room';
            removeButton.onclick = function () {
                removeForm(clonedForm);
            };
            clonedForm.appendChild(removeButton);
            roomForm.parentNode.insertBefore(clonedForm, roomForm.nextSibling);
            roomForm.parentNode.insertBefore(hrElement, roomForm.nextSibling);
            formCount++;
        }

        function removeForm(form) {
            if (formCount > 1) {
                const hrElement = form.nextElementSibling;
                form.parentNode.removeChild(form);
                if (hrElement) {
                    hrElement.parentNode.removeChild(hrElement);
                }
                formCount--;
            }
        }
</script>
<script>
    // Get the input and radio button elements
const floatingPropertyName = document.getElementById("floatingPropertyName");
const propertyType = document.getElementsByName("property_type");
const nextButton = document.getElementById("next2");
const locationModal = document.getElementById("location-modal");

// Disable the button at the start
nextButton.disabled = true;
locationModal.disabled = true;

// Add event listeners to the input and radio button elements
floatingPropertyName.addEventListener("input", checkValidity);
for (let i = 0; i < propertyType.length; i++) {
  propertyType[i].addEventListener("change", checkValidity);
}

// Function to check the validity of the input and radio button elements
function checkValidity() {
  if (floatingPropertyName.value !== "" && getSelectedRadio(propertyType) !== null) {
    nextButton.disabled = false;
    locationModal.disabled = false;
  } else {
    nextButton.disabled = true;
    locationModal.disabled = true;
  }
}

// Function to get the selected radio button
function getSelectedRadio(radioButtons) {
  for (let i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      return radioButtons[i];
    }
  }
  return null;
}
</script>
<script>
const propertyNumber = document.getElementById("property_number");
const street = document.getElementById("street");
const firstName = document.getElementById("first_name");
const lastName = document.getElementById("last_name");
const region = document.getElementById("region");
const province = document.getElementById("province");
const city = document.getElementById("city");
const barangay = document.getElementById("barangay");
const email = document.getElementById("email");
const contactNumber = document.getElementById("contact_number");
const password = document.getElementById("password");
const confpass = document.getElementById("confpass");
const nextButton3 = document.getElementById("next3");
const mapModal = document.getElementById("map-modal");

// Disable the button at the start
nextButton3.disabled = false;
mapModal.disabled = true;

// Add event listeners to the input and select elements
propertyNumber.addEventListener("input", validateLocation);
street.addEventListener("input", validateLocation);
firstName.addEventListener("input", validateOwner);
lastName.addEventListener("input", validateOwner);
region.addEventListener("change", validateLocation);
province.addEventListener("change", validateLocation);
city.addEventListener("change", validateLocation);
barangay.addEventListener("change", validateLocation);
email.addEventListener("input", validateOwner);
contactNumber.addEventListener("input", validateOwner);
password.addEventListener("input", validateOwner);
confpass.addEventListener("input", validateOwner);

// Function to validate the form
function validateLocation(){
let valid = true;

  // Validate property number
  if (propertyNumber.value === "") {
    valid = false;
  }

  // Validate street
  if (street.value === "") {
    valid = false;
  }

    // Validate select tags
  if (region.value === "" || province.value === "" || city.value === "" || barangay.value === "") {
    valid = false;
  }

  nextButton3.disabled = !notvalid;
  mapModal.disabled = !valid;
}

function validateOwner(event) {
  const inputField = event.target;
  let valid = true;

  // Validate first name and last name
  if ((inputField === firstName || inputField === lastName) && (firstName.value === "" || lastName.value === "")) {
    valid = false;
  } else {
    const nameRegex = /^[a-zA-Z]+$/;
    if ((inputField === firstName && !nameRegex.test(firstName.value)) || (inputField === lastName && !nameRegex.test(lastName.value))) {
      valid = false;
    }
  }

  // Validate email
  if (inputField === email) {
    const emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(email.value)) {
      valid = false;
      document.getElementById("email-error").textContent = "Email is invalid";
    } else {
      document.getElementById("email-error").textContent = "";
    }
  }

  // Validate contact number
  if (inputField === contactNumber) {
    const contactRegex = /^(09|639|\+639)\d{9}$/;
    
    let limit = 11;
    if (contactNumber.value.startsWith("+639")) {
        limit = 13;
    } else if (contactNumber.value.startsWith("639")) {
        limit = 12;
    }
    if (contactNumber.value.length > limit) {
        contactNumber.value = contactNumber.value.slice(0, limit);
    }
    if (!contactRegex.test(contactNumber.value)) {
      valid = false;
      document.getElementById("contact-error").textContent = "Contact number is invalid";
    } else {
      document.getElementById("contact-error").textContent = "";
    }
  }

  // Validate password
  if (inputField === password) {
    const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!passwordRegex.test(password.value)) {
      valid = false;
      document.getElementById("password-error").textContent = "Password must be at least 8 characters and contain both letters and numbers";
    } else {
      document.getElementById("password-error").textContent = "";
    }
  }

  // Validate confpass
  if (inputField === confpass) {
    if (confpass.value !== password.value) {
      valid = false;
      document.getElementById("confpass-error").textContent = "Passwords do not match";
    } else {
      document.getElementById("confpass-error").textContent = "";
    }
  }

  // Enable or disable the button based on validity
  nextButton3.disabled = !valid;
  mapModal.disabled = !valid;
}
</script>
<style>
    #map {height: 600px; width: 1350px }
</style>
<script>
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");
    const nextButton4 = document.getElementById("next4");
    const amenitiesModal = document.getElementById("amenities-modal");
    
    nextButton4.disabled = true;
    amenitiesModal.disabled = true;

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

    // Create a variable to store the marker object
    var marker = null;
    

    // Add a click event listener to the map
    map.on('click', function(e) {
    // Check if the marker variable is null or not
    if (marker === null) {
        // Create a new marker at the clicked point
        marker = L.marker(e.latlng).addTo(map);
        
    } else {
        // Remove the existing marker from the map
        marker.remove();
        marker = null;
        latitude.value = '';
        longitude.value = '';
    }

    // Get the latitude and longitude of the marker
    if (marker !== null) {
        var markerLat = marker.getLatLng().lat;
        var markerLng = marker.getLatLng().lng;
        
        latitude.value = markerLat;
        longitude.value = markerLng;

        nextButton4.disabled = false;
        amenitiesModal.disabled = false;
    }
    });
</script>

<script>
    const checkboxes = document.querySelectorAll(".checkbox-input");
const nextButton5 = document.getElementById("next5");
const roomModal = document.getElementById("room-modal");

// Disable the button at the start
nextButton5.disabled = true;
roomModal.disabled = true;

// Add event listeners to the checkbox elements
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener("change", checkValidity);
}

// Function to check the validity of the checkbox elements
function checkValidity() {
  let checked = false;
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checked = true;
      break;
    }
  }
  nextButton5.disabled = !checked;
  roomModal.disabled = !checked;
}
</script>
<script>
const roomFloat = document.getElementById("roomFloat");
const furnishFloat = document.getElementById("furnishFloat");
const roomRate = document.getElementById("roomRate");
const roomNo = document.getElementById("roomNo");
const nextButton6 = document.getElementById("next6");
const imagesModal = document.getElementById("images-modal");

// Disable the button at the start
nextButton6.disabled = false;
imagesModal.disabled = true;

// Add event listeners to the select and number input elements
roomFloat.addEventListener("change", validateForm);
furnishFloat.addEventListener("change", validateForm);
roomRate.addEventListener("input", validateForm);
roomNo.addEventListener("input", validateForm);

// Function to validate the form
function validateForm() {
  let valid = true;

  // Validate roomFloat and furnishFloat
  if (roomFloat.value === "" || furnishFloat.value === "") {
    valid = false;
  }

  // Validate roomRate and roomNo
  const rateRegex = /^\d+(\.\d{1,2})?$/;
  const noRegex = /^\d+$/;
  if (!rateRegex.test(roomRate.value) || !noRegex.test(roomNo.value)) {
    valid = false;
  }

  // Enable or disable the button based on validity
  nextButton6.disabled = !valid;
  imagesModal.disabled = !valid;
}
</script>
<script>
const fileInput = document.getElementById("upload-input");
const nextButton7 = document.getElementById("next7");
const descriptionModal = document.getElementById("description-modal");

// Disable the button at the start
nextButton7.disabled = true;
descriptionModal.disabled = true;

// Add event listener to the file input element
fileInput.addEventListener("change", checkValidity);

// Function to check the validity of the file input element
function checkValidity() {
  if (fileInput.files.length > 0) {
    nextButton7.disabled = false;
    descriptionModal.disabled = false;
  } else {
    nextButton7.disabled = true;
    descriptionModal.disabled = true;
  }
}
</script>
<script>
const description = document.getElementById("description");
const totalFloors = document.getElementById("totalFloors");
const reservationFee = document.getElementById("reservationFee");
const advanceDeposit = document.getElementById("advanceDeposit");
const totalbillWater = document.getElementById("totalbillWater");
const totalbillElectric = document.getElementById("totalbillElectric");
const nextButton8 = document.getElementById("next8");
const rulesModal = document.getElementById("rules-modal");

// Disable the button at the start
nextButton8.disabled = true;
rulesModal.disabled = true;

// Add event listeners to the textarea and number input elements
description.addEventListener("input", validateForm);
totalFloors.addEventListener("input", validateForm);
reservationFee.addEventListener("input", validateForm);
advanceDeposit.addEventListener("input", validateForm);
totalbillWater.addEventListener("input", validateForm);
totalbillElectric.addEventListener("input", validateForm);

// Function to validate the form
function validateForm() {
  let valid = true;

  // Validate description
  if (description.value === "") {
    valid = false;
  }

  // Validate totalFloors, reservationFee, totalbillWater, and totalbillElectric
  const numberRegex = /^\d+(\.\d{1,2})?$/;
  if (!numberRegex.test(totalFloors.value) || !numberRegex.test(reservationFee.value) || !numberRegex.test(advanceDeposit.value) || !numberRegex.test(totalbillWater.value) || !numberRegex.test(totalbillElectric.value)) {
    valid = false;
  }

  // Enable or disable the button based on validity
  nextButton8.disabled = !valid;
  rulesModal.disabled = !valid;
}
</script>
</html>