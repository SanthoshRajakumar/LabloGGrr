<?php
# NEED TO BE ADDED:
# adding flag in login logic
# generell function for att hantera fel som kommer från databas

# Connect to database
include '../../dopen.php';
include 'functions.php';
session_start();

$fname = $_POST['fname'];
$lname= $_POST['lname'];
$email = $_POST['email'];
$roleID = $_POST['roleid'];
$validated = false;

while (!$validated){
    $username = generateUsername($fname, $lname);
    $salt = generateHexSalt();

    # Validate username and salt
    $sql = "SELECT COUNT(*) FROM People WHERE UserName = ? OR Salt = ?";
    $stmt = $link->prepare($sql);
    $stmt -> bind_param("ss", $username, $salt);
    $stmt->execute();
    $stmt->bind_result($count); // Bind the result to the $count variable
    $stmt->fetch();
    $stmt->free_result();

    if ($count === 0) {
        $password = generatePassword();
        $hashcode = md5($salt . $password . $salt);
        $sql = "INSERT INTO People (FirstName, LastName, Email, UserName, Salt, HashCode) VALUES (?,?,?,?,?,?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ssssss", $fname, $lname, $email, $username, $salt, $hashcode);
        $stmt->execute();
        $validated = true;
    } 
}

$sql = "SELECT ID FROM People WHERE UserName = ? AND Salt = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ss", $username, $salt);
$stmt->execute();
$stmt->bind_result($userID); 
$stmt->fetch();
$stmt->free_result();

$_SESSION['newUserID'] = $userID;
$_SESSION['newUserName'] = $username;
$_SESSION['newUserPassword'] = $password;
$_SESSION['roleID'] = $roleID;

header("Location: ../edit_access.php");
?>