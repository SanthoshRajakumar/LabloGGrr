<?php
session_start();
include 'dopen.php';
if (!$link) { 
    die("HELVETE: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $SSN = $_POST["SSN"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // this is a problem here. The role is not being set correctly.

    // Generera SALT och hash
    $salt = bin2hex(openssl_random_pseudo_bytes(32));
    $hash = hash('sha256', $password . $salt);

    // Förbered SQL-frågan
    $sql = "INSERT INTO People (SSN, FirstName, LastName, UserName, Salt, HashCode, RoleType)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $sql2 = "SELECT roleID from Access WHERE PeopleID = ? AND RoomID = ?"; 
    $result = "Inner JOIN Rooms ON Rooms.ID = Access.RoomID INNER JOIN Access ON Access.PeopleID = People.ID AND Access.RoomID = Rooms.ID"
    $stmt = $link->prepare($sql);

    // Kontrollera om $stmt förbereds korrekt
    if (!$stmt) {
        die("Error preparing statement: " . $link->error);
    }
    
    // Bind parametrarna till SQL-satsen
    $stmt->bind_param("isssssis", $SSN, $firstName, $lastName, $username, $username, $salt, $hash, $role);
    $stmt->execute();

    // Kontrollera om det finns ett fel
    if ($stmt->error) {
        echo "Error executing statement: FAN OCKSÅ " . $stmt->error;
    } else {
        echo "<h1>The user was created!</h1>";
        
        // Stäng anslutningen innan omdirigering
        include "dclose.php";

        // Omdirigera till YouTube-länken
        header("Location: https://www.youtube.com/watch?v=v7ScGV5128A");
        exit();
    }
    
    // Stäng statement
    $stmt->close();
}
?>