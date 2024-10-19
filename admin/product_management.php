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

# Styling
$pageTitle = "Product Management";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

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


<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include '../dclose.php';
?>