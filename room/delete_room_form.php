<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: ../room.php");
    exit();
}

$sql = "SELECT ID, RoomName FROM Rooms";
$result = $link->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <link rel="stylesheet" href="../style_.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2>Delete a Room</h2>
  </div>
</div>

<div class="sample-section-wrap">
<div class="sample-section">
  <header>
    <form action="../index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="../about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
  </header>

  <!-- Flytta formuläret inuti denna sektion -->
  <form action="backend/delete_room.php" method="POST">
    <label for="room_id">Select a room to delete:</label>
    <select id="room_id" name="room_id" required>
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['ID'] . "'>" . $row['RoomName'] . "</option>";
          }
      } else {
          echo "<option value='' disabled>No rooms available</option>";
      }
      ?>
    </select>
    <button type="submit" class="button2">Delete Room</button>
  </form>
</div>
</div>

<script src="java.js"></script>
</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>