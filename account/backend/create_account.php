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
        $validated = true;
    } 
}


$sql = "INSERT INTO People (FirstName, LastName, Email, UserName, RoleID, Salt, HashCode) VALUES (?,?,?,?,?,?,?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sssssss", $fname, $lname, $email, $username, $roleID, $salt, $hashcode);
$stmt->execute();





$sql = "SELECT ID FROM People WHERE UserName = ? AND Salt = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ss", $username, $salt);
$stmt->execute();
$stmt->bind_result($userID); 
$stmt->fetch();
$stmt->free_result();

# Better to use get request later?
# edit_access.php should be usable on other users than newly created later.
$_SESSION['newUserID'] = $userID;
# Below 2 not used. Remove?
$_SESSION['newUserName'] = $username;
$_SESSION['newUserPassword'] = $password;
# Removed because roleID session variable is now used for active user.

header("Location: ../edit_access.php");

include '../../dclose.php'
?>