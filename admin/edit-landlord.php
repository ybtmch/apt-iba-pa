<?php
    use Models\User;
    use Models\Auth;
    use Models\Log;
    use Models\UserImage;
    include "../init.php";
    include ("session.php");
    
    if(isset($_POST['add_landlord'])){
        $first_name = ucfirst($_POST['first_name']);
        $last_name = ucfirst($_POST['last_name']);
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);
        $status = 1;

        $register_user = new Auth();
        $register_user->setConnection($connection);
        $register_user = $register_user->registerUser($email, $hashedPassword, $salt, $status);
        
        $user_auth = $register_user['statement'] ?? null;
        $user_id = $register_user['lastInsertedId'] ?? null;

        $register_info = new User();
        $register_info->setConnection($connection);
        $register_info->addLandlord($user_id, $first_name, $last_name, $contact_number, $status);

        if(isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
            $updated_image = $_FILES['image_name'];
            $updated_image_name = $updated_image['name'];
            $updated_image_temp = $updated_image['tmp_name'];
        
            $uploadDirectory = "../resources/images/landlords/";
            $targetFilePath = $uploadDirectory . basename($updated_image_name);
            
            if (move_uploaded_file($updated_image_temp, $targetFilePath)) {
                $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detected_type = exif_imagetype($targetFilePath);
        
                if (in_array($detected_type, $allowed_types)) {
                    $image = imagecreatefromstring(file_get_contents($targetFilePath));
        
                    $updated_image_name = pathinfo($updated_image_name, PATHINFO_FILENAME) . '.webp';
                    $outputFilePath = $uploadDirectory . $updated_image_name;
                    
                    imagewebp($image, $outputFilePath);
        
                    $status = 1;
                    $user_image = new UserImage();
                    $user_image->setConnection($connection);
                    $user_image = $user_image->addImage($user_id, $updated_image_name, $status);
                    
                    unlink($targetFilePath);
        
                } else {
                    echo "Unsupported image format. Please upload a PNG, JPEG, or GIF.";
                }
            } else {
                echo "Error moving file to directory.";
            }
        } else {
            echo "Error uploading file.";
        }

        $log_description = 'An account has been created for ' . $first_name . ' ' . $last_name . ' using ' . $email;
        $action = 'register';
        $log = new Log();
        $log->setConnection($connection);
        $log->addToLog($user_id, $action, $log_description);

        echo '<script>alert("Successfully added a landlord.");</script>';
        echo '<script>window.location.href="landlord"</script>';
        exit();
    } 
    
    elseif(isset($_POST['edit_landlord'])){
        $user_id = $_POST['user_id'];
        $updated_first_name = $_POST['first_name'];
        $updated_last_name = $_POST['last_name'];
        $updated_contact_number = $_POST['contact_number'];

        $user_information = new User();
        $user_information->setConnection($connection);
        $check_image = $user_information->getById($user_id);
        $image_exists = $check_image['image_name'] ?? NULL;

        $user_information->updateUser($user_id, $updated_first_name, $updated_last_name, $updated_contact_number);

        $updated_email = $_POST['email_address'];

        $user = new Auth();
        $user->setConnection($connection);
        $user->updateEmail($user_id, $updated_email);

        if($_POST['password'] != NULL){
        $updated_password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $updated_password . $salt);

        $user->updatePassword($user_id, $hashedPassword, $salt);
        }

        if(isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
            $updated_image = $_FILES['image_name'];
            $updated_image_name = $updated_image['name'];
            $updated_image_temp = $updated_image['tmp_name'];
        
            $uploadDirectory = "../resources/images/landlords/";
            $targetFilePath = $uploadDirectory . basename($updated_image_name);
            
            if (move_uploaded_file($updated_image_temp, $targetFilePath)) {
                $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detected_type = exif_imagetype($targetFilePath);
        
                if (in_array($detected_type, $allowed_types)) {
                    $image = imagecreatefromstring(file_get_contents($targetFilePath));
        
                    $updated_image_name = pathinfo($updated_image_name, PATHINFO_FILENAME) . '.webp';
                    $outputFilePath = $uploadDirectory . $updated_image_name;
                    
                    imagewebp($image, $outputFilePath);
        
                    if($image_exists){
                        $user_image = new UserImage();
                        $user_image->setConnection($connection);
                        $user_image = $user_image->updateImage($user_id, $updated_image_name);
                    } else {
                        $status = 1;
                        $user_image = new UserImage();
                        $user_image->setConnection($connection);
                        $user_image = $user_image->addImage($user_id, $updated_image_name, $status);
                    }
                    
                    unlink($targetFilePath);
        
                } else {
                    echo "Unsupported image format. Please upload a PNG, JPEG, or GIF.";
                }
            } else {
                echo "Error moving file to directory.";
            }
        } else {
            echo "Error uploading file.";
        }

        echo '<script>alert("Updated Successfully.");</script>';
        echo '<script>window.location.href="landlords.php"</script>';
        exit();
    }
    elseif(isset($_POST['delete_landlord'])){
        $user_id = $_POST['user_id'];

        $user = new User();
        $user->setConnection($connection);
        $user = $user->deleteUser($user_id);

        $auth = new Auth();
        $auth->setConnection($connection);
        $auth = $auth->deleteAccount($user_id);

        $image = new UserImage();
        $image->setConnection($connection);
        $user->deleteImage($user_id);

        if($user && $auth){
            echo '<script>alert("Deleted landlord successfully.");</script>';
            echo '<script>window.location.href="landlords.php"</script>';
            exit();
        } else {
            echo '<script>alert("Failed to delete landlord.");</script>';
            echo '<script>window.location.href="landlords.php"</script>';
            exit();
        }
    }

    else {
        echo "<script>window.location.href='add-landlord';</script>";
        exit();
    }
?>