<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
?>

<!-- ELSA --> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoGGr</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2></h2>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

<header>
<form action="../index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="../site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
    <form action="/logout/logout_form.php" method="GET">
      <button type="submit" class="button2">LOGOUT</button>
    </form>
</header>

<?php
# Gets first name of active user.
$sql = "SELECT People.FirstName FROM People WHERE People.ID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("s", $_SESSION["userID"]); // Binds parameters

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();


echo '<h2>Welcome, ' . $row["FirstName"] . '!</h2>';

echo '
  <div class="div1">
<body>
  <form action="' . $url . '/room/room.php" method="GET">
    <button type="submit" class="button button-large">Rooms</button>
  </form>
  <form action="' . $url . '/profile/profile_edit.php" method="GET">
    <button type="submit" class="button button-large">Edit Profile</button>
  </form>
  <form action="' . $url . 'profile/reset_password.php" method="GET">
    <button type="submit" class="button button-large">Reset Password</button>
  </form>';


  # Only shows manage users if user has role admin.
  if ($_SESSION["roleID"] == 1) {
    echo '<form action="/account/user_management.php" method="GET">
    <button type="submit" class="button button-large">Manage users</button>
    </form>';

    echo '<form action="/products/product_management.php" method="GET">
    <button type="submit" class="button button-large">Manage products</button>
    </form>';

    echo '<form action="/admin_page.php" method="GET">
    <button type="submit" class="button button-large">Admin suite</button>
    </form>';
  }

  # Only shows create user button if user has role admin.
  /*if ($_SESSION["roleID"] == 1) {
    echo '<form action="/account/new_account.php" method="GET">
    <button type="submit" class="button button-large">Create user</button>
  </form>';
  }*/
  

?>
</div>

<div class="footer">
    <?php echo '<h4> &copy; 2024 LabbLoGGr | <a href="' . $url . '/site_info/privacy_policy.php">Privacy policy</a> | <a href="' . $url . '/site_info/terms_condi.php">Terms & Condition</a> </h4>'; ?>
</div>

<script src="java.js">
</script>

</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>