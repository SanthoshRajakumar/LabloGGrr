<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$roomID = $_POST['room_id']; // här var felet, ty man måste ju såklart ta name istället för variabelnamnet 

$sql = "SELECT Active FROM Rooms WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $roomID);
$stmt->execute();
$stmt->bind_result($active);
$stmt->fetch();
$stmt->free_result();

if($active){
    $sql = "UPDATE Rooms SET Active = 0 WHERE ID = ?";
} else {
    $sql = "UPDATE Rooms SET Active = 1 WHERE ID = ?";
}
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $roomID);
$stmt->execute();

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
header("Location: ../toggle_room_form.php");
?>