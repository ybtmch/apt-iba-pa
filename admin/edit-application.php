<?php
    use Models\Property;
    use Models\User;
    use Models\Request;
    include "../init.php";
    include ("session.php");

    if(isset($_POST['accept_application'])){
        try {
            $application_id = $_POST['application_id'];

            $application = new Request();
            $application->setConnection($connection);
            $request = $application->getRequest($application_id);

            $user_id = $request['user_id'];
            $property_id = $request['property_id'];
            $status = 1;
            $user_type = 1;

            $application = $application->editRequest($application_id, $user_id, $property_id, $status, $user_type);

            echo $application_id;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
?>