<?php
include '../../dopen.php';
include 'functions.php';
session_start();

$room = $_POST['room'];
$accessLevel= $_POST['accessLevel'];
$newUserID = $_SESSION['newUserID']; # Should this also be post?

$sql = "INSERT INTO Access (PeopleID, RoomID, AccessID) VALUES (?,?,?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("iii", $newUserID, $room, $accessLevel);
$stmt->execute();

header("Location: ../edit_access.php");
?>