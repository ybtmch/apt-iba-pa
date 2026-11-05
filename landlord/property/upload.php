<?php 
use Models\Property;
use Models\Image;
include "../../init.php";
include ("../session.php");

try {
	if (isset($_POST['add_image'])) {
        $property_id = $_POST['property_id'];
        $imageData = $_FILES["images"];

        // Loop through the uploaded images
        for ($i = 0; $i < count($imageData['name']); $i++) {
            // Get the image properties
            $imageName = $imageData['name'][$i];
            $imageTmpName = $imageData['tmp_name'][$i];

            // Move the uploaded image to a directory on the server
            $uploadDirectory = "../../resources/images/properties/";
            $targetFilePath = $uploadDirectory . basename($imageName);
            move_uploaded_file($imageTmpName, $targetFilePath);

            $images = new Image();
            $images->setConnection($connection);
            $insert = $images->addImage($property_id, $imageName, 1);
            //var_dump($insert);
            if($insert){ 
                $statusMsg = "Images are uploaded successfully."; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }

        header("Location: view.php?property_id=" . $property_id);
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   