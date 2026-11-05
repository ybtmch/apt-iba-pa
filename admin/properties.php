<?php
    use Models\Property;
    use Models\User;
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

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
	<title>Apt Iba Pa | Admin</title>
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
					<h1>Properties</h1>
				</div>
                <a href="apply-property" class="btn-add">
                    <span class="text">Add</span>
                </a>
			</div>
			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; " class="table-data">
				<div class="order">
					<div class="head">
						<h3>Property List</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>Property ID</th>
								<th>Property Name</th>
								<th>Landlord</th>
								<th>Street Address</th>
								<th>Barangay</th>
                                <th>Total Units</th>
                                <th>Occupied Units</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                $property = new Property();
                                $property->setConnection($connection);
                                $properties = array_reverse($property->getProperties());
                                
                                foreach($properties as $property){
                                    if($property['status']===1){
                                        $status = 'Active';
                                    } else if ($property['status']===2){
                                        $status = 'Pending';
                                    }
                                    $property_id = $property['property_id'];
                                    $property_name = $property['property_name'];
                                    $full_name = $property['first_name'] . ' ' . $property['last_name'];
                                    $street_address = $property['property_number'] .' '. $property['street'];
                                    $barangay = $property['barangay'];
                                    $total_units = $property['total_units'];
                                    $occupied_units = $property['occupied_units'];
                            ?>
							<tr>
								<td>
                                    <?php echo $property_id ?>
								</td>
								<td><p><a href="view?property_id=<?php echo $property_id ?>"><?php echo $property_name ?></a></p></td>
								<td><p><?php echo $full_name ?></p></td>
								<td><p><?php echo $street_address ?></p></td>
								<td><p><?php echo $barangay ?></p></td>
                                <td><p><?php echo $total_units ?></p></td>
                                <td><p><?php echo $occupied_units ?></p></td>
								<td><span class="status completed"><?php echo $status?></span></td>
								<td><a href="view.php?property_id=<?php echo $property_id ?>"><i class='editbtn bx bx-edit' ></i></a><a href="delete.php?property_id=<?php echo $property_id ?>"><i class='trash bx bx-trash' ></i></a></td>
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
</body>
</html>