<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$userID = $_POST['ID'];

$sql = "SELECT Active FROM People WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($active);
$stmt->fetch();
$stmt->free_result();

if($active){
    $sql = "UPDATE People SET Active = 0 WHERE ID = ?";
} else {
    $sql = "UPDATE People SET Active = 1 WHERE ID = ?";
}
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
header("Location: ../manage_users.php");
?>