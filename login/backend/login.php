<?php
# Connect to database and start session.
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
    header("Location: /login/login.php");
    exit();
}

# User input.
$username = $_POST['username'];
$password = $_POST['password'];

# Preparing query.
$sql = "SELECT Salt, HashCode, Active FROM People WHERE UserName = ?";
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
    $active = $row["Active"];

    if($active){
        # Setting up hash to check against database.
            $testhash = md5($salt . $password . $salt);

            # Testing passord against database.
            # Handles validation results.
            if ($testhash === $hash) {
                # Setting up query to get userID.
                $sql = "SELECT ID, RoleID FROM People WHERE UserName = ?";
                $stmt = $link->prepare($sql);
        
                # Binding parameters to username.
                $stmt->bind_param("s", $username);
        
                # Executing statement and getting output.
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
        
                //$_SESSION["username"] = $username; // Adds username to session.
                $_SESSION["userID"] = $row["ID"]; // Adds user ID to session.
                $_SESSION["roleID"] = $row["RoleID"]; // Adds active user role to session.
                if($_SESSION['roleID'] == 1){
                    header("Location: /admin/admin_page.php");  
                } else {
                    header("Location: /room/room.php");  
                }
            } else {
                $_SESSION["message"] = "The username or password is incorrect. Please try again!";
                header("Location: /login/login.php");
            }
        } else {
            $_SESSION["message"] = "This account has been deactivated.";
            header("Location: /login/login.php");
        }
} else {
    $_SESSION["message"] = "The username or password is incorrect. Please try again!";
    header("Location: /login/login.php");
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>