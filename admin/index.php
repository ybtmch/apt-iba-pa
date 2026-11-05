<?php 
use Models\User;
use Models\Request;
use Models\Log;
use Models\Property;
use Models\Feedback;
use Models\Faq;
use Models\Review;

include ("../init.php");
include ("session.php");

$user_list = new User();
$user_list->setConnection($connection);
$user_list = $user_list->getUsers();

$total_users = count($user_list);

$landlord_list = new User();
$landlord_list->setConnection($connection);
$landlord_list = $landlord_list->getLandlords();

$total_landlords = count($landlord_list);

$properties_list = new Property();
$properties_list->setConnection($connection);
$properties_list = $properties_list->getProperties();

$total_properties = count($properties_list);

$requests_list = new Request();
$requests_list->setConnection($connection);
$requests_list = $requests_list->getAllRequests();

$total_requests = count($requests_list);

$logs_list = new Log();
$logs_list->setConnection($connection);
$logs_list = $logs_list->getLogs();

$total_logs = count($logs_list);

$feedback_list = new Feedback();
$feedback_list->setConnection($connection);
$feedback_list = $feedback_list->getFeedbacks();

$total_feedbacks = count($feedback_list);

$review = new Review();
    $review->setConnection($connection);
    $reviews = $review->getAllReviews();

	$total_reviews = count($reviews);

    $faq = new Faq();
    $faq->setConnection($connection);
    $faqs = $faq->getFaqs();
	$total_faqs = count($reviews);
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

	<title>Apt Iba Pa | Admin</title>

	<link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
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
		<main style="overflow-y:scroll; max-height:900px; scrollbar-width:none; " class="table-data">
			<div class="head-title">
				<div class="left">
					<h1>Admin Dashboard</h1>
				</div>
			</div>

			<ul class="box-info">
				<a href="users.php">
					<li >
					<img src="../resources/images/useradmin.png" />
						<span class="text">
							<h3><?= $total_users ?></h3>
							<p>Users</p>
						</span>

					</li>
				</a>
				
				<a href="landlords.php">
					<li >
					<img src="../resources/images/landlordadmin.png" />
						<span class="text">
							<h3><?= $total_landlords ?></h3>
							<p>Landlords</p>
						</span>

					</li>
				</a>
				
			</ul>
			<ul class="box-info">
				<a href="properties.php">
					<li >
					<img src="../resources/images/propertyadmin.png" />
						<span class="text">
							<h3><?= $total_properties ?></h3>
							<p>Properties</p>
						</span>

					</li>
				</a>
				
				<a href="applications.php">
					<li>
					<img src="../resources/images/applicationadmin.png" />
						<span class="text">
							<h3><?= $total_requests ?></h3>
							<p>Application Request</p>
						</span>

					</li>
				</a>
            </ul>
            <ul class="box-info">
                <a href="logs.php">
					<li>
					<img src="../resources/images/logsadmin.png" />
						<span class="text">
							<h3><?= $total_logs ?></h3>
							<p>Logs</p>
						</span>

					</li>
				</a>
                <a href="reviews.php">
					<li>
					<img src="../resources/images/reviewadmin.png" />
						<span class="text">
							<h3><?= $total_reviews ?></h3>
							<p>Reviews</p>
						</span>

					</li>
				</a>
			</ul>
			<ul class="box-info">
                <a href="faqs.php">
					<li>
					<img src="../resources/images/faqsadmin.png" />
						<span class="text">
							<h3><?= $total_faqs ?></h3>
							<p>FAQs</p>
						</span>

					</li>
				</a>
                <a href="feedbacks.php">
					<li>
					<img src="../resources/images/feedbackadmin.png" />
						<span class="text">
							<h3><?= $total_feedbacks ?></h3>
							<p>Feedback</p>
						</span>

					</li>
				</a>
			</ul>

			<div style="margin-top:100px;">
				<div class="order">
					<div class="head">
						<h3>Property Reservation Ranking</h3>
					</div>
                    <div>
                        <label for="monthSelector">Select a Month:</label>
                        <input type="month" id="monthSelector" name="monthSelector" value="<?php echo date('Y-m'); ?>">
                    </div>
                    <div>
                        <label class="tick">Claro M. Recto<input type="checkbox" name="barangay[]" value="Claro M. Recto"><span class="check"></span> 
                        </label>  
                        <label class="tick">Lourdes Sur East<input type="checkbox" name="barangay[]" value="Lourdes Sur East"><span class="check"></span> 
                        </label>
                        <label class="tick">Salapungan<input type="checkbox" name="barangay[]" value="Salapungan"><span class="check"></span> 
                        </label>
                    </div>
                    <div id="property-stats">
					
                    </div>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            getPropertyStats({selected_month: <?php echo date('Y-m')?>});

            document.getElementById('monthSelector').addEventListener('input', function() {
                var selectedMonth = this.value;
                getPropertyStats({selected_month: selectedMonth});
            });

            $('input[name="barangay[]"], input[id="monthSelector"]').on('change', function () {
                getPropertyStats({
                    barangay: $('input[name="barangay[]"]:checked').map(function () {
                        return $(this).val();
                    }).get(),
                    selected_month: $('input[id="monthSelector"]').val()
                });
            });

            performAjax({
                barangay: $('input[name="monthSelector"]').val(),
                selected_month: $('input[name="barangay[]"]:checked').map(function () {
                    return $(this).val();
                }).get()
            }); 

            function getPropertyStats(data) {
                $.ajax({
                    url: 'property-stats',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        $('#property-stats').html(response);
                    }
                });
            }

            // function getPropertyStats(selectedMonth) {
            //     $.ajax({
            //         type: 'POST',
            //         url: 'property-stats',
            //         data: { selected_month: selectedMonth },
            //         success: function(data) {
            //             $('#property-stats').html(data);
            //         },
            //         error: function() {
            //             alert('Failed to get monthly statistics.');
            //         }
            //     });
            // }

            // function getBarangay(data) {
            //     $.ajax({
            //         url: 'property-stats',
            //         type: 'POST',
            //         data: data,
            //         success: function(data) {
            //             $('#property-stats').html(data);
            //         },
            //         error: function() {
            //             alert('Failed to get monthly statistics.');
            //         }
            //     });
            // }
        });
  </script>
    


    <script src="admin_script.js"></script>
</body>
</html>