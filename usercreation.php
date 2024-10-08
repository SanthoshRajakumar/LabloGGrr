<?php
session_start();
include 'dopen.php';
if (!$link) { 
    die("HELVETE: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"] ?? null;
    $lastName = $_POST["lastName"] ?? null;
    $SSN = $_POST["SSN"] ?? null;
    $username = $_POST["username"] ?? null;
    $password = $_POST["password"] ?? null;
    $role = $_POST["role"] ?? null; // this is a problem here. The role is not being set correctly.

    if ($firstName === null || $lastName === null || $SSN === null || $username === null || $password === null || $role === null) {
        echo "<h1>Something went wrong. Fill in all fields.</h1>";
        exit();
    }

    // Generera SALT och hash
    $salt = bin2hex(openssl_random_pseudo_bytes(32));
    $hash = hash('sha256', $password . $salt);

    // Förbered SQL-frågan
    $sql = "INSERT INTO People (FirstName, LastName, UserName, Salt, HashCode, RoleType)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);

    // Kontrollera om $stmt förbereds korrekt
    if (!$stmt) {
        die("Error preparing statement: " . $link->error);
    }
    
    // Bind parametrarna till SQL-satsen
    $stmt->bind_param("isssssi", $SSN, $firstName, $lastName, $username, $salt, $hash, $role);
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
