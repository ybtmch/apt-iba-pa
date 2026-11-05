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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">

	<title>Apt Iba Pa | Admin</title>
</head>
<body>

	<!-- SIDEBAR -->
	<?php include ('sidebarbootstrap.php'); ?>
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
					<h1>Users</h1>
				</div>
				
                <a href="add-user" class="btn-add">	
                    <span class="text">Add</span>
                </a>
			</div>
			<div  class="d-flex justify-content-center ">
				<div id="liveAlertPlaceholder"></div>
			</div>
			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; " id="data-table" class="table-data">
				<div class="order">
					<div class="head">
						<h3>User List</h3>
						
					</div>
					<table>
						<thead>
							<tr>
                                <th>Image</th>
								<th>User ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Contact Number</th>
								<th>Email</th>
                                <th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                $users = new User();
                                $users->setConnection($connection);
                                $getUsers = array_reverse($users->getUsers());
                                foreach($getUsers as $user){
                                    $users_image_path = isset($user['image_name']) ? $user['image_name'] : 'male-logo.png';
                                    $users_id = $user['user_id'];
                                    $first_name = $user['first_name'];
                                    $last_name = $user['last_name'];
                                    $contact_number = $user['contact_number'];
                                    $email = $user['email'];
                                    $status = $user['status'];
                                    $status = $user['status'];
                                    if($status===1){
                                        $show_status = 'Active';
                                    }elseif($status===2){
                                        $show_status = 'Pending';
                                    }elseif($status===0){
                                        $show_status = 'Deleted';
                                    }
                            ?>
							<tr>
                                <td>
									<img src="../resources/images/users/<?php echo $users_image_path ?>">
								</td>
								<td><p><?php echo $users_id?></p></td>
								<td><p><?php echo $first_name ?></p></td>
								<td><p><?php echo $last_name ?></p></td>
								<td><p><?php echo $contact_number ?></p></td>
								<td><p><?php echo $email ?></p></td>
                                <td><span class="status completed"><?php echo $show_status ?></span></td>
								<td>
                                    <i class='editbtn bx bx-edit' ></i>
                                    <i class='trash bx bx-trash' ></i>
                                </td>
							</tr>
                            <?php } ?>
						</tbody>
					</table>
				</div>
			</div>

            <!-- EDIT-DATA -->
			<div id="edit-form" class="edit-data" >
				<div class="order">
					<div class="head">
						<h3>Edit User</h3>			
					</div>
                    <form action="edit-user" method="POST" id="editForm" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user-id" value="">
					<div class="row row-container">
						<div class="edit-column">
                        <label for="first-name">First Name </label>
						
							<input id="first-name" name="first_name" type="text" class="edit-txtbox" required/>
							<label for="last-name">Last Name </label>
							<input id="last-name" name="last_name" type="text" class="edit-txtbox" required/>
							<label for="contact-num">Contact Number</label>
			
							<input id="contact-num" name="contact_number" type="text" class="edit-txtbox" required/>
							<span class="error-message" id="contact-error"></span>
                            
							<label for="email">Email</label>
							<input id="email" name="email_address" type="email" class="edit-txtbox" required/>
                            <span class="error-message" id="email-error-register"></span>
                            <label for="password">New Password</label>
							<input id="password" name="password" type="password" class="edit-txtbox"/>
                            <span class="error-message" id="password-error-register"></span>
                            <label for="password">Confirm Password</label>
							<input id="confpass" name="confirm_password" type="password" class="edit-txtbox"/>
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
										Change picture
									</div>
								</div>
								<div id="cancel-btn">
									<i class="fas fa-times"></i>
								</div>
								<div class="file-name">
									File name here
								</div>
							</div>
							<button type="button" id="custom-btn">Choose a file</button>
							<input id="default-btn" name="image_name" type="file" accept="image/*" hidden>
						</div>
						
					</div>
					<div class="row saveNcancel">
						<div class="saveNcancel">
							<!-- <span id="save-btn" class="status save action-status">Save</span> -->
                            <button class="edtSaveChanges" type="submit" id="save-btn" name="edit_user">Save Changes</button>
                            </form>
							<span style="background-color:#0b2c3c;" id="cancl-btn" class=" status cancel action-status">Cancel</span>
						</div>
					</div>
					
				</div>
				
			</div>

			<!-- EDIT-DATA -->

		</main>
		<!-- MAIN -->
	</section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<?php if(isset($_GET['success']) && $_GET['success'] == 1){?>
		<script>
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
			const appendAlert = (message, type) => {
			const successWrapper = document.createElement('div')
			successWrapper.innerHTML = [
				`<div class="alert alert-${type} alert-dismissible" role="alert" style="width: 1000px; text-align: center;">`,
				`   <div>${message}</div>`,
				'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
				'</div>'
			].join('')

			alertPlaceholder.append(successWrapper)
			}
			appendAlert('You have successfully updated this user!', 'success');
		</script>
	<?php } ?>
	<?php if(isset($_GET['success']) && $_GET['success'] == 2){?>
		<script>
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
			const appendAlert = (message, type) => {
			const successWrapper = document.createElement('div')
			successWrapper.innerHTML = [
				`<div class="alert alert-${type} alert-dismissible" role="alert" style="width: 1000px; text-align: center;">`,
				`   <div>${message}</div>`,
				'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
				'</div>'
			].join('')

			alertPlaceholder.append(successWrapper)
			}
			appendAlert('You have successfully updated this user!', 'success');
		</script>
	<?php } ?>
	<?php if(isset($_GET['success']) && $_GET['success'] == 3){?>
		<script>
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
			const appendAlert = (message, type) => {
			const successWrapper = document.createElement('div')
			successWrapper.innerHTML = [
				`<div class="alert alert-${type} alert-dismissible" role="alert" style="width: 1000px; text-align: center;">`,
				`   <div>${message}</div>`,
				'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
				'</div>'
			].join('')

			alertPlaceholder.append(successWrapper)
			}
			appendAlert('You have successfully updated this user!', 'success');
		</script>
	<?php } ?>
	<?php if(isset($_GET['error']) && $_GET['error'] == 1){?>
		<script>
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
			const appendAlert = (message, type) => {
			const successWrapper = document.createElement('div')
			successWrapper.innerHTML = [
				`<div class="alert alert-${type} alert-dismissible" role="alert" style="width: 1000px; text-align: center;">`,
				`   <div>${message}</div>`,
				'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
				'</div>'
			].join('')

			alertPlaceholder.append(successWrapper)
			}
			appendAlert('You have successfully updated this user!', 'danger');
		</script>
	<?php } ?>
    <script>
        $(document).ready(function() {
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


//const editBtn = document.querySelector('.editbtn');
const editForm = document.getElementById('edit-form');
const dataTable = document.getElementById('data-table');

// editBtn.addEventListener('click', function() {
//   dataTable.style.display = 'none';
//   editForm.style.display = 'block';
// });


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

	<!-- CONTENT -->
	<!-- <script src="admin_script.js"></script> -->
</body>
</html>