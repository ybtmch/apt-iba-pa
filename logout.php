<?php   
use Models\Log;
include ("init.php");
session_start(); //to ensure you are using same session
$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];

$log_description = $first_name . ' ' . $last_name . ' has logged out';
$action = 'logout';
// $log = new Log();
// $log->setConnection($connection);
// $log->addToLog($user_id, $action, $log_description);

session_destroy(); //destroy the session
header("location:index"); //to redirect back to "index.php" after logging out

?>