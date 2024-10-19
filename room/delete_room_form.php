<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: ../room.php");
    exit();
}

$sql = "SELECT ID, RoomName FROM Rooms";
$result = $link->query($sql);
$pageTitle = "Delete Room";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

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

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>