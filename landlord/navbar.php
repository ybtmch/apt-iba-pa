<?php 
    use Models\Notification;
    use Models\Chat;
    use Models\Message;
    use Models\User;
    include ("../init.php");

    $user_id = $_SESSION['user_id'];
    $image_name = $_SESSION['image_name'] ?? 'male-logo.png';
    $chats = new Chat();
    $chats->setConnection($connection);
    $chats = $chats->getLandlordChats($user_id);
    foreach($chats as $chat){
        $chat_id = $chat['chat_id'];
        $messages = new Message();
        $messages->setConnection($connection);
        $unread_messages = count($messages->getUnreadMessage($chat_id, $user_id));

        if ($unread_messages != 0) {
            $hasUnreadMessages = true; 
            break; 
        }
    }
    if(isset($hasUnreadMessages) && $hasUnreadMessages){
        $alert = '<span class="position-absolute top-0 start-100 translate-middle p-2 mt-2 bg-success border border-light rounded-circle pulsate">
        <span class="visually-hidden">New alerts</span>
      </span>';
    } else{
        $alert = '';
    }
    
    $notification = new Notification();
    $notification->setConnection($connection);
    $notifications = $notification->getNotifications($user_id);
    $unread_notifications = count($notification->getUnreadNotification($user_id));

    if($unread_notifications != 0){
        $unread_notif = '<span class="position-absolute top-0 start-80 translate-middle p-2 mt-2 fs-5 badge rounded-pill bg-danger">' . 
     $unread_notifications .
      '<span class="visually-hidden">unread messages</span>';
    } else {
        $unread_notif = '';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link href='css/navbar.css' rel='stylesheet'>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
          <img src="../resources/images/AipSingle2.png" alt="Bootstrap"  height="50" />
        </a>

        <div class="collapse navbar-collapse  " id="navbarNav">
          
            <ul  class="navbar-nav ms-auto  mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="properties.php">My Property</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="property-faqs.php">Property FAQs</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="appointments.php">Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reservations.php">Reservations</a>
            </li> -->
          </ul>

            <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
                    
            <!-- IF EMPTY CHATS -->
            <?php if(empty($chats)){?>
            <button class="btnNotif me-5 position-relative bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEmptyChat" aria-controls="offcanvasEmptyChat" aria-label="Inbox" style="border: none;">
                <i class="fa-regular fa-messages fa-3x"></i>
                </span>
            </button>

            <!-- IF NOT EMPTY CHATS -->
            <?php } else { ?>
            <button class="btnNotif me-5 position-relative bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasChat" aria-label="Inbox" style="border: none;">
            <i class="fa-regular fa-messages fa-3x"></i>
                <?php echo $alert ?>
          </button>

          <?php } ?>

          <!-- IF EMPTY NOTIFICATIONS -->
          <?php if(empty($notifications)){ ?>

          <button class="btn me-5 position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEmptyNotif" aria-controls="offcanvasEmptyNotif">
            <i class="fa-regular fa-bell fa-3x"></i>
          </button>

          <!-- IF NOT EMPTY NOTIFICATIONS -->
          <?php } else { ?>
            
          <button class="btn me-5 position-relative" data-bs-toggle="offcanvas" id="openNotif" data-bs-target="#offcanvasNotif" aria-controls="offcanvasNotif">
            <i class="fa-regular fa-bell fa-3x"></i>
              <?php echo $unread_notif ?>
          </button>
          
          <?php } ?>
                <li class="nav-item">
                    <?php if ($image_name != NULL) { ?>
                    <img src="../resources/images/landlords/<?php echo $image_name ?>" class="profile" alt="profile-pic" type="button" data-bs-toggle="dropdown">
                    <?php } else { ?>
                    <img src="../resources/images/landlords/male-logo.png" class="profile" alt="profile-pic" type="button" data-bs-toggle="dropdown">
                    <?php } ?>
                  <div class="dropdown position-relative">
                    <div class="wrapper">
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="appointments.php">Appointments</a></li>
                        <li><a class="dropdown-item" href="reservations.php">Reservations</a></li>
                        <li><a class="dropdown-item" href="apply-property.php">Apply My Property</a></li>
                        <li><hr class="dropdown-divider w-100"></li>
                        <li><a class="dropdown-item mt-0" href="../logout.php">Log Out</a></li>
                      </ul>
                    </div>
                  </div>
                </li>
            </ul>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary mobile-nav">
      <a class="btn bloc-icon" role="button" href="index.php">
        <i class="fa-regular fa-house-chimney fa-2x"></i>
      </a>


      <button class="btn bloc-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotif" aria-controls="offcanvasNotif">
        <i class="fa-regular fa-bell fa-2x"></i>
      </button>

      <button class="btn bloc-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasChat">
        <i class="fa-regular fa-messages fa-2x"></i>
      </button>

      <button class="btn bloc-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobMenu" aria-controls="offcanvasMobMenu">
        <i class="fa-solid fa-bars fa-2x"></i>
      </button>
</nav>


<!-- INBOX -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasChat" aria-labelledby="offcanvasChatLabel">
  <div class="offcanvas-body">
    <div class="row justify-content-between pt-3">

      <div class="col-2 d-flex justify-content-center">
        <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
      </div>
      <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
        Messages
      </div>
      <div class="col-2 d-flex justify-content-center">
      </div>
      
    </div>

    <br>
    <br>

    <?php 
        foreach($chats as $chat){
            $guest_name = $chat['first_name'] . ' ' . $chat['last_name'];
            $chat_id = $chat['chat_id'];    
            $messages = new Message();
            $messages->setConnection($connection);
            $recent_message = $messages->getRecentMessage($chat_id);
            $unread_messages = count($messages->getUnreadMessage($chat_id, $user_id));

            if($unread_messages === 0){
                $unread = ' ';
            }else {
                $unread = '<span class="badge text-bg-secondary">' . $unread_messages . '</span>';
            }
    ?>
    <div class="row borderChat pt-3 ps-2">
    
      <a class="chat" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChatBox2" data-chatid="<?php echo $chat_id ?>" aria-controls="offcanvasChatBox2" style="text-decoration: none">

        <div class="col">
          <h3 class="nameChat"><?php echo $guest_name ?>
            <?php echo $unread ?>
          </h3>
          <div class="row">
            <p class="messageChat text-truncate d-inline-block" style="max-width: 350px;"><?php echo $recent_message['message_text'] ?></p>
          </div>
        </div>

      </a>

    </div>
    <?php } ?>

  </div>
</div>

<!-- END OF INBOX -->

<!-- EMPTY INBOX -->
    <?php if(!isset($chat)){?>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEmptyChat" aria-labelledby="offcanvasChatLabel">
        <div class="offcanvas-body">
          <div class="row justify-content-between pt-3">
      
            <div class="col-2 d-flex justify-content-center">
              <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
            </div>
            <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
              Messages
            </div>
            <div class="col-2 d-flex justify-content-center">
            </div>
          </div>
      
          <br>
          <br>
      
          <div class="card-body d-flex align-items-center justify-content-center mt-5 pt-5" style="height: 500px; overflow: auto;">
      
            <div class="text-center pt-5">
              <img src="../resources/images/empty-box.png" class="rounded opacity-50" alt="..." >
      
              <p class="text-center mt-5 pt-3 mainTxt" style="font-size: 20px; font-weight: 600;"> No messages, yet</p>
      
              <p class="text-center subTxt" style="font-size: 14px; font-weight: 500;">When you have messages, you'll see them here </p>
      
            </div>
      
          </div>
      
      
        </div>
      </div>
    <?php } ?>

<!-- END OF EMPTY INBOX -->

<!-- CHAT -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasChatBox2"  aria-labelledby="offcanvasChatBoxLabel">
    <div id="offcanvasChatBox" >
    
    </div>
    
    <div class="card-footer bg-white position-absolute w-100 bottom-0 m-0 p-1">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary">
                        <i class="fa-solid fa-paperclip chatIcons"></i>
                        </button>
                    </div>

                    <input type="text" class="form-control border-0" name="chat_message" id="chat_message" placeholder="Write a message...">

                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary" type="submit" id="submit-button">
                            <i class="fa-solid fa-paper-plane-top chatIcons"></i>
                        </button>
                    </div>
                </div>
            </div>
</div>
<!-- END OF CHAT -->

<!-- EMPTY CHAT -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEmptyChatBox" aria-labelledby="offcanvasEmptyChatBoxLabel">
  <div class="offcanvas-header" >

    <div class="row justify-content-between align-items-center w-100" >
      <div class="col-2">
          <div class="position-relative"
              style="width:50px; height: 50px; border-radius: 50%; border: 2px solid #e84118; padding: 2px;">
              <img src="images/prof1.png"
                  class="img-fluid rounded-circle" alt="">
              <span
                  class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                  <span class="visually-hidden">New alerts</span>
              </span>
          </div>
      </div>

      <div class="col-9 mt-3">
        <p class="chatName" >BatacBatacBatac Dormitory Landlord</p>
      </div>

      <div class="col-1">
      </div>
    </div>


  </div>
  
  <div class="offcanvas-body">
    

        <div class="card mx-auto h-100" style="max-width:400px">

            <div class="card-body d-flex align-items-center justify-content-center" style="height: 500px; overflow: auto;">

                  <div class="text-center">
                    <img src="images/empty-box.png" class="rounded opacity-50" alt="..." >

                  <p class="text-center mt-5 pt-3 mainTxt" style="font-size: 20px; font-weight: 600;"> Start conversation here</p>
                  
                  <p class="text-center subTxt" style="font-size: 14px; font-weight: 500;">When you have messages, you'll see them here </p>


                  </div>
            </div>
            <div class="card-footer bg-white position-absolute w-100 bottom-0 m-0 p-1">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary">
                          <i class="fa-solid fa-paperclip chatIcons"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Write a message...">
                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary">
                            <i class="fa-solid fa-smile chatIcons"></i>
                        </button>
                    </div>
                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary">
                            <i class="fa-solid fa-paper-plane-top chatIcons"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

  </div>
</div>
<!-- END OF EMPTY CHAT -->

<!-- NOTIFICATION -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotif" aria-labelledby="offcanvasNotifLabel">

  <div class="offcanvas-body">
    <div class="row justify-content-between pt-3">

      <div class="col-2 d-flex justify-content-center">
        <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
      </div>
      <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
        Notifications
      </div>
      <div class="col-2 d-flex justify-content-center">
        
      </div>
    </div>

    <br>
    <br>
    <?php 
        foreach($notifications as $notification){ 
            $notification_type = strtoupper($notification['notification_type']);
            $notiftype = $notification['notification_type'];
            $notification_text = $notification['notification_text'];
    ?>
    <div class="row borderNotif pt-3 ps-2">
        <?php if ($notiftype === 'appointment'){ ?>
            <a href="appointments.php" style="text-decoration: none">
        <?php } elseif ($notiftype === 'reservation'){ ?>
            <a href="reservations.php" style="text-decoration: none">
        <?php } elseif ($notiftype === 'application'){ ?>
            <a href="properties.php" style="text-decoration: none">
        <?php } ?>
        <div class="col">
          <h3 class="notifTitle">
            <i class="fa-regular fa-calendar-clock fa-lg pe-2" style="color: #fcbe0a;"></i>
            <?php echo $notification_type ?></h3>
          <div class="row">
            <div class="notifDetails d-inline-block" style="max-width: 300px; margin-left: 3rem; word-wrap: break-word;"><?php echo $notification_text ?></div>
          </div>
        </div>
      </a>
    </div>
    <?php } ?>

  </div>
</div>
<!-- END OF NOTIFICATION -->

<!-- EMPTY NOTIFICATION -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEmptyNotif" aria-labelledby="offcanvasEmptyNotifLabel">

  <div class="offcanvas-body">
    <div class="row justify-content-between pt-3">

      <div class="col-2 d-flex justify-content-center">
        <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
      </div>
      <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
        Notifications
      </div>
      <div class="col-2 d-flex justify-content-center">
        
      </div>
    </div>

    <br>
    <br>

    <div class="card-body d-flex align-items-center justify-content-center mt-5 pt-5" style="height: 500px; overflow: auto;">

      <div class="text-center pt-5">
        <img src="resources/images/empty-notif.png" class="rounded opacity-50" alt="..." >

        <p class="text-center mt-5 pt-3 mainTxt" style="font-size: 20px; font-weight: 600;"> No notifications yet</p>

        <p class="text-center subTxt" style="font-size: 14px; font-weight: 500;">When you have notifications, you'll see them here </p>

      </div>

    </div>



  </div>
</div>
<!-- END OF EMPTY NOTIFICATION -->

    <!-- Off Canvas - Menu - Mobile -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMobMenu" aria-labelledby="offcanvasMobMenuLabel">

    <div class="offcanvas-body">
      <div class="row justify-content-between pt-3">

        <div class="col-2 d-flex justify-content-center">
          <button type="button" class="btn" data-bs-dismiss="offcanvas"><i class="fa-regular fa-arrow-left fa-2x"></i></button>
        </div>
        <div class="col-5 justify-content-center fs-4 d-flex align-items-center">
          <h5 class="offcanvas-title" id="offcanvasMobMenuLabel">Menu</h5>
        </div>
        <div class="col-2 d-flex justify-content-center">
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
        <a href="properties.php" style="text-decoration: none">
          <div class="col">
            <h3 class="menuNav">
            <i class="fa-regular fa-house-building pe-2"></i>
            My Property</h3>
          </div>
        </a>
      </div>
      
      <div class="row borderMenu pt-3 pb-2 ps-2">
        <a href="appointments.php" style="text-decoration: none">
          <div class="col">
            <h3 class="menuNav">
            <i class="fa-regular fa-calendar-check pe-2"></i>
            Appointments</h3>
          </div>
        </a>
      </div>

      <div class="row borderMenu pt-3 pb-2 ps-2">
        <a href="reservations.php" style="text-decoration: none">
          <div class="col">
            <h3 class="menuNav">
            <i class="fa-regular fa-key pe-2"></i>
            Reservation</h3>
          </div>
        </a>
      </div>

      <div class="row borderMenu pt-3 pb-2 ps-2">
        <form class="signOutbtn" role="search" action="../logout" method="POST">
          <button class="btn me-2" type="submit">
          Sign Out &nbsp;<i class="fa-solid fa-right-from-bracket"></i> 
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

    var chatLinks = document.querySelectorAll('.chat');
                
    chatLinks.forEach(function(chatLink) {
        chatLink.addEventListener('click', function(event) {
            event.preventDefault();
            var chatId = chatLink.getAttribute('data-chatid');
            loadChatMessages(chatId);
            readChat({
                chat_id: chatId,
                user_id: <?php echo $user_id ?>
            });
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

    function readChat(data) {
        $.ajax({
            type: 'POST',
            url: 'read-chat',
            data: data,
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

    function sendChatMessages(data) {
        $.ajax({
            type: 'POST',
            url: 'send-message',
            data: data,
            success: function(response) {
                //alert(response);
                //loadChatMessages(chatId);
            },
            error: function() {
                alert('Error sending chat messages.');
            }
        }); 
    }

    });
</script>
</body>