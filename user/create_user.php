<?php
session_start(); 
include '../dopen.php';
if (!$link) { 
    die("HELVETE: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted!<br>";
    echo "First Name: " . $_POST["firstName"] . "<br>";
    echo "Last Name: " . $_POST["lastName"] . "<br>";
    echo "Username: " . $_POST["username"] . "<br>";
    echo "Email: " . $_POST["email"] . "<br>";
} else {
    echo "Form not submitted.<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> <!-- Börja body här -->

<header>
    <h1>Create User</h1>
</header>

<main>
    <form action="usercreation.php" method="POST">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" required><br><br>

        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" required><br><br>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password (8 characters minimum)</label>
        <input type="password" id="password" name="password" minlength="8" required><br><br>

        <label for="email">Email</label> <!-- Ändra detta från 'Email' till 'email' -->
        <input type="text" id="email" name="email" required><br><br>

        <input type="submit" value="Create User" class="button">
    </form>
</main>

</body> <!-- Avsluta body här -->
</html>

<?php
include "../dclose.php";
?>