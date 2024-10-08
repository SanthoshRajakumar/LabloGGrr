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

  // Regex validation
  $namePattern = "/^[a-zA-Z'-]+$/";  // Only letters, apostrophes, and hyphens for names
  $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Email format
  $usernamePattern = "/^[a-zA-Z0-9_]{3,15}$/";  // Alphanumeric, underscores, 3-15 characters
  $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/";  // At least 8 chars, 1 letter, 1 number, 1 special char

  // Validate first name
  if (!preg_match($namePattern, $firstName)) {
      die("Invalid first name. Only letters, apostrophes, and hyphens are allowed.");
  }

  // Validate last name
  if (!preg_match($namePattern, $lastName)) {
      die("Invalid last name. Only letters, apostrophes, and hyphens are allowed.");
  }

  // Validate email
  if (!preg_match($emailPattern, $email)) {
      die("Invalid email format.");
  }

  // Validate username
  if (!preg_match($usernamePattern, $username)) {
      die("Invalid username. Must be 3-15 characters long and contain only letters, numbers, or underscores.");
  }

  // Validate password
  if (!preg_match($passwordPattern, $password)) {
      die("Invalid password. Must be at least 8 characters long, include at least one letter, one number, and one special character.");
  }
    
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