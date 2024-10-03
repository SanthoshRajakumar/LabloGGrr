<?php
session_start();
include '../dopen.php';
if (!$link) { 
    die("HELVETE: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    // Generera SALT och hash
    $salt = bin2hex(openssl_random_pseudo_bytes(25));
    $hash = hash('sha256', $password . $salt);

    // Förbered SQL-frågan
    $sql = "INSERT INTO People (FirstName, LastName, UserName, Salt, HashCode, Email)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Förbered SQL-satsen
    $stmt = $link->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $link->error);
    }

    // Bind parametrarna till SQL-satsen
    $stmt->bind_param("ssssss", $firstName, $lastName, $username, $salt, $hash, $email);

    // Exekvera SQL-satsen
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Om inget fel inträffar
    echo "<h1>The user was created!</h1>";

    // Stäng anslutningen innan omdirigering
    include "../dclose.php";

    // Omdirigera till YouTube-länken
    header("Location: https://www.youtube.com/watch?v=v7ScGV5128A");
    exit();
    
    // Stäng statement
    $stmt->close();
}
?>