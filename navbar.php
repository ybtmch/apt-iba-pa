<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
          <img src="resources/images/AipSingle2.png" alt="Bootstrap"  height="50" />
        </a>


        <!-- <a class="btn bloc-icon" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobMenu" aria-controls="offcanvasMobMenu">
      <img src="resources/images/users/<?php echo $image_name ?>" class="profile" alt="profile-pic" >
      </a> -->

        <div class="collapse navbar-collapse" id="navbarNav">

          
                <style><?php include('css/navbar.css'); ?></style>
                <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="accommodations.php">Accommodations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="faqs.php">FAQs</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="apply.php">Apply My Property</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
            </li>
        </ul>
          
        </div>
      </div>
    </nav>

    <!-- Mobile Navbar -->

      <nav class="navbar navbar-expand-lg bg-body-tertiary mobile-nav">
      <a class="btn bloc-icon" role="button" href="index.php">
        <i class="fa-regular fa-house-chimney fa-2x"></i>
      </a>

      <a class="btn bloc-icon" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobMenuOut" aria-controls="offcanvasMobMenuOut">
        <i class="fa-solid fa-bars fa-2x"></i>
      </a>
     </nav>

    <!-- Off Canvas - Logged Out Menu - Mobile -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMobMenuOut" aria-labelledby="offcanvasMobMenuLabel">

      <div class="offcanvas-body">
        <div class="row justify-content-between pt-3">

          <div class="col-2 d-flex justify-content-center">
            <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
          </div>
          <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasMobMenuLabel">Menu</h5>
          </div>
          <div class="col-2 d-flex justify-content-center">
            <button type="button" class="btn"><i class="fa-regular fa-plus fa-2x"></i></button>
          </div>
        </div>

        <br>
        <br>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <a href="index.php" style="text-decoration: none">
            <div class="col">
              <h3 class="menuNav">
              <i class="fa-regular fa-house-chimney pe-2"></i>
              Home</h3>
            </div>
          </a>
        </div>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <a href="accommodations.php" style="text-decoration: none">
            <div class="col">
              <h3 class="menuNav">
              <i class="fa-regular fa-house-building pe-2"></i>
              Accommodations</h3>
            </div>
          </a>
        </div>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <a href="about.php" style="text-decoration: none">
            <div class="col">
              <h3 class="menuNav">
              <i class="fa-regular fa-circle-info pe-2"></i>
              About Us</h3>
            </div>
          </a>
        </div>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <a href="faqs.php" style="text-decoration: none">
            <div class="col">
              <h3 class="menuNav">
              <i class="fa-regular fa-location-question pe-2"></i> 
              FAQs</h3>
            </div>
          </a>
        </div>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <a href="apply.php" style="text-decoration: none">
            <div class="col">
              <h3 class="menuNav">
              <i class="fa-regular fa-magnifying-glass-location pe-2"></i> 
              Apply My Property</h3>
            </div>
          </a>
        </div>

        <div class="row borderMenu pt-3 pb-2 ps-2">
          <form class="signOutbtn" role="search" action="login" method="POST">
            <button class="btn me-2" type="submit">
            Sign In &nbsp;<i class="fa-solid fa-right-to-bracket"></i>
            </button>
          </form>
        </div>

      </div>
    </div>





<script>
    let subMenu = document.getElementById("subMenu");
function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // First part of the script
    var chatLinks = document.querySelectorAll('.chat');

    chatLinks.forEach(function(chatLink) {
        chatLink.addEventListener('click', function(event) {
            event.preventDefault();
            var chatId = chatLink.getAttribute('data-chatid');
            loadChatMessages(chatId);
            // loadChatMessagesPeriodically(chatId); 
            // setInterval(function() {
            //     loadChatMessagesPeriodically(chatId);
            // }, 10000); 
        });
    });

    // function loadChatMessagesPeriodically(chatId) {
    //     loadChatMessages(chatId);
    // }

    function loadChatMessages(chatId) {
        $.ajax({
            type: 'GET',
            url: 'load-messages',
            data: { chat_id: chatId },
            success: function(data) {
                $('#offcanvasChatBox').html(data);
            },
            error: function() {
                alert('Error loading chat messages.');
            }
        });
    }

    $('#openNotif').click(function() {
        var userId = <?php echo $user_id ?>;
        readNotification(userId);
    });

    function readNotification(userId) {
        $.ajax({
            type: 'POST',
            url: 'read-notification',
            data: { user_id: userId },
            success: function(data) {
            }
        });

    }

    // Second part of the script
    $('#chat_message').keypress(function(e) {
        if (e.which === 13) { // 13 is the key code for Enter.
            e.preventDefault(); // Prevent the default form submission.
            var chat_message = $('#chat_message').val();
            var chat_id = $('#chat_id').val();
            sendChatMessages({
                chat_id: chat_id,
                sender_id: <?php echo $user_id ?>,
                chat_message: chat_message
            });
            $('#chat_message').val('');
            loadChatMessages(chat_id);
        }
    });

    // Bind an event handler to the button click event.
    $('#submit-button').click(function() {
        var chat_message = $('#chat_message').val();
        var chat_id = $('#chat_id').val();
        sendChatMessages({
            chat_id: chat_id,
            sender_id: <?php echo $user_id ?>,
            chat_message: chat_message
        });
        $('#chat_message').val('');
        loadChatMessages(chat_id);
    });

    // function sendChatMessages(data) {
    //     $.ajax({
    //         type: 'POST',
    //         url: 'send-message.php',
    //         data: data,
    //         success: function(response) {
    //             //alert(response);
    //             //loadChatMessages(chatId);
    //         },
    //         error: function() {
    //             alert('Error sending chat messages.');
    //         }
    //     }); 
    // }

    function sendChatMessages(data) {
        $.ajax({
            type: 'POST',
            url: 'send-message',
            data: data,
            success: function(response) {
                //alert(response);
                var responseData = JSON.parse(response);
                console.log(response + ' ' + responseData);
                //alert(responseData);
                window.postMessage({ type: 'messageSent', chatId: 1}, '*'); 
            },
            error: function() {
                alert('Error sending chat messages.');
            }
        }); 
    }
        // function loadChatMessages(chat_id) {
        //     $.ajax({
        //         type: 'GET',
        //         url: 'load-messages.php',
        //         data: { chat_id: chat_id },
        //         success: function(data) {
        //             $('#offcanvasChatBox').html(data);
        //         },
        //         error: function() {
        //             alert('Error loading chat messages.');
        //         }
        //     });
        // }
    });
</script>
