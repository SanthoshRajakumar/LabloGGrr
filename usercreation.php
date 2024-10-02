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
    $role = $_POST["role"];

    // Generera SALT och hash
    $salt = bin2hex(openssl_random_pseudo_bytes(32));
    $hash = hash('sha256', $password . $salt);

    // Förbered SQL-frågan
    $sql = "INSERT INTO People (SSN, FirstName, LastName, Email, UserName, Salt, HashCode, Active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);

    // Kontrollera om $stmt förbereds korrekt
    if (!$stmt) {
        die("Error preparing statement: " . $link->error);
    }
    
    // Bind parametrarna till SQL-satsen
    $stmt->bind_param("ssssssis", $SSN, $firstName, $lastName, $username, $username, $salt, $hash, 1);
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