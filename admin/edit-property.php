<!-- Main Apply Property -->
<?php
use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Unit;
use Models\Request;
use Models\User;
use Models\Auth;
use Models\Image;
use Models\UserImage;
use Models\Notification;
use Models\Availability;
include "../init.php";
include "session.php";

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
$property_type = $details['property_type'];
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

$amenity_id = $details['amenity_id'];
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

$water_bill = $details['water_bill'];
$electric_bill = $details['electric_bill'];

$gcash = $details['gcash'];
$maya = $details['maya'];
$credit_card = $details['credit_card'];
$cash = $details['cash'];

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

$short_term = $rules['short_term']; //1 or 0 
$min_weeks = $rules['min_weeks']; //00-99
$mix_gender = $rules['mix_gender']; //1 or 0 
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

$available_slots = new Availability();
$available_slots->setConnection($connection);
$available_slots = $available_slots->getAvailableSlots($landlord_id, $property_id);
$time_slots = $available_slots['time_slots'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Apt Iba Pa | Admin</title>
    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Form -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <!-- Others -->
  <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
  <link href="css/property_enlist.css" rel="stylesheet" />
  <link href="css/all.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- LeafletJS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>
<div class="mt-4 ms-3 fs-5">
    <a class="backAdmin" href="properties">Go back</a>
</div>

<style>
    <?php //include('css/property_enlist.css')?>
</style>

  <!-- Enlist starts -->
  <form action="edit" method="POST" id="property-form" enctype="multipart/form-data">
  <input type="hidden" name="property_id" value="<?php echo $property_id?>">
<input type="hidden" name="landlord_id" value="<?php echo $landlord_id?>">
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
                <!-- <button class="multisteps-form__progress-btn" id="map-modal" type="button" title="Map">Pin on Map</button> -->
                <button class="multisteps-form__progress-btn" id="amenities-modal" type="button" title="PropertyAmenities">Property
                Amenities</button>
                <button class="multisteps-form__progress-btn" id="room-modal" type="button" title="UnitDetails">Unit
                Details</button>
                <button class="multisteps-form__progress-btn" id="images-modal" type="button" title="AddImages">Add Images</button>
                <button class="multisteps-form__progress-btn" id="billing-modal" type="button" title="PropertyDes">Billing Description </button>
                <button class="multisteps-form__progress-btn" id="time-modal" type="button" title="SetTime">Available Time</button>
                <button class="multisteps-form__progress-btn" id="rules-modal" type="button" title="PropertyDes">House Rules </button>
            </div>
          </div>
        </div>
        <div class="container multisteps-form__form mt-sm-0 mt-lg-5">
        <!-- Basic-Modal -->
            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div  class="multisteps-form__panel shadow p-4  bg-white js-active" data-animation="fadeIn">

                  <div class="multisteps-form__content">


                    <!-- Enlist Form -->
                    

                    <div class="row mt-5 justify-content-between ">
                      <div class="col-6">
                      
                        <h2>Basic Details</h2>
                      </div>
                        
                        <div class="col-2">
                        <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                      <h3>Property Name
                        <label class="requiredText">*</label>
                      </h3>
                    </div>

                    <div class="row">
                      <div class="col-12 pt-4 pb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control fs-2"  id="property_name" name="property_name" value="<?= $property_name ?>">
                          <label for="property_name" class="form-label">Property Name*</label>
                        </div>
                      </div>
                    </div>

                    <div class="row justify-content-center mt-2 reserveRoomType">
                      <div class="col-md-12 ">
                        <div class="row mt-3">
                          <h3>
                            Property Type
                            <label class="requiredText">*</label>
                          </h3>
                        </div>

                          <div class="row mt-2">


                          <div class="col-12 mb-3">
                            <label class="radio w-100 justify-content-center d-flex ">
                                <input type="radio" id="dormitory_type" name="property_type" value="Dormitory" <?php echo ($property_type === 'Dormitory') ? 'checked' : ''; ?> />
                                <div class="row justify-content-between p-3 radioRoomType align-items-center" id="pickRoomType">
                                    <div class="col-8">
                                        <span class="roomTypeName fs-3">Dormitory</span>
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-light fa-house-building fa-4x float-end"></i>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="radio w-100 justify-content-center d-flex">
                                <input type="radio" id="apartment_type" name="property_type" value="Apartment" <?php echo ($property_type === 'Apartment') ? 'checked' : ''; ?> />
                                <div class="row justify-content-between p-3 radioRoomType align-items-center" id="pickRoomType">
                                    <div class="col-8">
                                        <span class="roomTypeName fs-3">Apartment</span>
                                    </div>
                                    <div class="col-3">
                                        <i class="fa-light fa-apartment fa-4x float-end"></i>
                                    </div>
                                </div>
                            </label>
                        </div>


                          </div>

                      </div>

                    </div>

                    <div class="row justify-content-center mt-2 reserveRoomType">
                      <div class="col-md-12 ">
                        <div class="row mt-3">
                          <h3>
                          Describe you property
                            <label class="requiredText">*</label>
                          </h3>
                        </div>

                        <div class="row g-2 mb-5" >
                      <div class="col-12" >
                        <div class="propertyDescrip" >
                            <textarea class="form-control fs-5" id="description" name="description" rows="3" placeholder="Please provide a detailed description of your property."><?= $description ?></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                          <h3>
                          How many floors?
                            <label class="requiredText">*</label>
                          </h3>
                        </div>

                        <div class="row">
                      <div class="col-12 pt-4 pb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control fs-2"  id="total_floors" name="total_floors" value="<?= $total_floors ?>"placeholder="Number of floors*" >
                          <label for="total_floors" class="form-label  ">Number of floors*</label>
                        </div>
                      </div>
                    </div>

                      </div>

                    </div>
                    

                    <div class="row mt-4 mb-3 ">
                      <div class="col-12 d-flex justify-content-end">
                      <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="openLocationModal">Next</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
            <!-- Location-Modal -->
            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div class="multisteps-form__panel shadow p-4  bg-white " data-animation="fadeIn">

                  <div class="multisteps-form__content">




                    <div class="row mt-5 mb-4 justify-content-between ">
                    <div class="col-6">
                      <h2>Property Location</h2>
                      </div>
                      
                      <div class="col-2">
                      <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                    </div>
                    </div>

                    <div class="row g-2">
                      <div class="col-12 col-md-4">
                        <div class="form-floating fs-5 " >
                            <input type="text" class="proploc form-control fs-3"  id="property_number" name="property_number" value="<?= $property_number ?>" placeholder="property_number">
                          <label for="property_number" class="form-label ">Bldg/House No.<label class="requiredText">*</label></label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating fs-5">
                            <input type="text" class="proploc form-control fs-3" id="street" name="street" value="<?= $street ?>" placeholder="housenumber">
                            <label for="street" class="form-label">Street<label class="requiredText">*</label></label>
                        </div>
                      </div>


                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                        <select class="proploc form-select fs-3" name="barangay" id="barangay">
                            <option value="Claro M. Recto" <?= ($barangay === "Claro M. Recto") ? 'selected' : '' ?>>Claro M. Recto</option>
                            <option value="Lourdes Sur East" <?= ($barangay === "Lourdes Sur East") ? 'selected' : '' ?>>Lourdes Sur East</option>
                            <option value="Salapungan" <?= ($barangay === "Salapungan") ? 'selected' : '' ?>>Salapungan</option>
                        </select>
                          <!-- <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" > -->
                          <label for="floatingSelectBrgy">Barangay<label class="requiredText">*</label></label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="city" id="city">
                            <option value="<?= $city ?>"><?= $city ?></option>
                          </select>
                          <!-- <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" > -->
                          <label for="floatingSelectBrgy">City<label class="requiredText">*</label></label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="province" id="province">
                            <option value="<?= $province ?>"><?= $province ?></option>
                          </select>
                          <!-- <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text"> -->
                          <label for="floatingSelectBrgy">Province<label class="requiredText">*</label></label>
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-floating ">
                          <select class="proploc form-select fs-3 " name="region" id="region">
                            <option value="<?= $region ?>"><?= $region ?></option>
                          </select>
                          <!-- <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text"> -->
                          <label for="floatingSelectBrgy">Region<label class="requiredText">*</label></label>
                        </div>
                      </div>

                      <div class="row mt-3 mb-5">
                      <h2>Locate your Property</h2>
                      <label class="description">Please mark the location of your property on the map.</label>
                    </div>

                    <input type="hidden" name="latitude" value="<?= $latitude ?>" id="latitude">
                    <input type="hidden" name="longitude" value="<?= $longitude ?>"id="longitude">

                    <div class = 'wrapper'>
                        <div id="map"></div>
                    </div>

                    </div>
                    <div class="row mt-4 mb-3">
                      <div class="col-12 d-flex justify-content-between ">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                        <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="openAmenitiesModal">Next</button>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
            

            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div class="  multisteps-form__panel shadow p-4  bg-white " data-animation="fadeIn">

                  <div class="multisteps-form__content">




                    <div class="row mt-5 mb-5 justify-content-between  ">
                    <div class="col-6">
                    <h2>Property Amenities</h2>
                      </div>
                      <label class="description">Please select all the amenities of your property:</label>
                      <div class="col-2">
                      <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                    </div>
                    </div>

                    <input type="hidden" name="amenity_id" value="<?php echo $amenity_id ?>">
                    <div class="checkbox-group mb-5  ">

                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="btn-check-1" name="aircon" value="1" <?php echo ($aircon == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-14" name="bathroom" value="1" <?php echo ($bathroom == 1) ? 'checked' : ''; ?>>
                          <span class="checkbox-tile">
                            <span class="checkbox-icon">
                              <i class="fa-light fa-people-roof fa-3x"></i>
                            </span>
                            <span class="checkbox-label fs-3">Bathroom</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input" id="btn-check-2" name="cabinet" value="1" <?php echo ($cabinet == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-3" name="cctv" value="1" <?php echo ($cctv == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-4" name="drinking_water" value="1" <?php echo ($drinking_water == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-5" name="elevator" value="1" <?php echo ($elevator == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-6" name="emergency_exit" value="1" <?php echo ($emergency_exit == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-7" name="food_hall" value="1" <?php echo ($food_hall == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-8" name="laundry" value="1" <?php echo ($laundry == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-9" name="lounge" value="1" <?php echo ($lounge == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-10" name="microwave" value="1" <?php echo ($microwave == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-11" name="parking" value="1" <?php echo ($parking == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-13" name="refrigerator" value="1" <?php echo ($refrigerator == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-15" name="security" value="1" <?php echo ($security == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-16" name="sink" value="1" <?php echo ($sink == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-17" name="study_area" value="1" <?php echo ($study_area == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-18" name="tv" value="1" <?php echo ($tv == 1) ? 'checked' : ''; ?>>
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
                            <input type="checkbox" class="checkbox-input" id="btn-check-19" name="wifi" value="1" <?php echo ($wifi == 1) ? 'checked' : ''; ?>>
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
                        <button class=" btn ml-auto js-btn-next " type="button" title="Next" id="next4" >Next</button>
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
                    <div class="row mt-3  mb-5 me-5 ">
                    <div class="col-8 ">
                        <h2>Unit Details</h2>
                        
                        <input type="hidden" name="form_count" id="form_count">
                        <input type="hidden" name="lowest_rate" id="lowest_rate" value="<?php echo $lowest_rate ?>">
                        </div>

                        <div class="col-2">
                        <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                        </div>
                        <div class="col-2">
                            <button class="addForm" id="add-room" onclick="addAnotherForm(event)">
                                <span class="addForm__text">Add a unit type</span>
                            </button>
                        </div>
                        <label class="description">For each types of rooms / units of your property.</label>
                    </div>
                    <div>
                    <?php
                        foreach($units as $unit){
                            $unit_id = $unit['unit_id'];
                            $unit_type = $unit['unit_type'];
                            $furnished_type = $unit['furnished_type'];
                            $monthly_rent = $unit['monthly_rent'];
                            $total_units = $unit['total_units'];
                            $occupied_units = $unit['occupied_units'];
                    ?>
                    <div class="row g-2 pb-5 ">
                        <div class="col-12 col-md-6">
                            <div class="selectRoomType">
                                <input type="hidden" name="old_unit_id[]" value="<?php echo isset($unit_id) ? $unit_id : NULL?>">
                            <label for="old_room_type"  class="form-label h5 ">Unit Type<label class="requiredText">*</label></label>
                            <select class="form-select" name="old_room_type[]" id="old_room_type">
                                <option value="Single-Bed Room" <?= ($unit_type === "Single-Bed Room") ? 'selected' : '' ?>>Single-Bed Room</option>
                                <option value="Double-Bed Room" <?= ($unit_type === "Double-Bed Room") ? 'selected' : '' ?>>Double-Bed Room</option>
                                <option value="Triple-Bed Room" <?= ($unit_type === "Triple-Bed Room") ? 'selected' : '' ?>>Triple-Bed Room</option>
                                <option value="Quad-Bed Room" <?= ($unit_type === "Quad-Bed Room") ? 'selected' : '' ?>>Quad-Bed Room</option>
                                <option value="5-Bed Room" <?= ($unit_type === "5-Bed Room") ? 'selected' : '' ?>>5-Bed Room</option>
                                <option value="6-Bed Room" <?= ($unit_type === "6-Bed Room") ? 'selected' : '' ?>>6-Bed Room</option>
                                <option value="7-Bed Room" <?= ($unit_type === "7-Bed Room") ? 'selected' : '' ?>>7-Bed Room</option>
                                <option value="8-Bed Room" <?= ($unit_type === "8-Bed Room") ? 'selected' : '' ?>>8-Bed Room</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="selectRoomType">
                            <label for="old_furnished_type" class="form-label h5">Furnish Type</label>
                            <select class="form-select" name="old_furnished_type[]" id="old_furnished_type">
                                <option value="Furnished" <?= ($furnished_type === "Furnished") ? 'selected' : '' ?>>Furnished</option>
                                <option value="Semi-furnished" <?= ($furnished_type === "Semi-furnished") ? 'selected' : '' ?>>Semi-furnished</option>
                                <option value="Unfurnished" <?= ($furnished_type === "Unfurnished") ? 'selected' : '' ?>>Unfurnished</option>
                            </select>
                            </div>
                        </div>
                    </div>

                        <div class="row g-2 pb-5 ">

                        <div class="col-12 col-md-6">
                            <div class="form2">
                            <label for="old_monthly_rent" class="form-label h5">Rate per unit<label class="requiredText">*</label></label>
                                <input type="number" class="form-control" id="old_monthly_rent" name="old_monthly_rent[]" value="<?= $monthly_rent ?>" placeholder="₱ 0.00" >
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="form2">
                            <label for="old_total_units" class="form-label h5">No. of units<label class="requiredText">*</label></label>
                                <input type="number" class="form-control" id="old_total_units" name="old_total_units[]" value="<?= $total_units ?>" placeholder="No. of units">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form2">
                            <label for="occupied_units" class="form-label h5">Occupied units<label class="requiredText">*</label></label>
                                <input type="number" class="form-control" id="occupied_units" name="occupied_units[]" value="<?= $occupied_units ?>" placeholder="Occupied units">
                            </div>
                        </div>
                        </div>
                        </div><div>
                        <!-- <button class="removeForm" style="padding-left: 19px; font-size: 13px; font-weight: 600;">Remove Room</button> -->
                            <?php } ?>
                        </div>
                        <div id="roomFormsContainer"></div>
                        
                    
                        
                            <div class="row mt-4 mb-4">
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" id="openImagesModal" >Next</button>
                                </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

            <!-- Add Images -->

            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                <div class="multisteps-form__panel shadow p-4  bg-white" data-animation="fadeIn">
                  <div class="multisteps-form__content">

                    <!-- Enlist Form -->
                    <div class="row mt-3 mb-5 justify-content-between">
                    <div class="col-12 mb-5">
                      <h2>Property Images*</h2>
                      <label class="description">Please upload the pictures of your property and label them.</label>
                    </div>

                    <div class = 'wrapper'>
                      <div class = "upload">
                          <div class = "upload-wrapper">
                              <div class = "upload-img">
                                  <!-- image here -->
                              </div>
                              <div class = "upload-info">
                                  <p>
                                      <span class = "upload-info-value">0</span> file(s) uploaded.
                                  </p>
                              </div>
                              <div class = "upload-area">
                                  <div class = "upload-area-img">
                                      <img src = "resources/images/upload.png" alt = "">
                                  </div>
                                  <p class = "upload-area-text">Select images or <span>browse</span>.</p>
                              </div>
                              <!-- <input type = "hidden" name="image_title[]" id="image_title" multiple> -->
                              <input type = "file" name="images[]" class = "visually-hidden" id = "upload-input" accept="image/*" multiple>
                              <div id="image_titles_container"></div>
                            <div id="image_previews_container"></div>
                          </div>
                      </div>
                  </div>

                    <div class="row mt-4 mb-4">
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" id="openBillingModal" >Next</button>
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
                    <div class="row mt-5 mb-4 justify-content-between">
                      <div class="col-6">
                      <h2>Billing Details</h2>
                      </div>
                      <div class="col-2">
                      <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                    </div>
                    </div>

                    <div id="billingForm">
                    <div class="row g-2 mt-4 mb-5">
                    <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="reservationFee" class="form-label h5">Reservation Fee</label>
                          <label class="description"> (If applicable)</label>
                            <input type="number" class="form-control" id="reservationFee" name="reservation_fee" placeholder="₱ 0.00" value="<?php echo $reservation_fee ?>">
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form2">
                          <label for="advanceDeposit" class="form-label h5 ">Advance Deposit</label>
                          <label class="description"> (If applicable)</label>
                            <input type="number" class="howmany form-control fs-3" id="advanceDeposit" name="advance_deposit" min="0" placeholder="₱ 0.00" value="<?php echo $advance_deposit ?>">
                        </div>
                      </div>

                      
                    </div>

                    <div class="row mt-3">
                      <h2>Property Bills</h2>
                    </div>
                    <div class="row g-2 mt-2 mb-5 waterAndelec">

                      <div class="col-12 col-md-6 ">
                        <h5 class="fs-2">Is water bill separated from monthly rent?<label class="requiredText">*</label></h5>
                      
                          <div  class="col-12 col-md-2 mt-4"  >
                            <div  class="yesNoPropbtn btn-group " role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" onclick="javascript:waterCheck();"  class="btn-check waterbillCheck"
                                name="water_bill_check" id="waterbillCheck" value="1" <?php echo isset($water_bill) ? 'checked' : ''?>>
                              <label  class="btn btn-outline-dark fs-4  " for="waterbillCheck">Yes</label>
  
                              <input type="radio" onclick="javascript:waterCheck();" class="btn-check waterbillCheck"
                                name="water_bill_check" id="waterbillCheck2" value="2" <?php echo isset($water_bill) ? '' : 'checked'?>>
                              <label class="btn btn-outline-dark text-center fs-4 " for="waterbillCheck2">No</label>
  
                            </div>
  
                          </div>
  
                          <div class="row g-2 mt-2" id="ifwaterYes" style="<?php echo isset($water_bill) ? 'display:block;' : 'display:none;'?>">
                            <div class="d-flex ">
                              <div class="col-12 col-xxl-9 mt-3 ">
                                <div class="form2">
                                  <label for="totalbillWater" class="form-label h5 fs-4">Average water bill?<label class="requiredText">*</label></label>
                                  <input type="number" class="form-control" id="totalbillWater" name="water_bill" value="<?php echo $water_bill?>" placeholder="₱ 0.00"
                                    >
                                </div>
                               
                              </div>
                            </div>
                          </div>
                      </div>

                          <div class="col-12 col-md-6">
                          <h5 class="fs-2">Is electric bill separated from monthly rent?<label class="requiredText">*</label></h5>
                        
                            <div  class="col-12 col-md-2 mt-4"  >
                              <div  class="yesNoPropbtn btn-group " role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" onclick="javascript:electricCheck();"  class="btn-check electricbillCheck"
                                  name="electric_bill_check" id="electricbillCheck" value="1" <?php echo isset($electric_bill) ? 'checked' : ''?>>
                                <label  class="btn btn-outline-dark fs-4  " for="electricbillCheck">Yes</label>
    
                                <input type="radio" onclick="javascript:electricCheck();" class="btn-check electricbillCheck"
                                  name="electric_bill_check" id="electricbillCheck2" value="2" <?php echo isset($electric_bill) ? '' : 'checked'?>>
                                <label class="btn btn-outline-dark text-center fs-4 " for="electricbillCheck2">No</label>
    
                              </div>
                            </div>
                        

                            <div class="row g-2 mt-2" id="ifelectricYes" style="<?php echo isset($electric_bill) ? 'display:block;' : 'display:none;'?> ">
                              <div class="d-flex ">
                                <div class="col-12 col-xxl-9 mt-3 ">
                                  <div class="form2">
                                    <label for="totalbillElectric" class="form-label h5 fs-4">Average electric bill?<label class="requiredText">*</label></label>
                                    <input type="number" class="form-control" id="totalbillElectric" name="electric_bill" value="<?php echo $electric_bill?>" placeholder="₱ 0.00">
                                      </div>
                                      </div>
                               </div>
                             </div>
                           </div>
                       </div>


                       <div class="row mt-5 mb-3">
                            <h2>Payment Methods</h2>
                            <label class="description mb-5">Please select all of your preferred payment methods:<label class="requiredText">*</label></label>
                        </div>


                        <div class="checkbox-group paymentMethod   ">

                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input payment-check" id="payment-gcash" name="gcash" value="1" <?= isset($gcash) ? 'checked' : '' ?>>
                            <span class="checkbox-tile paymentMethod">
                                
                                <span class="checkbox-label fs-3">GCASH</span>
                            </span>
                            </label>
                        </div>
                        <div class="checkbox ">
                            <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input payment-check" id="payment-maya" name="maya" value="1" <?= isset($maya) ? 'checked' : '' ?>>
                            <span class="checkbox-tile paymentMethod">
                                
                                <span class="checkbox-label fs-3">MAYA</span>
                            </span>
                            </label>
                        </div>
                        <div class="checkbox  ">
                            <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input payment-check" id="payment-credit" name="creditcard" value="1" <?= isset($credit_card) ? 'checked' : '' ?>>
                            <span class="checkbox-tile paymentMethod">
                                
                                <span class="checkbox-label fs-3 text-center ">CREDIT CARD</span>
                            </span>
                            </label>
                        </div>
                        <div class="checkbox  ">
                            <label class="checkbox-wrapper">
                            <input type="checkbox" class="checkbox-input payment-check" id="payment-cash" name="cash" value="1" <?= isset($cash) ? 'checked' : '' ?>>
                            <span class="checkbox-tile paymentMethod">
                                
                                <span class="checkbox-label fs-3">CASH</span>
                            </span>
                            </label>
                        </div>

                        
                        </div>

                        <script>
                        // const gcashAccount = document.getElementById('gcashAccount');
                        // const mayaAccount = document.getElementById('mayaAccount');
                        // const creditCardNumber = document.getElementById('creditCardNumber');

                        // const gcashCheckbox = document.querySelector('input[type=checkbox][name=gcash]');
                        // const mayaCheckbox = document.querySelector('input[type=checkbox][name=maya]');
                        // const creditCardCheckbox = document.querySelector('input[type=checkbox][name=credit_card]');
                        
                        // gcashCheckbox.addEventListener('change', function() {
                        //     if (this.checked) {
                        //     gcashAccount.style.display = 'block';
                        //     } else {
                        //     gcashAccount.style.display = 'none';
                        //     }
                        // });

                        // mayaCheckbox.addEventListener('change', function() {
                        //     if (this.checked) {
                        //     mayaAccount.style.display = 'block';
                        //     } else {
                        //     mayaAccount.style.display = 'none';
                        //     }
                        // });

                        // creditCardCheckbox.addEventListener('change', function() {
                        //     if (this.checked) {
                        //     creditCardNumber.style.display = 'block';
                        //     } else {
                        //     creditCardNumber.style.display = 'none';
                        //     }
                        // });
                        </script>


                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                          <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" id="openTimeModal">Next</button>
                        </div>
                    </div>

                  </div>

                  
                </div>
              </div>
            </div>

            <script>
                // Assuming $time_slots is a PHP variable that contains the time slots string
                var timeSlots = '<?php echo $time_slots; ?>'; // This will inject the PHP variable into JavaScript

                // Convert the time slots string to an array
                timeSlots = timeSlots.split(',').map(slot => slot.trim());

                // Function to check checkboxes based on the time slots array
                function checkTimeSlots() {
                    var checkboxes = document.querySelectorAll('input[name="time_slots[]"]');
                    checkboxes.forEach(function(checkbox) {
                        if (timeSlots.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }

                // Call the function after the document is loaded or when needed
                document.addEventListener('DOMContentLoaded', function() {
                    checkTimeSlots();
                });
            </script>
            <div class="row justify-content-center">
              <div class="col-md-11 col-lg-8">

                <div class="  multisteps-form__panel shadow p-4  bg-white " data-animation="fadeIn">

                  <div class="multisteps-form__content">

                    <div class="row mt-5 mb-5 justify-content-between ">
                    <div class="col-6">
                        <h2>Appointment Schedule</h2>
                      </div>

                      <div class="col-2">
                      <button  class="btn ml-auto js-btn-save float-end" type="submit" name="save_property" title="Save">Save</button>
                    </div>
                    </div>
                    <div class="row mt-5 mb-5  ">
                      <h5>Please select the usual time available for property visits</h5>
                    </div>


                    <div class="row ps-4 h3 mb-4">
                      <h2 class="dayzone">  
                        Morning
                      </h2>
                    </div>

                    <div class="checkbox-group setTime mb-2 ">

                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="6:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">6:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="6:30 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">6:30 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="7:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">7:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="7:30 AM">
                          <span class="checkbox-tile setTime">
                           
                            <span class="checkbox-label fs-3">7:30 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="8:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">8:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="8:30 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">8:30 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="9:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">9:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="9:30 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">9:30 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="10:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">10:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="10:30 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">10:30 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="11:00 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">11:00 AM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" class="checkbox-input" id="time_slots" name="time_slots[]" value="11:30 AM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">11:30 AM</span>
                          </span>
                        </label>
                      </div>
                      
                      
                     
                    </div>
                    <div class="row ps-4 h3 mb-4">
                      <h2 class="dayzone">  
                        Afternoon
                      </h2>
                    </div>

                    <div class="checkbox-group setTime mb-2 ">

                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="12:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">12:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="12:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">12:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="1:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">1:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="1:30 PM">
                          <span class="checkbox-tile setTime">
                           
                            <span class="checkbox-label fs-3">1:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="2:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">2:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="2:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">2:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="3:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">3:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="3:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">3:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="4:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">4:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="4:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">4:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="5:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">5:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="5:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">5:30 PM</span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="row ps-4 h3 mb-4">
                      <h2 class="dayzone">  
                        Evening
                      </h2>
                    </div>
                    <div class="checkbox-group setTime mb-2 ">

                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="6:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">6:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="6:30 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">6:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="7:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">7:00 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="7:30 PM">
                          <span class="checkbox-tile setTime">
                           
                            <span class="checkbox-label fs-3">7:30 PM</span>
                          </span>
                        </label>
                      </div>
                      <div class="checkbox">
                        <label class="checkbox-wrapper">
                          <input type="checkbox" id="time_slots" name="time_slots[]" class="checkbox-input" value="8:00 PM">
                          <span class="checkbox-tile setTime">
                            
                            <span class="checkbox-label fs-3">8:00 PM</span>
                          </span>
                        </label>
                      </div>
                    

                  </div>
                  <div class="row mt-4 mb-3">
                    <div class="col-12 d-flex justify-content-between ">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                      <button class=" btn ml-auto js-btn-next " type="button" id="openRulesModal">Next</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>

                <div class="row">
                  <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <div class="multisteps-form__content">
      
                    <div class="row mt-5  ">
                      <h2>House Rules</h2>
                    </div>
                      <!-- Enlist Form -->
                    <div class="row g-2 mt-4">
                    <div class="col-12 col-md-6 ">
                        <h5>Is short-term stay allowed?<label class="requiredText">*</label></h5>
                        <div class="col-12 col-md-5 ms-md-2 ms-sm-2 mt-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check shortermCheck" id="short_term_yes" name="short_term" value="1" <?php echo ($short_term == 1) ? 'checked' : ''?>>

                            <label class="btn btn-outline-dark fs-4" for="short_term_yes">Yes</label>
                            <input type="radio" class="btn-check shortermCheck" id="short_term_no" name="short_term" value="0" <?php echo ($short_term == 0) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="short_term_no">No</label>
                            </div>
                        </div>
                    </div>

                        <div class="col-12 col-md-6  ">
                        <h5 >Minimum stay allowed<label class="requiredText">*</label></h5>

                        <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="min_weeks" id="min_weeks">
                                <option value="1" <?php echo ($min_weeks == 1) ? 'selected' : ''?>>1 Week</option>
                                <option value="2" <?php echo ($min_weeks == 2) ? 'selected' : ''?>>2 Weeks</option>
                                <option value="3" <?php echo ($min_weeks == 3) ? 'selected' : ''?>>3 Weeks</option>
                                <option value="4" <?php echo ($min_weeks == 4) ? 'selected' : ''?>>4 Weeks</option>
                                <option value="5" <?php echo ($min_weeks == 5) ? 'selected' : ''?>>5 Weeks</option>
                                <option value="6" <?php echo ($min_weeks == 6) ? 'selected' : ''?>>6 Weeks</option>
                                <option value="7" <?php echo ($min_weeks == 7) ? 'selected' : ''?>>7 Weeks</option>
                                <option value="8" <?php echo ($min_weeks == 8) ? 'selected' : ''?>>8 Weeks</option>
                            </select>
                          </div>
                      </div>
                      </div>
                      <div class="row g-2 mt-4">                  
                      <div class="col-12 col-md-6 ">
                      <h5>Is coed or mixed-gender allowed?<label class="requiredText">*</label></h5>
      
                      <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_yes" name="mix_gender" value="1" <?php echo ($mix_gender == 1) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4"  for="mix_gender_yes">Yes</label>
                            
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_no" name="mix_gender" value="0" <?php echo ($mix_gender == 0) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="mix_gender_no">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 ">
                          <h5>Are pets allowed?<label class="requiredText">*</label></h5>
                            
                            <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check petsCheck" name="pets" value="1" id="pets_yes" <?php echo ($pets == 1) ? 'checked' : ''?>>
                                <label class="btn btn-outline-dark fs-4" for="pets_yes">Yes</label>
                                
                                <input type="radio" class="btn-check petsCheck" name="pets" value="0" id="pets_no" <?php echo ($pets == 0) ? 'checked' : ''?>>
                                <label class="btn btn-outline-dark fs-4" for="pets_no">No</label>
        
                              </div>
                            </div>

                      </div>

                      <div class="row g-2 mt-2">                  
                        <div class="col-12 col-md-6 ">
                            <h5>Is cooking allowed?<label class="requiredText">*</label></h5>
                          
                          <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" name="cooking" id="cookin_yes" value="1" <?php echo ($cooking == 1) ? 'checked' : ''?>>
                              <label class="btn btn-outline-dark fs-4" for="cookin_yes">Yes</label>
                              
                              <input type="radio" class="btn-check" name="cooking" id="cooking_no" value="0" <?php echo ($cooking == 0) ? 'checked' : ''?>>
                              <label class="btn btn-outline-dark fs-4" for="cooking_no">No</label>
      
                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-md-6 ">
                          <h5>Are alcoholic drinks allowed?<label class="requiredText">*</label></h5>
                          
                          <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check alcoholCheck" id="alcohol_yes" name="alcohol" value="1" <?php echo ($alcohol == 1) ? 'checked' : ''?>>
                              <label class="btn btn-outline-dark fs-4" for="alcohol_yes">Yes</label>
                              
                              <input type="radio" class="btn-check alcoholCheck" id="alcohol_no" name="alcohol" value="0" <?php echo ($alcohol == 0) ? 'checked' : ''?>>
                              <label class="btn btn-outline-dark fs-4" for="alcohol_no">No</label>
      
                            </div>
                          </div>
                        </div>


                      </div>
    
                     

                     

                      <div class="row g-2 mt-2">                  
                        <div class="col-12 col-md-6 ">
                          <h5>Do you have a curfew?<label class="requiredText">*</label></h5>
                        
                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_yes" value="1" <?php echo ($curfew == 1) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="curfew_yes">Yes</label>
                            
                            <input type="radio" onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_no" value="2" <?php echo ($curfew == 0) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="curfew_no">No</label>
    
                          </div>
    
                        </div>
                        
                        <div class="row g-2 mt-2" id="ifYes1" style="display:none;" >
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <label>From<label class="requiredText">*</label></label>
                            <select class="form-select" name="from_curfew" id="from_curfew">
                                <option value="<?= $from_curfew ?>" selected><?= $from_curfew ?></option>
                                <option value="6PM">6PM</option>
                                <option value="7PM">7PM</option>
                                <option value="8PM">8PM</option>
                                <option value="9PM">9PM</option>
                                <option value="10PM">10PM</option>
                                <option value="11PM">11PM</option>
                                <option value="12MN">12MN</option>
                                <option value="1AM">1AM</option>
                            </select>
                          </div>
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                          <label>To<label class="requiredText">*</label></label>
                            <select class="form-select" name="to_curfew" id="to_curfew">
                                <option value="<?= $to_curfew ?>" selected><?= $to_curfew ?></option>
                              <option value="3AM">3AM</option>
                              <option value="4AM">4AM</option>
                              <option value="5AM">5AM</option>
                              <option value="6AM">6AM</option>
                              <option value="7AM">7AM</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 ">
                      <h5>Are guests allowed?<label class="requiredText">*</label></h5>
                        
                        <div class="col-4 col-md-4 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="1" id="visitors_yes" <?php echo ($visitors == 1) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="visitors_yes">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="0" id="visitors_no" <?php echo ($visitors == 0) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="visitors_no">No</label>
    
                          </div>
    
                        </div>
    
                        <div class="row g-2 mt-4"  id="ifYes2" style="display:none;" >                  
                            
                            <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <label>From<label class="requiredText">*</label></label>
                                <select class="form-select" name="from_visit" id="from_visit">
                                    <option value="<?= $from_visit ?>" selected><?= $from_visit ?></option>
                                    <option value="3:00 AM">3:00 AM</option>
                                    <option value="4:00 AM">4:00 AM</option>
                                    <option value="5:00 AM">5:00 AM</option>
                                    <option value="6:00 AM">6:00 AM</option>
                                    <option value="7:00 AM">7:00 AM</option>
                                    <option value="8:00 AM">8:00 AM</option>
                                    <option value="9:00 AM">9:00 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="11:00 AM">11:00 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                </select>
                              </div>
                              <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <label>To<label class="requiredText">*</label></label>
                                <select class="form-select" name="to_visit" id="to_visit">
                                    <option value="<?= $to_visit ?>" selected><?= $to_visit ?></option>
                                    <option value="4:00 PM">4:00 PM</option>
                                    <option value="5:00 PM">5:00 PM</option>
                                    <option value="6:00 PM">6:00 PM</option>
                                    <option value="7:00 PM">7:00 PM</option>
                                    <option value="8:00 PM">8:00 PM</option>
                                    <option value="9:00 PM">9:00 PM</option>
                                    <option value="10:00 PM">10:00 PM</option>
                                    <option value="11:00 PM">11:00 PM</option>
                                    <option value="12:00 MN">12:00 MN</option>
                                    <option value="1:00 AM">1:00 AM</option>
                                    <option value="2:00 AM">2:00 AM</option>
                                </select>
                              </div>
                        </div>
                      </div>
                    </div>
    
                      
                      <div class="row g-2 mt-2">                  
                        
                          <h5>Is vaping or smoking allowed?<label class="requiredText">*</label></h5>
                       
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check smokingCheck" id="smoking_yes" name="smoking" value="1" <?php echo ($smoking == 1) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="smoking_yes">Yes</label>
                            
                            <input type="radio" class="btn-check smokingCheck" id="smoking_no" name="smoking" value="0" <?php echo ($smoking == 0) ? 'checked' : ''?>>
                            <label class="btn btn-outline-dark fs-4" for="smoking_no">No</label>
    
                          </div>
                        </div>
                      </div>
 
                      <div class="row g-2 mt-5 mb-4">
                        <div class="col-12 d-flex justify-content-between">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Previous</button>
                          <button class="btn btn-primary js-btn-submit" type="submit" name="save_property">Save</button>
                          </form>
                        </div>
                        
                      </div>
    
    
                  </div>
                
                  </div>
                </div>
                </div>
              </div>
              
            </div>

              
            </div>
          

  </section>
  </div>





  <!-- Enlist Form ends -->



<style>
    #map {height: 600px; width: 1350px }
</style>


<!-- javascript -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="property_enlist.js"></script>
<script src="add_images.js"></script>
<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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
  function waterCheck() {
    if (document.getElementById('waterbillCheck').checked) {
      document.getElementById('ifwaterYes').style.display = 'block';
    }
    else document.getElementById('ifwaterYes').style.display = 'none';
  }
</script>

<script>
  function electricCheck() {
    if (document.getElementById('electricbillCheck').checked) {
      document.getElementById('ifelectricYes').style.display = 'block';
    }
    else document.getElementById('ifelectricYes').style.display = 'none';
  }
</script>

<!-- CHANGE UNIT TYPES DEPENDING ON PROPERTY TYPE -->
<script>
    // Get references to the radio buttons and select element
const dormitoryRadio = document.getElementById('dormitory_type');
const apartmentRadio = document.getElementById('apartment_type');
const roomFloatSelect = document.getElementById('roomFloat');

// Define the options for Dormitory and Apartment
const dormitoryOptions = [
    "Single-Bed Room",
    "Double-Bed Room",
    "Triple-Bed Room",
    "Quad-Bed Room",
    "5-Bed Room",
    "6-Bed Room",
    "7-Bed Room",
    "8-Bed Room"
];

const apartmentOptions = [
    "Studio Apartment",
    "1-Bedroom Apartment",
    "2-Bedroom Apartment",
    "3-Bedroom Apartment",
    "4-Bedroom Apartment",
    "5-Bedroom Apartment",
    "6-Bedroom Apartment"
];

// Function to set options based on the selected radio button
function setOptions(propertyType) {
    roomFloatSelect.innerHTML = ""; // Clear existing options

    const options = (propertyType === 'Dormitory') ? dormitoryOptions : apartmentOptions;

    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option;
        optionElement.text = option;
        roomFloatSelect.appendChild(optionElement);
    });
}

// Event listeners for radio button changes
dormitoryRadio.addEventListener('change', function() {
    if (this.checked) {
        setOptions('Dormitory');
    }
});

apartmentRadio.addEventListener('change', function() {
    if (this.checked) {
        setOptions('Apartment');
    }
});

// Initially, set options based on the default selected radio button
if (dormitoryRadio.checked) {
    setOptions('Dormitory');
} else if (apartmentRadio.checked) {
    setOptions('Apartment');
}

</script>

<!-- DUPLICATE ADD UNIT/ROOM FORM -->
<!-- <script>
var formCount = 1;

function addAnotherForm(event) {
    event.preventDefault();
    const roomForm = document.getElementById('roomForm');
    const clonedForm = roomForm.cloneNode(true);
    const hrElement = document.createElement('hr');
    const removeButton = document.createElement('button');
    
    // Reset input fields and select options
    const clonedInputs = clonedForm.querySelectorAll('input, select');
    clonedInputs.forEach(input => {
        if (input.type === 'number' || input.type === 'text') {
            input.value = ''; // Clear text input fields
        } else if (input.tagName === 'SELECT') {
            input.selectedIndex = 0; // Reset select options to default
        }
    });

    // Change IDs and names to make them unique
    const inputs = clonedForm.querySelectorAll('input, select');
    inputs.forEach((input, index) => {
        input.id = input.id + '_' + formCount;
        if (input.name.includes('[]')) {
            input.name = input.name.replace('[]', '[' + formCount + ']');
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
    document.getElementById('form_count').value = formCount;
}


function removeForm(form) {
    if (formCount > 1) {
        const hrElement = form.nextElementSibling;
        form.parentNode.removeChild(form);
        if (hrElement) {
            hrElement.parentNode.removeChild(hrElement);
        }
        formCount--;
        document.getElementById('form_count').value = formCount;
    }
}

</script> -->
<script>
    var formCount = 0;

function addAnotherForm() {
    event.preventDefault();
    formCount++;

    const roomFormsContainer = document.getElementById('roomFormsContainer');

    const newForm = document.createElement('div');
    newForm.innerHTML = `
    <div class="roomForm" id="roomForm_${formCount}">
                            <div class="row g-2 pb-5 ">

                                <div class="col-12 col-md-6">
                                    <div class="selectRoomType">
                                    <label for="roomType"  class="form-label h5 ">Unit Type</label>
                                    <select  class="form-select" name="room_type[]" id="roomFloat" >
                                        <option value="Single-Bed Room" selected>Single-Bed Room</option>
                                        <option value="Double-Bed Room">Double-Bed Room</option>
                                        <option value="Triple-Bed Room">Triple-Bed Room</option>
                                        <option value="Quad-Bed Room">Quad-Bed Room</option>
                                        <option value="5-Bed Room">5-Bed Room</option>
                                        <option value="6-Bed Room">6-Bed Room</option>
                                        <option value="7-Bed Room">7-Bed Room</option>
                                        <option value="8-Bed Room">8-Bed Room</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="selectRoomType">
                                    <label for="roomType" class="form-label h5">Furnish Type</label>
                                    <select class="form-select" name="furnished_type[]" id="furnishFloat" >
                                        <option value="Furnished" selected>Furnished</option>
                                        <option value="Semi-furnished">Semi-furnished</option>
                                        <option value="Unfurnished">Unfurnished</option>
                                    </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row g-2 pb-5 ">

                                <div class="col-12 col-md-6">
                                    <div class="form2">
                                        <label for="roomRate" class="form-label h5">Rate per unit</label>
                                        <input type="number" class="form-control" id="roomRate" name="monthly_rent[]" placeholder="₱ 0.00" >
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form2">
                                        <label for="roomRate" class="form-label h5">No. of units</label>
                                        <input type="number" class="form-control" id="roomNo" name="total_rooms[]"  placeholder="No. of rooms">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="removeForm" onclick="removeForm(${formCount})">Remove Room</button>
                        </div>
                        
    `;

    roomFormsContainer.appendChild(newForm);
}

function removeForm(formId) {
    const roomForm = document.getElementById(`roomForm_${formId}`);
    if (roomForm) {
        roomForm.parentNode.removeChild(roomForm);
    }
}

</script>
<script>
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");
    // const nextButton4 = document.getElementById("next4");
    // const amenitiesModal = document.getElementById("amenities-modal");

    // nextButton4.disabled = true;
    // amenitiesModal.disabled = true;

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
        var marker = L.marker([latitude.value, longitude.value]).addTo(map);

    // Create a variable to store the marker object
    //var marker = null;
    

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

        // nextButton4.disabled = false;
        // amenitiesModal.disabled = false;
    }
    });
</script>
</body>
</html>
