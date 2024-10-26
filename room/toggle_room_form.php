<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: ../room.php");
    exit();
}

$sql = "SELECT Rooms.ID, Rooms.RoomName, Rooms.Active, COUNT(DISTINCT Access.PeopleID) AS NumberOfPeople 
FROM Rooms
LEFT JOIN Access ON Rooms.ID = Access.RoomID
GROUP BY Rooms.ID, Rooms.RoomName, Rooms.Active";

$result = $link->query($sql);
$pageTitle = "Manage Rooms";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<table border="1">
  <tr>
    <th>Room Name</th>
    <th>People with access</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $roomID = htmlspecialchars($row['ID']);
          $roomName = htmlspecialchars($row['RoomName']);
          $active = htmlspecialchars($row['Active']);
          $numberOfPeople = htmlspecialchars($row['NumberOfPeople']);

          echo "<tr>";
          echo "<td>{$roomName}</td>";  
          echo "<td>{$numberOfPeople}</td>";  
          echo "<td>" . ($active == 1 ? "Active" : "Inactive") . "</td>"; 

          echo "<td>
                  <form action='backend/toggle_room_status.php' method='POST'>
                      <input type='hidden' name='room_id' value='{$roomID}'>
                      <button type='submit' class='button " . ($active == 1 ? "button-small" : "button2") . "'>" .
                      ($active == 1 ? "Deactivate" : "Activate") .
                      "</button>
                  </form>
                </td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='4'>No rooms available</td></tr>";
  }
  ?>
</table>
<br><br><button class="button button-large" onclick="window.location.href='/room/new_room_form.php'">Create New Room</button>
<br><br><button class="button button-large" onclick="window.location.href='/admin/admin_page.php'">Back</button>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
