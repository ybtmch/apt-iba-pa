<?php
use Models\Auth;

include ("init.php");
include ("session.php");

try {
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['password'];

        $salt = bin2hex(random_bytes(16));
        $password = hash('sha256', $new_password . $salt);

        $user = new Auth();
        $user->setConnection($connection);
        $user->updatePassword($user_id, $password, $salt);
        $user->deleteToken($token);

        echo "Password reset successful!";
        echo "<script>header('location: login.php');</script>";
    }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

// Check if the reset token and email are provided
if (isset($_GET['token']) && isset($_GET['id'])) {
    $token = $_GET['token'];
    $user_id = $_GET['id'];

    $check_token = new Auth();
    $check_token->setConnection($connection);
    $check_token = $check_token->getToken($user_id, $token);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/style-fp.css" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
  
    
</head>
<body>
<?php if ($check_token) { ?>
    <div class="wrapper">
        <div class="container">
            <div class="title-section">
                <h2 class="title">
                    Reset Password
                </h2>
                <p class="para">Reset Your Password Here</p>
            </div>

           <form action="" class="from">
            

            <div class="input-group">
                <label for="password" class="label-title"> Enter a new password</label>
                <input type="password" class="new-old" name="password" id="password" placeholder="Enter New Password">
                <span class="show-hide-btn"><i class="fa fa-eye"></i></span>
              </div>
              
              <div class="input-group">
                <label for="confirm_password" class="label-title"> Confirm your new password</label>
                <input type="password" class="new-old" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                <span class="show-hide-btn"><i class="fa fa-eye"></i></span>
              </div>

             

            <div class="input-group">
                <button class="submit-btn" type="submit">Reset Password</button>
            </div>
           </form>
        </div>
    </div>

    <script src="js/pass.js"></script>
<? } else { ?>   
    <div class="wrapper">
        <div class="container">
            <div class="title-section">
                <h2 class="title">
                    Invalid or Expired Token
                </h2>
                <p class="para">Please try to get a new token</p>
            </div>

           <form action="login" method="POST" class="from">
            
            <div class="input-group">
                <button class="submit-btn" type="submit">Back to login page</button>
            </div>
           </form>
        </div>
    </div>

    <script src="pass.js"></script>

    <?php } 
} else { ?>
    <div class="wrapper">
        <div class="container">
            <div class="title-section">
                <h2 class="title">
                    Invalid or Expired Token
                </h2>
                <p class="para">Please try to get a new token</p>
            </div>

           <form action="login" method="POST" class="from">
            
            <div class="input-group">
                <button class="submit-btn" type="submit">Back to login page</button>
            </div>
           </form>
        </div>
    </div>

    <script src="pass.js"></script>
<?php } ?>
</body>
</html>

<?php 

    
?>
