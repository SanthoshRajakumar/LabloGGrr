<?php
# Connect to database and start session.
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if ($_SESSION['roleID'] != 1) {
	header("Location: /homepage.php");
}

# Redirects get requests.
if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: /homepage.php");
    exit();
}

$sql = "INSERT INTO Product (ProductName, Volume, Mass, Pieces, ProductTypeID) VALUES (?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);

$stmt->bind_param("ssssi", $_POST["productName"], $_POST["productVolume"] ?? NULL, $_POST["productMass"] ?? NULL, $_POST["productPieces"] ?? NULL, $_POST["productType"]);

$result = $stmt->execute();

if ($result) {
    header('Location: /admin/product/backend/inventory.php');
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>