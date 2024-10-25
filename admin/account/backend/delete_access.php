<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';
session_start();

$roomID = $_POST['roomID'];
$peopleID = $_SESSION['editUserID'];

$sql = "DELETE FROM Access WHERE RoomID = ? AND PeopleID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $roomID, $peopleID);
$stmt->execute();

header("Location: ../edit_access.php");
?>