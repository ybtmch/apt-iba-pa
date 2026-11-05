<?php
    use Models\Review;
    include "../init.php";
    include ("session.php");

    $review = new Review();
    $review->setConnection($connection);
    $reviews = $review->getAllReviews();
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

<?php include ('sidebar.php'); ?>



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include('navbar.php');?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Reviews</h1>
				</div>
			</div>

			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; "  id="data-table" class="table-data">
				<div class="order">
					<div class="head">
						<h3>Review List</h3>
						
					</div>
					<table>
						<thead>
							<tr>
                                <th>ID</th>
                                <th>Property</th>
                                <th>Full Name</th>
								<th>Rating</th>
								<th>Description</th>
								<th>Date</th>
                                <th>Time</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                foreach($reviews as $review){
                                    $review_id = $review['review_id'];
                                    $property_name = $review['property_name'];
                                    $full_name = $review['first_name'] . ' ' . $review['last_name'];
                                    $rating = $review['rating'];
                                    $description = $review['description'];
                                    $review_date = $review['review_date'];
                                    $dateTimeObj = new DateTime($review['review_date']);
                                    $date = $dateTimeObj->format('F j, Y');
                                    $time = $dateTimeObj->format('g:i A');
                            ?>
                            <input type="hidden" id="property-id" value="<?php echo $review['property_id'] ?>">
							<tr>
								<td><p><?php echo $review_id?></p></td>
								<td><p><?php echo $property_name ?></p></td>
								<td><p><?php echo $full_name ?></p></td>
                                <td><p><?php echo $rating ?></p></td>
                                <td><p><?php echo $description ?></p></td>
                                <td><p><?php echo $date ?></p></td>
                                <td><p><?php echo $time ?></p></td>
								<td>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.trash').click(function(){
                var row = $(this).closest('tr');
                var reviewId = row.find('td:nth-child(1) p').text();
                var result = window.confirm("Are you sure you want to delete this review?");

                if (result) {
                    deleteReview({
                        delete_review: 1,
                        review_id: reviewId
                    });
                }
            });

            function deleteReview(data) {
                $.ajax({
                    url: 'edit-review',
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