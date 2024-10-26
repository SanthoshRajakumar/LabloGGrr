<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
$pageTitle = "New room";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

if (isset($_SESSION['message'])) {
  echo "<p class='message'>" . htmlspecialchars($_SESSION['message']) . "</p>";
  unset($_SESSION['message']); //eeeergh 
}

?>

  <!-- Flytta formuläret inuti denna sektion -->
  <form action="backend/new_room.php" method="POST">
    <label for="room_name">Room Name:</label>
    <input type="text" id="room_name" name="room_name" required>
    <button type="submit" class="button button-large">Submit</button>
  </form>
  <br><br><button class="button button-large" onclick="window.location.href='/admin/admin_page.php'">Back</button>
</div>
</div>



<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
