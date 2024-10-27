<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$sql = "SELECT StudentKey.CreatorID FROM StudentKey WHERE StudentKey.ID = ?";

$stmt = $link->prepare($sql);

$stmt->bind_param("i", $_POST['keyID']);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

$hasAccess = $row['CreatorID'] == $_SESSION['userID'] ? TRUE : FALSE;

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND $hasAccess) {

	$sql = "DELETE FROM StudentAccess WHERE KeyID = ?";

	$stmt = $link->prepare($sql);

	$stmt->bind_param("i", $_POST['keyID']);

	$stmt->execute();

	$sql = "DELETE FROM StudentKey WHERE ID = ?";

	$stmt = $link->prepare($sql);

	$stmt->bind_param("i", $_POST['keyID']);

	$stmt->execute();

}

header("Location: /studentkey/manage_keys.php");

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>