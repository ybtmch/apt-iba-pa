<?php
    use Models\Log;
    use Models\User;
    include "../init.php";
    include ("session.php");

    $logs = new Log();
    $logs->setConnection($connection);
    $logs = $logs->getLogs();
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

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
    
	<title>AIP ADMIN</title>
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
					<h1>Logs</h1>
				</div>
					
			</div>
			


			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; " class="table-data">
				<div class="order">
					<div class="head">
						<h3>Logs</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th scope="col">Log Id</th>
								<th scope="col">User</th>
								<th scope="col">Action</th>
								<th scope="col">Description</th>
								<th scope="col">Date</th>
								<th scope="col">Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($logs as $log){
                                    $log_id = $log['log_id'];
                                    $full_name = $log['first_name'] . ' ' . $log['last_name'];
                                    $action = $log['action'];
                                    $description = $log['description'];
                                    $dateTimeObj = new DateTime($log['date_time']);
                                    $date = $dateTimeObj->format('F j, Y');
                                    $time = $dateTimeObj->format('g:i A');
							?>
							<tr>
								
								<td><p><?php echo $log_id?></p></td>
								<td><p><?php echo $full_name?></p></td>
								<td><p><?php echo $action?></p></td>
								<td><p><?php echo $description?></p></td>
								<td><p><?php echo $date?></p></td>
								<td><p><?php echo $time?></p></td>

	
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


</body>
</html>