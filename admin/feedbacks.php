<?php
    use Models\Feedback;
    use Models\User;
    include "../init.php";
    include ("session.php");

    $feedbacks = new Feedback();
    $feedbacks->setConnection($connection);
    $feedbacks = $feedbacks->getFeedbacks();
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
					<h1>Feedbacks</h1>
				</div>
					
			</div>
			


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Feedbacks</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th scope="col">Feedback Id</th>
								<th scope="col">User</th>
								<th scope="col">Type</th>
								<th scope="col">Part</th>
								<th scope="col">Text</th>
								<th scope="col">Date</th>
                                <th scope="col">Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($feedbacks as $feedback){
                                    $feedback_id = $feedback['feedback_id'];
                                    $full_name = $feedback['first_name'] . ' ' . $feedback['last_name'];
                                    $feedback_type = $feedback['feedback_type'];
                                    $feedback_part = $feedback['feedback_part'];
                                    $feedback_text = $feedback['feedback_text'];
                                    $dateTimeObj = new DateTime($feedback['date']);
                                    $date = $dateTimeObj->format('F j, Y');
                                    $time = $dateTimeObj->format('g:i A');
							?>
							<tr>
								
								<td><p><?php echo $feedback_id?></p></td>
								<td><p><?php echo $full_name?></p></td>
								<td><p><?php echo $feedback_type?></p></td>
								<td><p><?php echo $feedback_part?></p></td>
                                <td><p><?php echo $feedback_text?></p></td>
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