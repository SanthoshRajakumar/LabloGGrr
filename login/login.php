<?php

$servername = "localhost";
$username = "root";  # default
$password = "root";  # default
$dbname = "labloggr";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# User input
$username = $_POST['username'];
$password = $_POST['password'];



?>