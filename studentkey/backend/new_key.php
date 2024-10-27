<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if ($_SESSION["roleID"] == 2) {
	$validated = FALSE;

	while (!$validated){
	    $keyID = random_int(100000000, 9999999999);

	    # Validate key ID
	    $sql = "SELECT COUNT(*) FROM StudentKey WHERE ID = ?";
	    $stmt = $link->prepare($sql);
	    $stmt -> bind_param("i", $keyID);
	    $stmt->execute();
	    $stmt->bind_result($count); // Bind the result to the $count variable
	    $stmt->fetch();
	    $stmt->free_result();

	    if ($count === 0) {

	        $validated = true;
	    }
	}

	# Inserts the key
	$sql = "INSERT INTO StudentKey (ID, CreatorID) VALUES (?, ?)";

	$stmt = $link->prepare($sql);

	$stmt -> bind_param("ii", $keyID, $_SESSION['userID']);

	$stmt->execute();
	
	$sql = "SELECT Rooms.ID FROM Rooms
		INNER JOIN Access ON Rooms.ID = Access.RoomID
	  	WHERE Access.PeopleID = ?";

    	$stmt = $link->prepare($sql);

    	$stmt->bind_param("i", $_SESSION['userID']);

    	$stmt->execute();

    	$result = $stmt->get_result();

	# Insert the key access
    while ($row = $result->fetch_assoc()) {
	    if ($result && $result->num_rows > 0) {
		    if (isset($_POST[$row['ID']]) && $_POST[$row['ID']] != NULL) {
			    $sql2 = "INSERT INTO StudentAccess (RoomID, KeyID, AccessID) VALUES (?, ?, ?)";

			    $stmt2 = $link->prepare($sql2);

			    $access = 4;
			    
				$stmt2 -> bind_param("iii", $_POST[$row['ID']], $keyID, $access);

				$stmt2->execute();
			}
		}
    }

}

header("Location: /studentkey/manage_keys.php");

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>