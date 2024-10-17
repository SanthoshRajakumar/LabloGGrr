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
    <title>Create User</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png"> 
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body> <!-- Börja body här -->

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2></h2>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
<form action="index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="../site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header>

<div class="div2">
    <h2> Create user </h2>
</div>

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

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="../site_info/privacy_policy.php">Privacy policy</a> | <a href="../site_info/terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="../java.js">
</script>

</body> <!-- Avsluta body här -->
</html>

<?php
include "../dclose.php";
?>