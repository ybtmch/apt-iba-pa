<?php 
    use Models\User;
    use Models\Notification;
    include "../init.php";
    $user_id = $_SESSION['user_id'];
    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);

    $image_path = isset($user['image_name']) ? $user['image_name'] : 'admin.png';

    $notification = new Notification();
        $notification->setConnection($connection);
        $notifications = $notification->getNotifications($user_id);
        $unread_notifications = count($notification->getUnreadNotification($user_id));

        if($unread_notifications != 0){
            $unread_notif = '<span class="position-absolute top-0 start-80 translate-middle p-2 badge rounded-pill bg-danger">' . 
         $unread_notifications .
          '<span class="visually-hidden">unread messages</span>';
        } else {
            $unread_notif = '';
        }
?>
<head>
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/adminstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<nav>
    <i class='bx bx-menu' ></i>
    <form action="#">
        <div style="display: none;" class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
        </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <!-- IF EMPTY NOTIFICATIONS -->
    <?php if(empty($notifications)){ ?>

    <!-- <button class="btn me-5 position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEmptyNotif" aria-controls="offcanvasEmptyNotif">
    <i class="fa-regular fa-bell fa-3x"></i>
    </button> -->

    <!-- IF NOT EMPTY NOTIFICATIONS -->
    <?php } else { ?>
    
    <!-- <button class="btn me-5 position-relative" data-bs-toggle="offcanvas" id="openNotif" data-bs-target="#offcanvasNotif" aria-controls="offcanvasNotif">
    <i class="fa-regular fa-bell fa-3x"></i>
        <?php //echo $unread_notif ?>
    </button> -->

    <?php } ?>

    <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">

    <li class="nav-item">
                  <div class="dropdown position-relative">
                    <img src="../resources/images/users/<?php echo $image_path ?>" class="profile" alt="profile-pic" type="button" data-bs-toggle="dropdown" onclick="toggleMenu()">
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">

                            <a href="profile.php" class="sub-menu-link">
                                <p>Edit Profile</p>
                            </a>
                          
                            <a href="../logout.php" class="sub-menu-link"> 
                                <p>Logout</p>      
                            </a>
                        </div>
                    </div>

                    <!-- <div class="wrapper">
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item mt-0" href="../logout.php">Log Out</a></li>
                      </ul>
                    </div> -->
                  </div>
                </li>
            </ul>
    <!-- NOTIFICATION -->

<!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotif" aria-labelledby="offcanvasNotifLabel">

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
          $notification_text = $notification['notification_text'];
  ?>
  <div class="row borderNotif pt-3 ps-2">
    <a href="appointments.php" style="text-decoration: none">
      <div class="col">
        <h3 class="notifTitle">
          <i class="fa-regular fa-calendar-clock fa-lg pe-2" style="color: #fcbe0a;"></i>
          <?php //echo $notification_type ?></h3>
        <div class="row">
          <div class="notifDetails d-inline-block" style="max-width: 295px; margin-left: 3rem; word-wrap: break-word;"><?php //echo $notification_text ?></div>
        </div>
      </div>
    </a>
  </div>
  <?php } ?>

</div>
</div> -->
<!-- END OF NOTIFICATION -->

<!-- EMPTY NOTIFICATION -->

<!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEmptyNotif" aria-labelledby="offcanvasEmptyNotifLabel">

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
</div> -->
<!-- END OF EMPTY NOTIFICATION -->
</nav>
<script src="admin_script.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">