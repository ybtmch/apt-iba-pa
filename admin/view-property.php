<?php
use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Unit;
use Models\Request;
use Models\User;
use Models\Auth;
use Models\Image;
use Models\UserImage;
use Models\Notification;
use Models\Availability;
include "../init.php";
include "session.php";
    
if(isset($_GET['property_id'])){
    $property_id = $_GET['property_id'];
    
} else {
    echo "<script>window.location.href='properties.php';</script>";
    exit();
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Form -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

  <!-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> -->

  <!-- Others -->
  <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
  <!-- <link href="css/property_enlist.css" rel="stylesheet" /> -->
  <link href="css/all.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- LeafletJS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<title>Properties</title>
    <!-- <script src="property_enlist.js"></script> -->
    <script src="add_images.js"></script>
</head>
<body>
<style>
    <?php //include('css/property_enlist.css')?>
</style>

	<!-- SIDEBAR -->
    <section id="sidebar" >

        <span class="image">
            <a href="index.php">
            <img src="../resources/images/aip_primary.png" class="sample" alt="logo">
            <img src="../resources/images/AipSingle.png" class="single" alt="logo">
        </a>
        </span>

        <ul class="side-menu top">
            <li>
                <a href="index.php">
                    <i class='bx bxs-dashboard icon'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="users.php">
                    <i class="bx bxs-group icon"></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
                <a href="landlords.php">
                    <i  class='bx bx-key icon'></i>
                    <span class="text">Landlords</span>
                </a>
            </li>
            <li class="active">
                <a href="properties.php">
                    <i class='bx bx-building-house icon' ></i>
                    <span class="text">Properties</span>
                </a>
            </li>
            <li>
                <a href="applications.php">
                    <i class='bx bx-file icon' ></i>
                    <span class="text">Application<br> Requests</span>
                </a>
            </li>
            <li>
                <a href="logs.php">
                    <i class='bx bx-file icon' ></i>
                    <span class="text">Logs</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php //include('navbar.php');?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Properties</h1>
				</div>
			</div>
			<div style="text-align: left; width: 80%;">
            <?php include('edit-property.php'); ?>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<!-- <script src="admin_script.js"></script> -->
</body>
</html>