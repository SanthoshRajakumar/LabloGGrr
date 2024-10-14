<?php
include '../../dopen.php';
include 'functions.php';
session_start();

$roomID = $_POST['roomID'];
$peopleID = $_SESSION['newUserID'];

$sql = "DELETE FROM Access WHERE RoomID = ? AND PeopleID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $roomID, $peopleID);
$stmt->execute();

header("Location: ../edit_access.php");
?>