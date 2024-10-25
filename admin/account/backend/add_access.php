<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/account/backend/functions.php';
session_start();

$room = $_POST['room'];
$accessLevel= $_POST['accessLevel'];
$editUserID = $_SESSION['editUserID']; # Should this also be post?

$sql = "INSERT INTO Access (PeopleID, RoomID, AccessID) VALUES (?,?,?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("iii", $editUserID, $room, $accessLevel);
$stmt->execute();

header("Location: ../edit_access.php");

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php'
?>