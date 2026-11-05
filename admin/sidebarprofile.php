<?php
include('../init.php');

$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$currentFile = end($parts);

$pages = array(
    "index.php" => array("Dashboard", "bx bxs-dashboard"),
    "users.php" => array("Users", "bx bxs-group"),
    "landlords.php" => array("Landlords", "bx bx-key"),
    "properties.php" => array("Properties", "bx bx-building-house"),
    "applications.php" => array("Application<br>Requests", "bx bx-file"),
    "reviews.php" => array("Reviews", "bx bx-file"),
    "faqs.php" => array("FAQs", "bx bx-file"),
    "logs.php" => array("Logs", "bx bx-file")
);

// Add special cases for pages "add-user.php" and "add-landlords.php"
if ($currentFile === "add-user.php") {
    $currentFile = 'users.php';
} elseif ($currentFile === "add-landlord.php") {
    $currentFile = 'landlords.php';
}
?>
    
    
    <!-- SIDEBAR -->
	<section id="sidebar" >

		<span class="image">
			<a href="index">
			<img src="../resources/images/aip_primary.png" class="sample" alt="logo">
			<img src="../resources/images/AipSingle.png" class="single" alt="logo">
		</a>
		</span>

		<ul class="side-menu top">
            <?php
            foreach ($pages as $url => $data) {
                $pageTitle = $data[0];
                $iconClass = $data[1];
                $isActive = ($currentFile === $url) ? 'active' : '';

                echo "<li style='margin-left:-14px;' class='$isActive'>
                        <a href='$url'>
                            <i class='$iconClass icon'></i>
                            <span class='text'>$pageTitle</span>
                        </a>
                    </li>";
            }
            ?>
        </ul>
	</section>
	<!-- SIDEBAR -->