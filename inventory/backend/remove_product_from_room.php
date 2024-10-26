<?php
# Connect to database and start session.
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# Gets relevant access level.
$sql = "SELECT Access.AccessID FROM Access WHERE PeopleID = ? AND RoomID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("ss", $_SESSION["userID"], $_POST["room_id"]);

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$access = $row["AccessID"] ?? FALSE;

# Sets up query.
$sql = "DELETE FROM ProductLocation WHERE ProductLocation.ProductID = ? AND ProductLocation.RoomID = ? AND ProductLocation.ShelfID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("sss", $_POST["prodID"], $_POST["room_id"], $_POST["shelf_id"]);

$result = $stmt->execute();

if ($result) {
	header('Location: /inventory/inventory.php?room_id=' . $_POST["room_id"]);
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>