<?php
    use Models\Image;

    include "../init.php";
    include "session.php";

    if(isset($_POST['add_image'])){
        try {
            $property_id = $_POST['property_id'];
            $image_title = $_POST['image_title'];
            $status = 1;
            
            $add_image = new Image();
            $add_image->setConnection($connection);
            if(isset($_POST['set_thumbnail']) && $_POST['set_thumbnail'] == 1){
                $thumbnail = 1;
                $add_image->removeThumbnail($property_id);
            } else {
                $thumbnail = 0;
            }
            if(isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['new_image'];
                $image_name = $image['name'];
                $image_temp = $image['tmp_name'];
            
                $uploadDirectory = "../resources/images/properties/";
                $targetFilePath = $uploadDirectory . basename($image_name);
                
                // Move uploaded image to directory
                if (move_uploaded_file($image_temp, $targetFilePath)) {
                    // Check if the uploaded file is an image
                    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                    $detected_type = exif_imagetype($targetFilePath);
            
                    if (in_array($detected_type, $allowed_types)) {
                        // Create an image from the uploaded file
                        $image = imagecreatefromstring(file_get_contents($targetFilePath));
            
                        // Convert the image to WebP format
                        $image_name = pathinfo($image_name, PATHINFO_FILENAME) . '.webp';
                        $outputFilePath = $uploadDirectory . $image_name;
                        
                        imagewebp($image, $outputFilePath);
            
                        $add_image = $add_image->addImage($property_id, $image_name, $image_title, $thumbnail, $status);
                        
                        unlink($targetFilePath);

                        echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
                        exit();
            
                        // The WebP file is now created and stored in $outputFilePath
                    } else {
                        echo "Unsupported image format. Please upload a PNG, JPEG, or GIF.";
                    }
                } else {
                    echo "Error moving file to directory.";
                }
            } else {
                echo "Error uploading file.";
            }
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
    }


        
    }
    if(isset($_POST['update_image']) && isset($_POST['image_id']))
    {
        try {
            $property_id = $_POST['property_id'];
            $image_id = $_POST['image_id'];
            $image_title = $_POST['image_title'];
            $update_image = new Image();
            $update_image->setConnection($connection);
            $old_image = $update_image->getImage($image_id, $property_id);
            $update_image->updateImageTitle($image_id, $property_id, $image_title);
            
            if(($_FILES['new_image']['name']) != '') {
            $image_file = $_FILES['new_image'];
            $image_name = $image_file['name'];
            $image_temp = $image_file['tmp_name'];
            $remove_image = $old_image['image_path'];
            
            $image_directory = "../resources/images/properties/";
            $files = glob($image_directory . "*");

            foreach ($files as $file) {
                if (strpos($file, $remove_image) !== false) {
                    unlink($file);
            
                    $target_path = $image_directory . basename($image_name);
                    move_uploaded_file($image_temp, $target_path);
                    break;
                }
            }

            $update_image->updateImage($image_id, $property_id, $image_name);
            }

            if(isset($_POST['set_thumbnail'])){
                $thumbnail = 1;
                $update_image->removeThumbnail($property_id);
                $update_image->setThumbnail($image_id, $property_id, $thumbnail);
            }

            echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
            exit();

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    if(isset($_POST['delete_image'])){
        try {
            $property_id = $_POST['property_id'];
            $image_id = $_POST['image_id'];

            var_dump($property_id, $image_id);
            
            $update_image = new Image();
            $update_image->setConnection($connection);
            $old_image = $update_image->getImage($image_id, $property_id);
            $remove_image = $old_image['image_path'];

            $image_directory = "../resources/images/properties/";
            $files = glob($image_directory . "*");

            foreach ($files as $file) {
                if (strpos($file, $remove_image) !== false) {
                    unlink($file);
                    break;
                }
            }

            $update_image->deleteImage($image_id, $property_id);

            echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
            exit();
            
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
?>