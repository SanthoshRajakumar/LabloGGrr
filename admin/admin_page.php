<?php
# Connect to database and start session.
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# Styling
$pageTitle = "Admin";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 


echo '<h2>Admin suite</h2>';

echo '<div class="div1">';

echo '<form action="/admin/account/user_management.php" method="GET">
    <button type="submit" class="button button-large">Manage users</button>
  </form>';

echo '<form action="/room/new_room_form.php" method="GET">
    <button type="submit" class="button button-large">Create room</button>
  </form>';

echo '<form action="/admin/product/product_management.php" method="GET">
    <button type="submit" class="button button-large">Manage products</button>
  </form>';

echo '</div>';

?>
<!-- Back Button -->
<br><br><button class="button button-small" onclick="window.location.href='/homepage.php'">Back to homepage</button>
<?php


include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php'
?>