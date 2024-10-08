<?php
include '../../dopen.php';
include 'functions.php';
session_start();

$accessID = $_POST['accessID'];

$sql = "DELETE FROM Access WHERE AccessID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $accessID);
$stmt->execute();

header("Location: ../edit_access.php");
?>