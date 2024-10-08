<?php
include '../../dopen.php';
include 'functions.php';
session_start();

$room = $_POST['room'];
$accessLevel= $_POST['accessLevel'];
$newUserID = $_SESSION['newUserID'];
$roleID = $_SESSION['roleID'];

$sql = "INSERT INTO Access (PeopleID, RoleID, RoomID, AccessID) VALUES (?,?,?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("iiii", $newUserID, $roleID, $room, $accessLevel);
    $stmt->execute();

header("Location: ../edit_access.php");
?>