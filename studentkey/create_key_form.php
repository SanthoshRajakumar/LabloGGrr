<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$pageTitle = "Create key";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

if ($_SESSION["roleID"] == 2) {
	$sql = "SELECT Rooms.RoomName, Rooms.ID FROM Rooms
	  INNER JOIN Access ON Rooms.ID = Access.RoomID
      WHERE Access.PeopleID = ?";

      $stmt = $link->prepare($sql);

      $stmt->bind_param("i", $_SESSION['userID']);

      $stmt->execute();

      $result = $stmt->get_result();

    echo "<h2>Choose which of your rooms to include:</h2>";

	echo "<form action='/studentkey/backend/new_key.php' method='post'>";
    	
		if ($result && $result->num_rows > 0) {


        
        while ($row = $result->fetch_assoc()) 
        {
          echo "<input type='checkbox' name=" . $row['ID'] . " value=" . $row['ID'] . " id='" . $row['ID'] . "'>
          <label for='" . $row['ID'] . "'>" . $row['RoomName'] . "</label><br>";
        }
      }

    echo "<br><button type='submit' class='button button-large'>Submit</button>
		</form>";

	echo '<form action="/studentkey/manage_keys.php" method="GET">
    	<button type="submit" class="button button-large">Back</button>
    	</form>';
} else {
	header("Location: /room/room.php");
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>