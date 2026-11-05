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
						<h2><b>Landlords</b></h2>
					</div>
					<div class="col-sm-6">	
                        <form method="POST" action="add.php">
                            <button class="btn btn-success" style="margin-top:10px;">Add New Landlord</button>
                        </form>				
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
			<form id="reserveForm" action="edit.php" method="POST">
				<label for="checkAll">Select All</label>
				<input type="checkbox" name="checkAll" id="checkAll" onchange="toggleSelectAll(this)">
				<span id="countSelected"></span><br>
				<button type="submit" name="confirm_reservation" id="confirm_reservation" onclick="return confirmMultiple()" disabled>Confirm</button>
				<button type="submit" name="decline_reservation" id="decline_reservation" onclick="return declineMultiple()" disabled>Decline</button>
				<thead>
					<tr>
                        <th scope="col">Property</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
						<th scope="col">Payment</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
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
				<td><input type="checkbox" id="reservation_id" value="<?php echo $list['reservation_id'] ?>"></td>
				
                <td><?php echo $list['property_name']?></td>
                <td><?php echo $room_type?></td>
                <td><?php echo $list['first_name'] . " " . $list['first_name']?></td>
				<td><?php echo $list['email']?></td>
                <td><?php echo $list['contact_number']?></td>
				<td><?php echo $payment_status?></td>
				<td><?php echo $get_status?></td>
				<td list="text-center">
					<button type="submit" name="confirm_reservation" id="confirm_single" onclick="return confirmSingle(<?= $reservation_id ?>)">Confirm</button>
					<button type="submit" name="decline_reservation" id="decline_single" onclick="return declineSingle(<?= $reservation_id ?>)">Decline</button>
				</td>
            </tr>
			
            <?php } ?>
			<input type="hidden" id="reservation" name="reservation_id">
			</form>
				</tbody>
			</table>
		</div>
	</div>        
</div>
</body>
<script>
	document.addEventListener("DOMContentLoaded", function() {
    var checkAllCheckbox = document.getElementById("checkAll");
    var reservationCheckboxes = document.querySelectorAll('input[type="checkbox"][id^="reservation_id"]');
    var confirmButtons = document.querySelectorAll('#confirm_reservation, #decline_reservation');
    var countSelectedSpan = document.getElementById("countSelected");

    function updateCountAndButtons() {
        var selectedCount = document.querySelectorAll('input[type="checkbox"][id^="reservation_id"]:checked').length;
        countSelectedSpan.textContent = (selectedCount === 0) ? "" : selectedCount + " selected";

        confirmButtons.forEach(function(button) {
            button.disabled = (selectedCount === 0);
        });

        checkAllCheckbox.checked = (selectedCount === reservationCheckboxes.length);
    }

    checkAllCheckbox.addEventListener("change", function() {
        var isChecked = checkAllCheckbox.checked;

        reservationCheckboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });

        updateCountAndButtons();
    });

    reservationCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            updateCountAndButtons();
        });
    });
});

</script>
<script>
	function confirmSingle(reservationId){
		var confirmButton = document.getElementById('confirm_single');
		var reservation = document.getElementById('reservation');

        reservation.value=reservationId;

		var userConfirmed = confirm("Confirm this reservation?");
		if (userConfirmed) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}
	
	function declineSingle(reservationId){
		var declineButton = document.getElementById('decline_single');
		var reservation = document.getElementById('reservation');

		reservation.value=reservationId;

		var userDeclined = confirm("Decline this reservation?");
		if (userDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

	function confirmMultiple(){
		var reservation = document.getElementById('reservation');
		var selected = document.getElementById('countSelected');
		var checkboxes = document.querySelectorAll('input[type="checkbox"][id="reservation_id"]:checked');
		var selectedValues = [];
		checkboxes.forEach(function(checkbox) {
			selectedValues.push(checkbox.value);
		});

		reservation.value = selectedValues;

		const multipleDeclined = confirm("Confirm "+ selected.textContent + " reservations?");
		if (multipleDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

	function declineMultiple(){
		var reservation = document.getElementById('reservation');
		var selected = document.getElementById('countSelected');
		var checkboxes = document.querySelectorAll('input[type="checkbox"][id="reservation_id"]:checked');
		var selectedValues = [];
		checkboxes.forEach(function(checkbox) {
			selectedValues.push(checkbox.value);
		});

		reservation.value = selectedValues;

		const multipleDeclined = confirm("Decline "+ selected.textContent + " reservations?");
		if (multipleDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

</script>

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