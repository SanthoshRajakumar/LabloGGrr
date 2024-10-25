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

echo '<form action="/admin/account/manage_users.php" method="GET">
    <button type="submit" class="button button-large">Manage Users</button>
  </form>';

echo '<form action="/admin/product/product_management.php" method="GET">
    <button type="submit" class="button button-large">Manage Products</button>
  </form>';

echo '<form action="/room/toggle_room_form.php" method="GET">
    <button type="submit" class="button button-large">Manage Rooms</button>
  </form>';

echo '</div>';

?>

<?php


include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php'
?>

<script>
   window.onload = function() {
      const targetDiv = document.getElementById("target");
      targetDiv.scrollIntoView({ behavior: "smooth" }); // Scroll with smooth effect
    };
</script>