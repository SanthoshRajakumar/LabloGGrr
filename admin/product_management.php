<?php
# Connect to database and start session.
include '../dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if ($_SESSION['roleID'] != 1) {
	header("Location: ../homepage.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoGGr</title>
    <link rel="icon" type="..images/x-icon" href="../images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

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
</header>

<div class="div1">
<body>
  <form action="edit_access.php" method="GET">
  	<select>
  		<?php

  		?>
  	</select>
    <button type="submit" class="button button-large">List products by type</button>
  </form>



  </div>

<!-- Back Button -->
<button class="button button-small" onclick="window.location.href='../homepage.php'">Back to homepage</button>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="../site_info/privacy_policy.php">Privacy policy</a> | <a href="../site_info/terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="java.js">
</script>

</body>
</html>


<?php
include '../dclose.php';
?>