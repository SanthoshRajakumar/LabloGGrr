<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if ($_SESSION['roleID'] != 1) {
    header("Location: /homepage.php");
    exit();
}

$_SESSION["editUserID"] = $_POST["editUserID"];

header("Location: /admin/account/edit_access.php");

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>