<?php
use Models\Feedback;
include ("init.php");
include ("session.php");

if(isset($_POST['send_feedback'])){
    try {
        $feedback_type = $_POST['feedback_type'];
        if($feedback_type==1){
            $feedback_type = 'Feedback';
        }elseif($feedback_type==2){
            $feedback_type = 'Feature';
        }elseif($feedback_type==3){
            $feedback_type = 'Bug';
        }
        $feedback_part = $_POST['feedback_part'];
        if($feedback_part==1){
            $feedback_part = 'Tenant';
            $feedback_page = $_POST['feedback_page'];
            if($feedback_page==1){
                $feedback_page = 'Dashboard';
            }elseif($feedback_page==2){
                $feedback_page = 'Accommodation';
            }elseif($feedback_page==3){
                $feedback_page = 'Wishlist';
            }elseif($feedback_page==4){
                $feedback_page = 'Appointment';
            }elseif($feedback_page==5){
                $feedback_page = 'Reservation';
            }elseif($feedback_page==6){
                $feedback_page = 'Transaction';
            }elseif($feedback_page==7){
                $feedback_page = 'Profile';
            }
        }elseif($feedback_part==2){
            $feedback_part = 'Landlord';

            $feedback_page = $_POST['feedback_page'];
            if($feedback_page==1){
                $feedback_page = 'Dashboard';
            }elseif($feedback_page==2){
                $feedback_page = 'Properties';
            }elseif($feedback_page==3){
                $feedback_page = 'FAQs';
            }elseif($feedback_page==4){
                $feedback_page = 'Appointment';
            }elseif($feedback_page==5){
                $feedback_page = 'Reservation';
            }elseif($feedback_page==6){
                $feedback_page = 'Transaction';
            }elseif($feedback_page==7){
                $feedback_page = 'Profile';
            }
        }

        $feedback_text = $_POST['feedback_text'];
        $status = 1;

        $feedback = new Feedback();
        $feedback->setConnection($connection);
        $feedback = $feedback->sendFeedback($user_id, $feedback_type,  $feedback_part, $feedback_page, $feedback_text, $status);

        if($feedback){
            echo '<script>alert("Your feedback has been sent. Thank you"); window.location.href="contactUs"</script>';
            exit();
        }
    } catch (Exception $e) {
        echo 'An error occurred: ' . $e->getMessage();
    }
}
?>