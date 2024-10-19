<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# Redirects get requests.
if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: /room/room.php");
    exit();
}

$sql = "INSERT INTO ProductLocation (ProductID, RoomID, Quantity) VALUES (?, ?, ?)";
$stmt = $link->prepare($sql);

$stmt->bind_param("sss", $_POST["prodID"], $_POST["room_id"], $_POST["quantity"]);

$result = $stmt->execute();

if ($result) {
    header('Location: /inventory/inventory.php?room_id=' . $_POST["room_id"]);
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>