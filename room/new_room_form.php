<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
$pageTitle = "New room";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/account.php';
?>

  <!-- Flytta formuläret inuti denna sektion -->
  <form action="backend/new_room.php" method="POST">
    <label for="room_name">Room Name:</label>
    <input type="text" id="room_name" name="room_name" required>
    <button type="submit" class="button2">Submit</button>
  </form>
</div>
</div>


<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
