<!-- Browse All Properties Page -->
<?php
use Models\Property;
use Models\Image;
use Models\Bookmark;

include ("init.php");
include ("session.php");

if(isset($_POST['query'])){
    $query = $_POST['query'];
} elseif(isset($_POST['barangay'])){
    $query = $_POST['barangay'];

}
$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

$_SESSION['current_page'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa | Accommodations</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script
    src="https://kit.fontawesome.com/868f1fea46.js"
    crossorigin="anonymous"
  ></script>

    <link href="css/accommodations.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
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

    <!-- Featured section starts -->

    <div class="container-fluid accomJumbuildings">
      <h1 class="text-center fw-bold display-1 mt-5">ACCOMMODATIONS</h1>
      <section class="accommodations">

            <div class="container">

                <div class="row">
                    <div class="wrapper">
                    
                        <div class="row justify-content-center mb-3">
                            <div class="col-12 col-md-8 col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="query" id="search_bar" placeholder="Search for your home" aria-label="search-loc" aria-describedby="button-addon2" value="<?php echo $query ?? ''?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-none d-md-block">
                            <div class="d-md-flex align-items-md-center" >
                                <div class="h2"><i class="fa-solid fa-filter-list"></i> Filter</div>
                            </div>
                        </div>
            
                        <hr class="d-block d-md-none">
                        
                        <div class="row">

                            <div class="col-12 col-md-6 col-xl-5 d-none d-md-block">
                                <label class="filterTitle">Location:</label>
                                <div class="form-inline d-flex justify-content-lg-start justify-content-md-start align-items-center my-2 checkbox bg-light border mx-lg-2"> 
                                    <div class="row">
                                        <?php 
                                                foreach ($barangay_list as $barangay){ 
                                                    if(isset($_POST['barangay'])){
                                                        $isChecked = ($query === $barangay) ? 'checked' : '';
                                                    }
                                            ?>
                                        <div class="col-12 col-md-0 col-lg-auto mt-1">
                                            <label class="tick"><?= $barangay ?> <input type="checkbox" name="barangay[]" value="<?= $barangay ?>" <?= $isChecked ?? '' ?>> 
                                                <span class="check"></span> 
                                            </label> 
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none">
                                <label class="filterTitle">Location:</label>
                                <div class="dropdown">
                                    <button style="width: 100%; height:40px; font-size:15px; background-color: #0b2c3c; color:white; font-weight:500; "   class="btn btn-secondary dropdown-toggle dropdown-btn" type="button"
                                        id="locationDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Location
                                    </button>
                                    <ul style="width: 100%; height:110px; " class="dropdown-menu " aria-labelledby="locationDropdownButton">
                                        <li class="drpDownlist ms-3 mt-4"><?php 
                                                foreach ($barangay_list as $barangay){ 
                                                    if(isset($_POST['barangay'])){
                                                        $isChecked = ($query === $barangay) ? 'checked' : '';
                                                    }
                                            ?>
                                        <div class="col-12 col-md-0 col-lg-auto mt-1">
                                            <label  style="font-size:14px; " class=" mt-1 ms-3 "><input  type="checkbox" name="barangay[]" value="<?= $barangay ?>" <?= $isChecked ?? '' ?>> <?= $barangay ?> 
                                                 
                                            </label> 
                                        </div>
                                        <?php } ?></li>
                                        
                                    </ul>
                                </div>
                            </div>
            
                            <div class="col-12 col-md-6 col-xl-4 d-none d-md-block">
                                <label class="filterTitle">Price:</label>
                                <div class="form-inline d-lg-flex align-items-center my-2 me-2 radio bg-light border"> 

                                    <div class="row">
                                        <div class="col-12 col-lg-auto">
                                            <label class="options">Any 
                                                <input type="radio" name="price" value="all" checked>
                                                <span class="checkmark"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto mt-1">
                                            <label class="options">Highest First 
                                                <input type="radio" name="price" value="high">
                                                <span class="checkmark"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto mt-1">
                                            <label class="options">Lowest First 
                                                <input type="radio" name="price" value="low">
                                                <span class="checkmark"></span> 
                                            </label> 
                                        </div>
                                    </div>

                                </div>
                            </div>
            
                            <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none">
                                <label class="filterTitle">Price:</label>
                                <div class="dropdown">
                                    <button style="width: 100%; height:40px; font-size:15px; background-color: #0b2c3c; color:white; font-weight:500;" class="btn btn-secondary dropdown-toggle dropdown-btn" type="button"
                                        id="priceDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Price
                                    </button>
                                    <ul style="width: 100%; height:120px; " class="dropdown-menu " aria-labelledby="locationDropdownButton">
                                        <li class="drpDownlist ms-3 mt-4">
                                         <label style="font-size:14px;" class="dropdown-item options"> Any  <input type="radio" name="price" value="all" checked> <span class="checkmark"></span></label>
                                         
                                         
                                        </li>
                                        <li class="drpDownlist ms-3">
                                         <label style="font-size:14px;" class="dropdown-item options"> Highest First  <input type="radio" name="price" value="high"> <span class="checkmark"> </label>
                                         
                                        </li>
                                        <li class="drpDownlist ms-3">
                                         <label style="font-size:14px;" class="dropdown-item options"> Lowest First <input type="radio" name="price" value="low"> <span class="checkmark">  </label>
                                         
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                           
            
                            <div class="col-12 col-lg-auto col-xl-3 d-none d-md-block">
                                <label class="filterTitle">Type:</label>
                                <div class="form-inline d-lg-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> 

                                    <div class="col-12 col-lg-auto">
                                        <label class="tick">Apartment 
                                            <input type="checkbox" name="property_type[]" value="Apartment"> 
                                            <span class="check"></span> 
                                        </label> 
                                    </div>

                                    <div class="col-12 col-lg-auto mt-1">
                                        <label class="tick">Dormitory 
                                            <input type="checkbox" name="property_type[]" value="Dormitory">
                                            <span class="check"></span> 
                                        </label> 
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none">
                                <label class="filterTitle">Type:</label>
                                <div class="dropdown">
                                    <button style="width: 100%; height:40px; font-size:15px; background-color: #0b2c3c; color:white; font-weight:500;" class="btn btn-secondary dropdown-toggle dropdown-btn" type="button"
                                        id="typeDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Type
                                    </button>
                                    <ul style="width: 100%; height:110px;" class="dropdown-menu " aria-labelledby="typeDropdownButton">
                                        <li class="drpDownlist ms-3 mt-4"><label style="font-size:14px;" class="dropdown-item  ">  <input type="checkbox" name="property_type[]"
                                            value="Apartment"> Apartment  </label></li>
                                        <li class="drpDownlist ms-3 "><label style="font-size:14px;" class="dropdown-item  ">  <input type="checkbox" name="property_type[]"
                                            value="Dormitory"> Dormitory  </label></li>
                                        <li class="drpDownlist ms-3 "><label style="font-size:14px; " class="dropdown-item   "> <input type="checkbox" name="property_type[]"
                                            value="Apartelle"> Apartelle  </label></li>
                                    </ul>
                                </div>
                            </div>


                            
                            <div class="col-12 col-md-6 col-lg-auto col-xl-12 d-none d-md-block">
                                <label class="filterTitle">Amenities Offered:</label>
                                <div class="form-inline d-lg-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> 

                                    <div class="row">

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Aircon 
                                                <input type="checkbox" name="amenities[]" value="aircon"> 
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Bathroom
                                                <input type="checkbox" name="amenities[]" value="bathroom">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Cabinet 
                                                <input type="checkbox" name="amenities[]" value="cabinet">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">CCTV 
                                                <input type="checkbox" name="amenities[]" value="cctv">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>


                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Drinking Water 
                                                <input type="checkbox" name="amenities[]" value="drinking_water">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Elevator 
                                                <input type="checkbox" name="amenities[]" value="elevator">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>
                                    
                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Emergency Exit 
                                                <input type="checkbox" name="amenities[]" value="emergency_exit">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>


                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Food Hall 
                                                <input type="checkbox" name="amenities[]" value="food_hall">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Laundry 
                                                <input type="checkbox" name="amenities[]" value="laundry">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none">
                                <label class="filterTitle">Amenities Offered:</label>
                                <div class="dropdown">
                                    <button style="width: 100%; height:40px; font-size:15px; background-color: #0b2c3c; color:white; font-weight:500;" class="btn btn-secondary dropdown-toggle dropdown-btn" type="button"
                                        id="amenitiesDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Amenities
                                    </button>
                                    <ul style="width: 100%; height:260px;" class="dropdown-menu " aria-labelledby="amenitiesDropdownButton">
                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 mt-4"><label style="font-size:14px;" class="dropdown-item  ">
                                                <input type="checkbox" name="amenities[]" value="aircon"> Aircon 
                                            </label></li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 mt-4"><label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="lounge">Lounge
                                                 
                                            </label> </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "><label style="font-size:14px;"  class="dropdown-item">
                                                <input type="checkbox" name="amenities[]" value="bathroom">Bathroom
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                    <input type="checkbox" name="amenities[]" value="microwave">Microwave
                                                
                                                </label>  </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "><label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="cabinet">Cabinet
                                                
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                    <input type="checkbox" name="amenities[]" value="parking">Parking
                                                    
                                                </label> </li>

                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3  "><label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="cctv">CCTV
                                                
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label  style="font-size:14px;"  class="dropdown-item">
                                                        <input type="checkbox" name="amenities[]" value="refrigerator">Refrigerator 
                                    
                                                    </label> </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "><label style="font-size:14px;"  class="dropdown-item">
                                                <input type="checkbox" name="amenities[]" value="drinking_water">Drinking Water 
                                                
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                    <input type="checkbox" name="amenities[]" value="security">Security
                                                    
                                                </label>  </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="elevator">Elevator
                                                
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                    <input type="checkbox" name="amenities[]" value="sink">Sink
                                                    
                                                </label>  </li>
                                        </div>
                                    </div>


                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item">
                                                <input type="checkbox" name="amenities[]" value="emergency_exit">Emergency Exit 
                                                
                                            </label>  </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                             <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="study_area">Study Area
                                                
                                            </label>   </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> <label style="font-size:14px;"  class="dropdown-item">
                                                <input type="checkbox" name="amenities[]" value="food_hall">Food Hall 
                                                
                                            </label> </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "><label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="tv">TV
                                                
                                            </label>  </li>
                                        </div>
                                    </div>

                                    <div class="row"> 
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 "> 
                                                <label style="font-size:14px;"  class="dropdown-item"> 
                                                    <input type="checkbox" name="amenities[]" value="laundry">Laundry
                                                </label>  
                                            </li>
                                        </div>
                                        <div class="col-6 col-lg-auto">
                                            <li class="drpDownlist ms-3 ">
                                                <label style="font-size:14px;"  class="dropdown-item"> 
                                                <input type="checkbox" name="amenities[]" value="wifi">Wi-Fi
                                                </label>  
                                            </li>
                                        </div>
                                    </div>
                                        
                                
                                    </ul>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-12 mt-md-4 pt-md-2 mt-lg-0 pt-lg-0 d-none d-md-block">

                                <div class="form-inline d-lg-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> 
                                    

                                    <div class="row">

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Lounge 
                                                <input type="checkbox" name="amenities[]" value="lounge">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Microwave 
                                                <input type="checkbox" name="amenities[]" value="microwave">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Parking 
                                                <input type="checkbox" name="amenities[]" value="parking">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Refrigerator 
                                                <input type="checkbox" name="amenities[]" value="refrigerator">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Security  
                                                <input type="checkbox" name="amenities[]" value="security">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Sink 
                                                <input type="checkbox" name="amenities[]" value="sink">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Study Area 
                                                <input type="checkbox" name="amenities[]" value="study_area">
                                                <span class="check"></span> 
                                            </label> 
                                        </div>

                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">TV
                                                <input type="checkbox" name="amenities[]" value="tv">
                                                <span class="check"></span> 
                                            </label>  
                                        </div>


                                        <div class="col-12 col-lg-auto">
                                            <label class="tick">Wi-Fi 
                                                <input type="checkbox" name="amenities[]" value="wifi">
                                                <span class="check"></span> 
                                            </label>  
                                        </div>

                                    </div>

                                </div>
                            </div>

            
                        </div>
                </div>
        
                <!-- Contains each accommodations -->
                
                <div class="box-container" id="results">
                    
                </div>
               
                    
                <!-- End of accommodations display -->

            </div>
      </section>
    </div>

    <!-- Featured ends -->


    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize the query variable with an empty string
    //var query = $('#search_bar').val();
    // Make the initial AJAX request when the page loads
    performAjax({
        query: $('input[name="query"]').val(),
        price: $('input[name="price"]:checked').val(),
        property_type: $('input[name="property_type[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        barangay: $('input[name="barangay[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        amenities: $('input[name="amenities[]"]:checked').map(function () {
            return $(this).val();
        }).get()
    }); 

    // Function to perform the AJAX request
    function performAjax(data) {
        $.ajax({
            url: 'search',
            type: 'POST',
            data: data,
            success: function (response) {
                $('#results').html(response);
            }
        });
    }

    
    $('#search_bar').on('input', function () {
        // Update the query variable with the current search bar value
        query = $('#search_bar').val();

        // Perform AJAX request to fetch results
        performAjax({ query: query });
    });

    $('input[name="price"], input[name="property_type[]"], input[name="barangay[]"], input[name="amenities[]"], input[name="query"]').on('change', function () {
    performAjax({
        query: $('input[name="query"]').val(),
        price: $('input[name="price"]:checked').val(),
        property_type: $('input[name="property_type[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        barangay: $('input[name="barangay[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        amenities: $('input[name="amenities[]"]:checked').map(function () {
            return $(this).val();
        }).get()
    });
});

});

</script>

<script>  
    function bookmark(propertyId) {
        const bookmarkBtn = document.getElementById(`bookmarkBtn-${propertyId}`);
        const bookmarkBtnVal = bookmarkBtn.value;

        ajaxBookmark({ 
            property_id: propertyId,
            status: bookmarkBtnVal
        });
    };

    function ajaxBookmark(data) {
        $.ajax({
            url: 'bookmark',
            type: 'POST',
            data: data,
            success: function(response) {
                const bookmarkBtnChange = document.getElementById(`bookmarkBtn-${data.property_id}`);
                if (response === '1') {
                    bookmarkBtnChange.classList.replace("fa-regular", "fa-solid");
                    bookmarkBtnChange.setAttribute("value", "1");
                } else {
                    bookmarkBtnChange.classList.replace("fa-solid", "fa-regular");
                    bookmarkBtnChange.setAttribute("value", "0");
                }
                bookmarkBtnChange.setAttribute("onclick", `bookmark(${data.property_id})`);
            }
        }); 
    }
</script>
</html>

