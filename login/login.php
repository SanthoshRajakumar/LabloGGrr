<?php
# Connect to database and start session.
include '../dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: ../login_page.php");
    exit();
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
    # Setting up query to get userID.
    $sql = "SELECT ID, RoleID FROM People WHERE UserName = ?";
    $stmt = $link->prepare($sql);

    # Binding parameters to username.
    $stmt->bind_param("s", $username);

    # Executing statement and getting output.
    $stmt->execute();
    $result = $stmt->get_result();
    

    $row = $result->fetch_assoc();


    echo "<h2>The login was valid, congrats!</h2>";
    $_SESSION["username"] = $username; // Adds username to session.
    $_SESSION["userID"] = $row["ID"]; // Adds user ID to session.
    $_SESSION["roleID"] = $row["RoleID"]; // Adds active user role to session.
    header("Location: ../homepage.php");
    exit();
}
else {
    echo "<h2>The login was invalid. Thief!</h2>";
}

include '../dclose.php'

?>