<?php
    use Models\User;
    use Models\Faq;
    include "../init.php";
    include ("session.php");

    if(isset($_POST['add_faq'])){
        try {
            $question = $_POST['question'];
            $answer = $_POST['answer'];
            $status = 1;

            $faq = new Faq();
            $faq->setConnection($connection);
            $faq = $faq->addFaq($question, $answer, $status);

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    } 
    elseif(isset($_POST['edit_faq'])){
        try {
            $faq_id = $_POST['faq_id'];
            $question = $_POST['question'];
            $answer = $_POST['answer'];

            $faq = new Faq();
            $faq->setConnection($connection);
            $faq = $faq->updateFaq($faq_id, $question, $answer);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
    elseif(isset($_POST['delete_faq'])){
        try {
            $faq_id = $_POST['faq_id'];
            $status = 0;

            $faq = new Faq();
            $faq->setConnection($connection);
            $faq = $faq->deleteFaq($faq_id, $status);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
?>