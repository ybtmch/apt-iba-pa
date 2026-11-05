<?php
include ("init.php");
include ("session.php");

$property_id = $_SESSION['property_view_id'];

$total_amount = $_POST['total_amount'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Add Poppins font -->
    
    <link href="css/gcashstyle.css" rel="stylesheet">
    <style>
        
    </style>
    
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <div class="custom-blue flex-fill ">
            <img src="resources/images/GCash-Logo.png" alt="GCash Logo" class="gcash-logo">
        </div>
        <div class="custom-white flex-fill">
            <!-- White square with shadows -->
            <div class="white-square">
                <!-- Text container with Bootstrap row -->
                <div style="background-color: #f7f7f9; height: 125px; padding:30px; border-radius: 4px;">
                    <div class="row  ">
                        <!-- Merchant text -->
                        <div  style="margin-right: 35px; " class="col-auto col-md-auto mb-3 labelgcash">Merchant</div>
                        <!-- Amount Due text -->
                        <div style="font-family:'Poppins', 'sans-serif' ; color: grey; "  class="col-auto col-md-auto  text-center ">Apt Iba Pa</div>
                    </div>
                    <div  class="row  ">
                        <!-- Merchant text -->
                        <div  style=" margin-right: 13px;" class="col-auto  mb-3 labelgcash">Amount Due</div>
                        <!-- Amount Due text -->
                        <div  class="col-auto col-md-auto  text-center valuegcash">PHP <?php echo $total_amount ?></div>
                    </div>
                </div>
                
                <div  class="row justify-content-center mb-4 mt-3">
                   <div style="margin-right: 55px; font-weight: 600; font-family: 'Poppins','sans-serif';" class="col-auto ">
                    Login to pay with GCash
                   </div>
                </div>
                <div style="margin-bottom: 85px;"  class="row justify-content-center mobileNum">
                    <div   class="col-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="plus63">+63</span>
                            </div>
                            <input type="tel" class="form-control mobile-number-input" id="mobileNumberInput" placeholder="Mobile number">
                            <div class="warning-message" id="warningMessage">Please enter your mobile number</div>
                        </div>
                    </div>
                 </div>

                 <div  class="row justify-content-center mb-4 mt-3">
                    <div  class="col-auto ">
                        <button class="custom-button" id="submitButton" disabled>
                            <span>NEXT</span>
                        </button>
                    </div>
                 </div>
               

            </div>

            <div  class="row justify-content-center mb-4 mt-3">
                <div style=" font-weight: 400; font-family: 'Poppins','sans-serif'; color: grey;" class="col-auto ">
                 Don't have a GCash account? <a style="font-weight: 200;" href="#" class="registerAcc"><b>Register Now</b></a>
                </div>
             </div>


        </div>
    </div>

    <script>
        $(document).ready(function() {
            var mobileNumberInput = $('#mobileNumberInput');
            var submitButton = $('#submitButton');
    
            mobileNumberInput.on('input', function() {
                // Enable the button if the mobile number is not empty
                submitButton.prop('disabled', $(this).val().trim() === '');
    
                // Change button color based on the input state
                var buttonColor = $(this).val().trim() === '' ? '#7aacf8' : '#2977ed';
                submitButton.css('background-color', buttonColor);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var mobileNumberInput = $('#mobileNumberInput');
            var plus63 = $('#plus63');
            var warningMessage = $('#warningMessage');
    
            mobileNumberInput.blur(function() {
                if ($(this).val().trim() === '') {
                    warningMessage.show();
                    mobileNumberInput.addClass('input-error');
                    plus63.addClass('input-error');
                } else {
                    warningMessage.hide();
                    mobileNumberInput.removeClass('input-error');
                    plus63.removeClass('input-error');
                }
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
