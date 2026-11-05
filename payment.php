<?php
use Models\Payment;
include("init.php");
include("session.php");

$user_id = $_SESSION['user_id'];

$token = $_POST["stripeToken"];
$contact_name = $_POST["full_name"];
$email = $_POST["email"];
$amount = $_POST["total_fee"];
$property_id = $_POST["property_id"];
$desc = 'Reservation on ' . $_POST["property_name"];
$unit_data_array = $_POST['unitDataArray'];

$metadata = array(
    "Full Name" => $contact_name,
    "Email" => $email
);

foreach ($unit_data_array as $unit) {
    $unit_id = $unit['unit_id'];
    $unit_count = $unit['unit_count'];
    $unit_type = $unit['unit_type'];

    $unit_metadata = array(
        "Unit $unit_id" => $unit_id,
        "Number of Units" => $unit_count,
        "Unit Type" => $unit_type
    );

    $metadata = array_merge($metadata, $unit_metadata);
}

try {
    $charge = \Stripe\Charge::create([
        "amount" => str_replace(",", "", $amount) * 100,
        "currency" => 'php',
        "description" => $desc,
        "source" => $token,
        "metadata" => $metadata
    ]);

    $transaction_number = $charge->id;
    $payment_type = 'credit card';
    $payment = new Payment();
    $payment->setConnection($connection);
    $payment = $payment->recordPayment($user_id, $payment_type, $transaction_number);
    //echo "Charge ID: " . $chargeId;

} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>
