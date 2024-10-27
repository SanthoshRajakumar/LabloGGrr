<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$pageTitle = "Manage keys";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

?>
<h2>Your Keys</h2>
<div class="div1">
<body>
  
  		<?php

      $sql = "SELECT StudentKey.ID, GROUP_CONCAT(Rooms.RoomName SEPARATOR ', ') AS locations FROM StudentKey, Rooms
      INNER JOIN StudentAccess ON Rooms.ID = StudentAccess.RoomID
      WHERE StudentKey.CreatorID = ? AND StudentAccess.KeyID = StudentKey.ID
      GROUP BY StudentKey.ID";

      $stmt = $link->prepare($sql);

      $stmt->bind_param("i", $_SESSION['userID']);

      $stmt->execute();

      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {


        echo "<table border='1'>";
        echo "<thead><tr><th>Student key</th><th>Rooms</th><th>Delete</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) 
        {
          echo "<tr>";
          echo "<td>" . (isset($row['ID']) ? $row['ID'] : '') . "</td>";
          echo "<td>" . (isset($row['locations']) ? $row['locations'] : '') . "</td>";
          echo "<form action='/studentkey/backend/delete_key.php' method='post'>";
          echo "<input type='hidden' value='" . $row['ID'] . "' name='keyID'>";
          echo "<td><input type='submit' value='Delete'></td>";
          echo "</form>";
          echo "</tr>";
        }
        echo "</tbody></table><br><br>";
      }

  		?>
  
  </div>

<div>

<?php
echo "
  <form action='/studentkey/create_key_form.php' method='get'>
  	<input type='submit' value='Create student key' class='button button-large'>
  </form>";
?>

</div>

<?php

if ($_SESSION["roleID"] == 2) {

    echo '<form action="/room/room.php" method="GET">
    <button type="submit" class="button button-large">Rooms</button>
    </form>';
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>