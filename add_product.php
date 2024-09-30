<?php 
session_start();
include 'dopen.php';

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# Redirects get requests.
if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: room.php");
    exit();
}

include 'dclose.php';
?>