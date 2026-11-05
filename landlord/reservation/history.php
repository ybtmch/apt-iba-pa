<?php
use Models\Reservation;
include "../../init.php";
//include ("../../session.php");
$user_id = 4;

$reservation = new Reservation('', '', '', '','');
$reservation->setConnection($connection);
$reservationList = $reservation->getPropertyReservations($user_id);
?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Property Reservation</title>

</head>
<body>

<nav>
<div class="container-fluid">
<nav>
  <ul class="nav nav-pills nav-justified">
    <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="../property/index.php">Properties</a></li>
    <li style="background-color: #FFFAF0"><a  href="../appointment/index.php">Appointments</a></li>
    <li class="active" style="background-color: #FFFACD"><a  href="index.php">Reservations</a></li>
    <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
  </ul>
  <a href="../../logout.php">Logout</a>
  </nav>


<div class="container-xl">
	<div class="table table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Reservation History</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th scope="col">Property</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
						<th scope="col">Payment</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//var_dump($reservationList);
                    foreach($reservationList as $list){
						$reservation_id = $list['reservation_id'];
						$room = $list['total_beds'];
							if($room===1){
								$room_type = "Single Room";
							} elseif($room===2) {
								$room_type = "Double Room";
							} elseif($room===3) {
								$room_type = "Triple Room";
							} elseif($room===4) {
								$room_type = "Quad Room";
							} elseif($room===5) {
								$room_type = "5-Bed Room";
							} elseif($room===6) {
								$room_type = "6-Bed Room";
							} elseif($room===7) {
								$room_type = "7-Bed Room";
							} elseif($room===8) {
								$room_type = "8-Bed Room";
							}
						$payment = $list['payment_status'];
							if($payment===1){
								$payment_status="Paid";
							}else{
								$payment_status="Unpaid";
							}
						$status = $list['status'];
							if($status===1){
								$get_status = "Accepted";
							}elseif($status===2){
								$get_status = "Pending";
							}elseif($status===3){
								$get_status = "Declined";
							}else{
								$get_status = "Deleted";
							}

                ?>
            <tr>
                <td><?php echo $list['property_name']?></td>
                <td><?php echo $room_type?></td>
                <td><?php echo $list['first_name'] . " " . $list['first_name']?></td>
				<td><?php echo $list['email']?></td>
                <td><?php echo $list['contact_number']?></td>
				<td><?php echo $payment_status?></td>
				<td><?php echo $get_status?></td>
            </tr>
			
            <?php } ?>
				</tbody>
			</table>
		</div>
	</div>        
</div>
                        </body>

<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 100px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
</style>
</html>