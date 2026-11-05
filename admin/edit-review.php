<?php
    use Models\User;
    use Models\Review;
    include "../init.php";
    include ("session.php");

    if(isset($_POST['delete_review'])){
        try {
            $review_id = $_POST['review_id'];

            $review = new Review();
            $review->setConnection($connection);
            $reviews = $review->deleteReview($review_id);
            echo $reviews;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
