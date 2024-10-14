<?php
# Connect to database and start session.
include 'dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

echo '<form action="/account/new_account.php" method="GET">
    <button type="submit" class="button button-large">Create user</button>
  </form>';

echo '<form action="/room_creation/new_room_form.php" method="GET">
    <button type="submit" class="button button-large">Create room</button>
  </form>';

include 'dclose.php'
?>