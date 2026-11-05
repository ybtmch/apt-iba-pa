<?php
use Models\Auth;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include ("init.php");
include ("session.php");

$mail = new PHPMailer;

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $user = new Auth();
    $user->setConnection($connection);
    $user = $user->login($email);

    
    if ($user) {
        $user_id = $user['user_id'];
        $token = bin2hex(random_bytes(32));
        $reset_link = "aptibapa.site/reset-password?token=$token&id=$user_id";

        $reset_token = new Auth();
        $reset_token->setConnection($connection);
        $reset_token = $reset_token->resetToken($user_id, $token);

        // You should use a proper email library to send emails, like PHPMailer or similar
        //$subject = "Password Reset";
        $message = "To reset your password, click on the following link:\n\n$reset_link";
        //mail($email, $subject, $message);

        $mail = new PHPMailer();

        $mail->isSMTP(); 

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;

        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('aptibapa@gmail.com', 'Apt Iba Pa');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Password Link';
        $mail->Body    = "To reset your password, click on the following link:\n\n$reset_link";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        if ($mail->send()) {
            echo 'Email sent successfully!';
        } else {
            echo 'Email sending failed: ' . $mail->ErrorInfo; 
        }   
    } else {
        echo "Email not found.";
    }
    //echo "Password reset link sent to your email.";
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style-fp.css" />
    
</head>
<body>

    <div class="wrapper">
        <div class="container">
            <div class="title-section">
                <h2 class="title">
                    Reset Password
                </h2>
                <p class="para">Once you provide your email, we'll send you a secure link to reset your password.</p>
            </div>

            <form method="POST" action="forgot-password">
            <div class="input-group">
                <label for="" class="label-title"> Enter Your email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <span class="icon">&#9993;</span>
            </div>

            <div class="input-group">
                <button class="submit-btn" type="submit">Send Reset Email</button>
            </div>
           </form>
        </div>
    </div>
    
</body>
</html>