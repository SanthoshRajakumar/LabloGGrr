<?php 
session_start();
include 'dopen.php';
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
<form action="index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
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
?>

  <div class="div1">
<body>
  <form action="room.php" method="GET">
    <button type="submit" class="button button-large">Rooms</button>
  </form>
  <div class="div1">
  <form action = "room_creation/new_room_form.php" method = "GET">
    <button type="submit" class="button button-large">Create Room</button>
     
  </form>

<?php

# Should check for role here, when this is implemented.
  echo '<form action="/account/new_account.php" method="GET">
    <button type="submit" class="button button-large">Create user</button>
  </form>';

?>
</div>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="java.js">
</script>

</body>
</html>

<?php
include 'dclose.php';
?>