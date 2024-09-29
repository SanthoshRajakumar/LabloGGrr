<?php
session_start();

# Database connection parameters.
$servername = "localhost";
$username = "root";  # default
$password = "root";  # default
$dbname = "labloggr";

# Creating connection.
$link = mysqli_connect($servername, $username, $password, $dbname);

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

# User input.
$username = $_POST['username'];
$password = $_POST['password'];

# Preparing query.
$sql = "SELECT Salt, HashCode FROM People WHERE UserName = ?";
$stmt = $link->prepare($sql);

# Binding parameters to user input.
$stmt->bind_param("s", $username);

# Executing statement and getting output.
$stmt->execute();
$result = $stmt->get_result();

# Getting output.
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $salt = $row["Salt"];
    $hash = $row["HashCode"];
}

# Setting up hash to check against database.
$testhash = md5($salt . $password . $salt);

# Testing passord against database.
$valid_login = FALSE;
if ($testhash == $hash) {
    $valid_login = TRUE;
}

# Handles validation results.
if ($valid_login) {
    echo "<h2>The login was valid, congrats!</h2>";
    $_SESSION["username"] = $username;
    header("Location: ../homepage.php");
    exit();
}
else {
    echo "<h2>The login was invalid. Thief!</h2>";
}

?>