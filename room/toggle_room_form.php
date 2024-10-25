<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: ../room.php");
    exit();
}

$sql = "SELECT ID, RoomName, Active FROM Rooms";
$result = $link->query($sql);
$pageTitle = "Manage Rooms";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

  <table border="1">
    <tr>
      <th>Room Name</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $roomID = htmlspecialchars($row['ID']);
            $roomName = htmlspecialchars($row['RoomName']);
            $active = htmlspecialchars($row['Active']);

            echo "<tr><td>{$roomName}</td>";
            if ($active == 1) {
                echo "<td>Active</td>";
                echo "<td>
                        <form action='backend/toggle_room_status.php' method='POST'>
                            <input type='hidden' name='room_id' value='{$roomID}'>
                            <button type='submit' class='button button-small'>Deactivate</button>
                        </form>
                      </td>";
            } else {
                echo "<td>Inactive</td>";
                echo "<td>
                        <form action='backend/toggle_room_status.php' method='POST'>
                            <input type='hidden' name='room_id' value='{$roomID}'>
                            <button type='submit' class='button2'>Activate</button>
                        </form>
                      </td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No rooms available</td></tr>";
    }
    ?>
  </table>
<br><br><button class="button button-large" onclick="window.location.href='/room/new_room_form.php'">Create New Room</button>
<br><br><button class="button button-large" onclick="window.location.href='/admin/admin_page.php'">Back</button>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
