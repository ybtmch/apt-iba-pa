<?php
    use Models\User;
    include "../init.php";
    include ("session.php");

    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);

    $image_path = $user['image_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
    <link rel="stylesheet" href="css/adminstyle.css">
	<!-- <link rel="stylesheet" href="user.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<title>Apt Iba Pa | Admin</title>
    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
</head>
<body>

	<!-- SIDEBAR -->
	<?php include ('sidebar.php'); ?>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include('navbar.php');?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Landlords</h1>
				</div>
                <a href="#" class="btn-add">	
                    <span class="text">Add</span>
                </a>
			</div>

			

            <!-- ADD-DATA -->
			<div id="add-form" class="add-data" >
				<div class="order">
					<div class="head">
						<h3>Add Landlord</h3>			
					</div>
                    <form action="edit-landlord" method="POST" id="addForm" enctype="multipart/form-data">
					<div class="row row-container">
						<div class="edit-column">
                        <input type="hidden" name="add_landlord"/>
							<label for="first-name">First Name </label>
							<input id="first-name" name="first_name" type="text" class="edit-txtbox" required/>
							<label for="last-name">Last Name </label>
							<input id="last-name" name="last_name" type="text" class="edit-txtbox" required/>
							<label for="contact-num">Contact Number</label>
							<input id="contact-num" name="contact_number" type="text" class="edit-txtbox" required/>
                            <span class="error-message" id="contact-error"></span>
							<label for="email">Email</label>
							<input id="email" name="email" type="email" class="edit-txtbox" required/>
                            <span class="error-message" id="email-error-register"></span>
                            <label for="password">Password</label>
							<input id="password" name="password" type="password" class="edit-txtbox" required/>
                            <span class="error-message" id="password-error-register"></span>
                            <label for="password">Confirm Password</label>
							<input id="confpass" name="confirm_password" type="password" class="edit-txtbox" required/>
                            <span class="error-message" id="confpass-error"></span>
						</div>
						<div class="img-profile">
							<div class="wrapper">
								<div class="image">
									<img class="change-add" src="" alt="">
								</div>
								<div class="content">
									<div class="icon">
										<i class="fas fa-cloud-upload-alt"></i>
									</div>
									<div class="text">
										Add picture
									</div>
								</div>
								<div id="cancel-btn">
									<i class="fas fa-times"></i>
								</div>
								<div class="file-name">
									File name here
								</div>
							</div>
							<button onclick="defaultBtnActive()" id="custom-btn" type="button">Choose a file</button>
                            <span class="error-message" id="image-error"></span>
							<input id="default-btn" name="image_name" type="file" accept="image/*" hidden>
						</div>
						
					</div>
					<div class="row saveNcancel">
						<div class="saveNcancel">
							<!-- <span id="add-btn" class="status save action-status" role="button">Save</span> -->
                            <button class="edtSaveChanges" type="submit" id="add-btn" name="add_user">Add Landlord</button>
                            
                            <form action="landlords">
                            <button  class="edtCancelChanges" type="submit">Cancel</button>
							<!-- <span id="cancel-btn" class="status cancel action-status" role="button">Cancel</span> -->
                            </form>
						</div>
					</div>
                    </form>

					
					
				</div>
				
			</div>

			<!-- EDIT-DATA -->

		</main>
		<!-- MAIN -->
	</section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    <style>
        .error-message{
            color: red;
            font-size: 12px;
        }
    </style>
	<!-- CONTENT -->
  
    <script>
        $(document).ready(function() {
            const firstName = document.getElementById("first-name");
            const lastName = document.getElementById("last-name");
            const contactNumber = document.getElementById("contact-num");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const confpass = document.getElementById("confpass");
            const submitButton = document.getElementById("add-btn");
            const addForm = document.getElementById("addForm");
            const defaultBtn2 = document.getElementById("default-btn");

            //submitButton.disabled = true;

            document.getElementById('first-name').addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z]/g, '');
            });

            document.getElementById('last-name').addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z]/g, '');
            });

            document.getElementById('contact-num').addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

                password.addEventListener("input", validatePassword);
                confpass.addEventListener("input", validatePassword);

            addForm.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                if (validateForm()) {
                    // If the form is valid, submit it
                    // alert('nice!');
                    addForm.submit();
                } else {
                    // If the form is not valid, you can display an error message or take other actions
                    // alert('Invalid Form');
                }
            });


            function validatePassword(){
            let valid = true;
            // Validate password
            const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
                    if (!passwordRegex.test(password.value)) {
                        valid = false;
                        document.getElementById("password-error-register").textContent = "Password must be at least 8 characters and contain both letters and numbers";
                        password.style.outlineColor = "red";
                    } else {
                        document.getElementById("password-error-register").textContent = "";
                        password.style.outlineColor = "";
                    }

                    // Validate confpass
                    if (confpass.value !== password.value) {
                        valid = false;
                        document.getElementById("confpass-error").textContent = "Passwords do not match";
                        confpass.style.outlineColor = "red";
                    } else {
                        document.getElementById("confpass-error").textContent = "";
                        confpass.style.outlineColor = "";
                    }
                    return valid;
            }
                function validateForm() {

                    let valid = true;

                    // Validate first name and last name
                    if (firstName.value === "" || lastName.value === "") {
                        valid = false;
                    } else {
                        const nameRegex = /^[a-zA-Z]+$/;
                        if (!nameRegex.test(firstName.value) || !nameRegex.test(lastName.value)) {
                            valid = false;
                        }
                    }

                    // Validate email
                    const emailRegex = /^\S+@\S+\.\S+$/;
                    if (!emailRegex.test(email.value)) {
                        valid = false;
                        document.getElementById("email-error-register").textContent = "Email is invalid";
                        email.style.outlineColor = "red";
                    } else {
                        document.getElementById("email-error-register").textContent = "";
                        email.style.outlineColor = "";
                    }

                    // Validate contact number
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
                        contactNumber.style.outlineColor = "red";
                    } else {
                        document.getElementById("contact-error").textContent = "";
                        contactNumber.style.outlineColor = "";
                    }

                    
                    const selectedFiles = defaultBtn2.files;
                    if (selectedFiles.length > 0) {
                        valid = true;
                    } else {
                        document.getElementById("image-error").textContent = "You must upload an image";
                    }
                    
                    return valid;
                }


                
                    var emailError = document.getElementById("email-error-register");
                    email.addEventListener("input", () => {
                        const emailCheck = email.value;
                        if (emailCheck.trim() !== "") {
                            checkEmailAvailability(emailCheck);
                        } else {
                            emailError.textContent = "";
                        }
                    });
        
                    function checkEmailAvailability(emailCheck) {
                    fetch("check-email", {
                        method: "POST",
                        body: JSON.stringify({ email: emailCheck }),
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.emailExists) {
                            emailError.textContent = "Email already exists.";
                            //submitButton.disabled = true;
                        } 
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                }

			const wrapper = document.querySelector(".wrapper");
            const fileName = document.querySelector(".file-name");
            const defaultBtn = document.querySelector("#default-btn");
            const customBtn = document.querySelector("#custom-btn");
            const cancelBtn = document.querySelector("#cancel-btn i");
            const img = document.querySelector(".change-add");
            let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

            // function defaultBtnActive() {
            //   defaultBtn.click();
            // }

            customBtn.addEventListener("click",function(){
                defaultBtn.click();
            });

            defaultBtn.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                const result = reader.result;
                img.src = result;
                wrapper.classList.add("active");
                
                };
                reader.readAsDataURL(file);
            }
            if (this.value) {
                let valueStore = this.value.match(regExp);
                fileName.textContent = valueStore;
            }
            });

            // Event listener for cancel button
            cancelBtn.addEventListener("click", function() {
            img.src = "";
            wrapper.classList.remove("active");
            // Reset the file input value to allow selecting the same file again
            defaultBtn.value = "";
            fileName.textContent = "File name here";
            });


            const editForm = document.getElementById('edit-form');
            const dataTable = document.getElementById('data-table');

            const canclBtn = document.getElementById('cancl-btn');

            canclBtn.addEventListener('click', function() {
                dataTable.style.display = 'block';
                editForm.style.display = 'none';
            });
			
            $('.editbtn').click(function() {
				dataTable.style.display = 'none';
  				editForm.style.display = 'block';
                var row = $(this).closest('tr');
                var imgSrc = row.find('td:nth-child(1) img').attr('src');
                var userId = row.find('td:nth-child(2) p').text();
                var firstName = row.find('td:nth-child(3) p').text();
                var lastName = row.find('td:nth-child(4) p').text();
                var contactNumber = row.find('td:nth-child(5) p').text();
                var email = row.find('td:nth-child(6) p').text();
            
                $('.img-profile .image img').attr('src', imgSrc);
                $('#user-id').val(userId);
                $('#first-name').val(firstName);
                $('#last-name').val(lastName);
                $('#contact-num').val(contactNumber);
                $('#email').val(email);

                // Add code to handle other fields or customization of data
            });

            $('.trash').click(function(){
                var row = $(this).closest('tr');
                var userId = row.find('td:nth-child(2) p').text();
                var result = window.confirm("Are you sure you want to delete this user?");

                if (result) {
                    deleteUser({
                        delete_user: 1,
                        user_id: userId
                    });
                }
            });

            function deleteUser(data) {
                $.ajax({
                    url: 'edit-user',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
	<!-- <script src="admin_script.js"></script> -->
</body>
</html>