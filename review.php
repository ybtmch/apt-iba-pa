<?php
use Models\Review;
include ("init.php");
include ("session.php");

if(!isset($user_id)){
    header('location: index.php');
    exit();
}
    

$file = fopen('bad-words.csv', 'r');
$profanityList = array();

while (($data = fgetcsv($file)) !== false) {
    $profanityList[] = $data[0];
}

fclose($file);

try {
     if(isset($_POST['recaptcha_token'], $_POST['rating'], $_POST['description'])){
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        $user_id = $_SESSION['user_id'];
        $property_id = $_SESSION['property_view_id'];
        $status = 1;

        $recaptchaSecret = '6LfiFwwpAAAAACIutHGeDqoo7mxUSgecoDGnHA6i'; 
        $recaptchaResponse = $_POST['recaptcha_token'];

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
    
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);

        if ($captcha_success->success) {
            $containsProfanity = false;

            foreach ($profanityList as $profanity) {
                if (stripos($description, $profanity) !== false) {
                    $containsProfanity = true;
                    break;
                }
            }

            if (!$containsProfanity) {
                $review = new Review();
                $review->setConnection($connection);
                $review = $review->addReview($rating, $description, $user_id, $property_id, $status);

                echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
                exit();
            } else {
                echo "<script>alert('Due to a malicious word found in your review, it was not accepted.')</script>";
                echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
                exit();
            }
        } else {
            echo "<script>alert('CAPTCHA verification failed. Please confirm you are not a robot.')</script>";
            echo "<script>window.location.href='view.php?property_id=$property_id';</script>";
            exit();
        }

        

     }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

?>

<script src="https://www.google.com/recaptcha/api.js?render=6Le9PfYoAAAAAI_5McJkqP4upFY6a7CG1GNUa-St"></script>