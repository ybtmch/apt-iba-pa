<?php
    use Models\Property;
    use Models\User;
    use Models\Request;
    include "../init.php";
    include ("session.php");
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
	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
					<h1>Application Request</h1>
				</div>
					
			</div>

			


			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; " class="table-data">
				<div class="order">
					<div class="head">
						<h3>Application Request List</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th scope="col">Application Id</th>
								<th scope="col">Name of Applicant</th>
								<th scope="col">Property</th>
								<th scope="col">Type of Property</th>
								<th scope="col">Contact Number</th>
								<th scope="col">Email</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$requests = new Request();
								$requests->setConnection($connection);
								$requests = array_reverse($requests->getAllRequests());
								foreach($requests as $request){
									$full_name = $request['first_name'] . ' ' . $request['last_name'];
									$application_id = $request['application_id'];
									$property_name = $request['property_name'];
									$property_type = $request['property_type'];
									$contact_number = $request['contact_number'];
									$email = $request['email'];
									$status = $request['status'];
                                    if($status==1){
                                        $show_status = 'Accepted';
                                    }elseif($status==2){
                                        $show_status = 'Pending';
                                    }elseif($status==3){
                                        $show_status = 'Declined';
                                    }
							?>
							<tr>
								
								<td><p><?php echo $application_id?></p></td>
								<td><p><?php echo $full_name?></p></td>
								<td><p><?php echo $property_name?></p></td>
								<td><p><?php echo $property_type?></p></td>
								<td><p><?php echo $contact_number?></p></td>
								<td><p><?php echo $email?></p></td>
								<td><span id="statusSpan_<?php echo $application_id?>" class="status completed"><?php echo $show_status?></span></td>
								<td>
                                <a><?php if($status==1 || $status==3){?><?php } else{ ?><i class='editbtn bx bx-check-circle' href="" data-application-id="<?php echo $application_id ?>"></i><?php } ?></a>
                                
                                    <i class='trash bx bx-trash' ></i>
                                </td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="admin_script.js"></script>

<!-- Script for Delete Image -->
<script>
$(document).ready(function() {

    $('.editbtn').on('click', function(event) {
        event.preventDefault(); 

        var applicationId = $(this).data('application-id');
        var result = window.confirm("Accept this property application?");

        if (result) {
            editApplication({
                application_id: applicationId,
                accept_application: 1
            });
        }
    });

    function editApplication(data) {
        $.ajax({
            url: 'edit-application',
            type: 'POST',
            data: data,
            success: function (response) {
                alert('Property application accepted.');
                $('#statusSpan_' + response).text('Accepted');
            }
        });
    }
});
</script>

</body>
</html>