<?php
use Models\User;
include ("init.php");
include ("session.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2){
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'] ?? NULL;

$user = new User();
$user->setConnection($connection);
$user = $user->getById($user_id);

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$contact_number = $user['contact_number'];
$email = $user['email'];
$salt = $user['salt'];
$password = $user['password'];
$show_password = hash('sha256', $password . $salt);
$image_name = $user['image_name'] ?? 'male-logo2.png';

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>

    <link href="edit-profile.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />

    <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
  </head>
  <body class="bgcolor">
    <!-- Navbar -->
    <?php include('navbar_logged.php'); ?>
    <!-- Navbar ends -->
<span></span>

<section class="profile">
    <form action="profile-edit" method="POST" id="profileForm">
        <input type="hidden" value="<?php echo $user_id ?>" id="user_id" name="user_id">
        <div class="edt-container container-xl px-4 mt-4 ">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="edit-profile card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" id="profileImage" src="resources/images/users/<?= $image_name ?>" alt="">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4 pfp">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <input type="file" id="imageInput" name="image" style="display: none;" accept="image/*">
                            <button class="btn btn-secondary disabled-button uploadPfp" type="button"
                            onclick="document.getElementById('imageInput').click();" id="uploadImageButton">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Profile</div>
                        <div class="card-body">
                            
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                        <input class="form-control" id="inputFirstName" name="first_name" type="text"
                                            placeholder="Enter your first name" value="<?= $first_name ?>" disabled>
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                        <input class="form-control" id="inputLastName" name="last_name" type="text"
                                            placeholder="Enter your last name" value="<?= $last_name ?>" disabled>
                                    </div>
                                </div>
    
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                    <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                        placeholder="Enter your email address" value="<?= $email ?>" disabled>
                                    </div>
            
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" name="contact_number" type="tel"
                                            placeholder="Enter your phone number" value="<?= $contact_number ?>" disabled>
                                    </div>

                                    
                                </div>
                                <div class="row gx-3 mb-3 passwordRow" >
                                
                                

                                    <div class="col-md-6" id="newPasswordDiv" style="display: none;">
                                        <label class="small mb-1" for="inputPassword">New Password</label>
                                        <div class="input-group">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter your new password" disabled>
                                            <span class="input-group-text">
                                                <button class="btn btn-link btn-toggle-password" type="button" onclick="togglePasswordVisibility('inputPassword')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="confirmPasswordDiv" style="display: none;">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                        <div class="input-group">
                                            <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm password"  disabled>
                                            <span class="input-group-text">
                                                <button class="btn btn-link btn-toggle-password" type="button" onclick="toggleConfirmPasswordVisibility('inputConfirmPassword')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!-- Save changes button-->
                                <button class="btn editPfp pe-4 ps-4" id="editProfileButton" type="button" name="edit_profile" onclick="enableInputs()">Edit Profile</button>
                                <a href=""><button class="btn btn-danger backPfp pe-5 ps-5" id="editBackButton" type="button">Back</button></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</section>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function (event) {
            var file = event.target.files[0]; // Get the selected file
            var reader = new FileReader(); // Create a new FileReader object

            reader.onload = function () {
                // Set the src attribute of the img element with the data URL of the selected image
                document.getElementById('profileImage').src = reader.result;
            };

            // Read the selected file as a data URL, triggering the onload function
            reader.readAsDataURL(file);
        });

        document.addEventListener('DOMContentLoaded', function () {
            var uploadImageButton = document.getElementById('uploadImageButton');
            uploadImageButton.disabled = true;
        });

        function enableInputs(event) {
            //event.preventDefault();
            var inputs = document.querySelectorAll('input');
            inputs.forEach(function (input) {
                input.disabled = false;
            });

            var uploadImageButton = document.getElementById('uploadImageButton');
            uploadImageButton.disabled = false;
            uploadImageButton.classList.remove('disabled-button');

            // Show the "Confirm Password" field
            var newPasswordDiv = document.getElementById('newPasswordDiv');
            newPasswordDiv.style.display = 'block';

            // Show the "Confirm Password" field
            var confirmPasswordDiv = document.getElementById('confirmPasswordDiv');
            confirmPasswordDiv.style.display = 'block';

            // Replace the "Edit Profile" button with "Save Changes" button
            var editProfileButton = document.getElementById('editProfileButton');
            editProfileButton.innerHTML = 'Save Changes';
            editProfileButton.removeEventListener('click', enableInputs);
            editProfileButton.addEventListener('click', saveChanges);

            // Change "Back" button functionality to "Cancel"
            var editBackButton = document.getElementById('editBackButton');
            editBackButton.innerHTML = 'Cancel';
            editBackButton.removeEventListener('click', goBack);
            editBackButton.addEventListener('click', cancelChanges);
        }

        function saveChanges() {
            //var profileForm = document.getElementById('profileForm');
            //profileForm.submit();
            // profileForm.addEventListener('submit', function () {
            // alert("Your profile has been updated!");
            // });
            var user_id = document.getElementById('user_id').value;
            var first_name = document.getElementById('inputFirstName').value;
            var last_name = document.getElementById('inputLastName').value;
            var email_address = document.getElementById('inputEmailAddress').value;
            var contact_number = document.getElementById('inputPhone').value;
            var password = document.getElementById('inputPassword').value;
            //var image_name = document.getElementById('imageInput').value;
            var imageInput = document.getElementById('imageInput');
            var imageFile = imageInput.files[0]; // Get the selected image file

            var imageName = (imageFile) ? imageFile.name : null;

            saveProfileInfo({
                user_id: user_id,
                first_name: first_name,
                last_name: last_name,
                email_address: email_address,
                contact_number: contact_number,
                password: password,
                image_name: imageFile,
            });
            

            var inputs = document.querySelectorAll('input');
            inputs.forEach(function (input) {
                input.disabled = true;
            });

            // Disable the "Upload new image" button
            var uploadImageButton = document.getElementById('uploadImageButton');
            uploadImageButton.disabled = true;
            uploadImageButton.classList.add('disabled-button');

            // Hide the "Confirm Password" field
            var confirmPasswordDiv = document.getElementById('confirmPasswordDiv');
            confirmPasswordDiv.style.display = 'none';

            // Restore "Edit Profile" button functionality
            var editProfileButton = document.getElementById('editProfileButton');
            editProfileButton.innerHTML = 'Edit Profile';
            editProfileButton.removeEventListener('click', saveChanges);
            editProfileButton.addEventListener('click', enableInputs);

            // Restore "Back" button functionality
            var editBackButton = document.getElementById('editBackButton');
            editBackButton.innerHTML = 'Back';
            editBackButton.removeEventListener('click', cancelChanges);
            editBackButton.addEventListener('click', goBack);

            
        }

        // function saveProfileInfo(data) {
        //     $.ajax({
        //         type: 'POST',
        //         url: 'profile2.php',
        //         data: data,
        //         success: function(response) {
        //             alert(response);
        //             //alert("Your profile has been updated!");
        //         },
        //         error: function() {
        //             alert('Error sending chat messages.');
        //         }
        //     }); 
        // }

        function saveProfileInfo(data) {
            var formData = new FormData(); // Create a FormData object
            formData.append('user_id', data.user_id);
            formData.append('first_name', data.first_name);
            formData.append('last_name', data.last_name);
            formData.append('email_address', data.email_address);
            formData.append('contact_number', data.contact_number);
            formData.append('password', data.password);
            formData.append('image_name', data.image_name); // Append the image file to the FormData

            // Perform an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'profile-edit', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    // Handle the error
                }
            };
            xhr.send(formData);
        }


        function cancelChanges() {
            var inputs = document.querySelectorAll('input');
            inputs.forEach(function (input) {
                input.disabled = true;
                input.value = ''; // Clear input values
            });

            // Hide the "Confirm Password" field
            var confirmPasswordDiv = document.getElementById('confirmPasswordDiv');
            confirmPasswordDiv.style.display = 'none';

            // Restore "Edit Profile" button functionality
            var editProfileButton = document.getElementById('editProfileButton');
            editProfileButton.innerHTML = 'Edit Profile';
            editProfileButton.removeEventListener('click', saveChanges);
            editProfileButton.addEventListener('click', enableInputs);

            // Restore "Back" button functionality
            var editBackButton = document.getElementById('editBackButton');
            editBackButton.innerHTML = 'Back';
            editBackButton.removeEventListener('click', cancelChanges);
            editBackButton.addEventListener('click', goBack);
        }
            

        var uploadImageButton = document.getElementById('uploadImageButton');
        uploadImageButton.classList.add('disabled-button');
        uploadImageButton.disabled = true;

        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var toggleButton = passwordInput.nextElementSibling.querySelector('.btn-toggle-password');
            if (!passwordInput.disabled) {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = "password";
                    toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
                }
            }
        }

        function toggleConfirmPasswordVisibility(inputId) {
            togglePasswordVisibility(inputId);
        }
    </script>

    <!-- Footer -->
    <?php //include('footer.php'); ?>
    <!-- Footer ends -->

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
  </html>
