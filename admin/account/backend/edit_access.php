<?php

//Saras test
session_start();

$userID = $_POST['ID'];

$_SESSION['editUserID'] = $userID;

header("Location: ../edit_access.php");
?>
