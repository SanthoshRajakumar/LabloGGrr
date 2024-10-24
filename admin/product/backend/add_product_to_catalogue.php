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

if ($_POST["productVolume"] < 1) {
	$prodVol = NULL;
}
else {
	$prodVol = $_POST["productVolume"];
}

if ($_POST["productMass"] < 1) {
	$prodMass = NULL;
}
else {
	$prodMass = $_POST["productMass"];
}

if ($_POST["productPieces"] < 1) {
	$prodPiece = NULL;
}
else {
	$prodPiece = $_POST["productPieces"];
}

$stmt = $link->prepare($sql);

$stmt->bind_param("siiii", $_POST["productName"], $prodVol, $prodMass, $prodPiece, $_POST["prodType"]);

$result = $stmt->execute();

if ($result) {
    header('Location: /admin/product/product_management.php');
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>