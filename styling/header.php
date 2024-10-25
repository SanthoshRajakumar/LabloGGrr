
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo '<title>' . $pageTitle . '</title>';
    ?>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <link rel="stylesheet" href="/styling/style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
<?php

if(isset($_SESSION['roleID'])){
    if ($_SESSION['roleID'] === 4){
    echo '<form action="/room/room.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>';
    } elseif($_SESSION['roleID'] === 1) {
    echo '<form action="/admin/admin_page.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>';
  }else {
    echo '<form action="/room/room.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>';
  }
} else {
    echo '<form action="/index.php" method="GET">
    <button type="submit" class="button2">HOME</button>
  </form>';
}
  ?>
    <form action="/site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="/site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="/site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
  <?php
    if(isset($_SESSION['userID'])){
      echo '<div class="dropdown">
          <button class="button2">ACCOUNT
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a class="button2" href="/profile/profile_edit.php">Edit profile</a>
      <a class="button2" href="/profile/reset_password.php">Reset password</a>
      <a class="button2" href="/logout/logout_form.php">Logout</a>
    </div>
  </div>';
    }
  
  ?>
    
  </header>

  <style>
    /* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 16vw;
  box-shadow: 0vw 0.1vw 1vw 0vw rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  padding: 1vw 1vw;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */


/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}
  </style>