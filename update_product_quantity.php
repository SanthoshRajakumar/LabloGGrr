<?php 
# Connect to database and start session.
session_start();
include 'dopen.php';

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# Redirects get requests.
if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: room.php");
    exit();
}

# Gets relevant access level.
$sql = "SELECT Access.AccessID FROM Access WHERE PeopleID = ? AND RoomID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("ss", $_SESSION["userID"], $_POST["room_id"]);

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$access = $row['AccessID'] ?? FALSE;

# Redirects back to room.php on insufficient access.
if ($access == FALSE || $access > 3) {
    header("Location: room.php");
    exit();
}

# Sets up query.
$sql = "UPDATE ProductLocation SET ProductLocation.Quantity = ? WHERE ProductLocation.ProductID = ? AND ProductLocation.RoomID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("sss", $_POST["quantNew"], $_POST["prodID"], $_POST["room_id"])

$stmt->execute();
$result = $stmt->get_result();

if ($result) {
	header('Location: inventory.php/?room_id="' . $_POST["room_id"] . '"');
    exit();
}

include 'dclose.php';
?>