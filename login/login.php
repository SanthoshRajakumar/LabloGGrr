<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png"> 
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2></h2>
  </div>
</div>

<!-- Content Section -->
<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
<form action="../index.php" method="GET">
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

<h2>Sign in here</h2>
<div class="div_login">
<form action="./backend/login.php" method="POST">
    <label for="username">Username</label>
    <input type="text" placeholder="Enter username" name="username" required/><br />
            
    <label for="password">Password</label>
    <input type="password" placeholder="Enter password" name="password" required /><br />
    <div class="form-footer">
      <a href="forgot_password.php">Forgot your password?</a>
      <button type="submit" class="button button-large">Login</button>
    </div>
</form>
</div>

<?php
session_start();

if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "$message";
    unset($_SESSION['message']);
}
?>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="../privacy_policy.php">Privacy policy</a> | <a href="../terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="../java.js">
</script>
</body>
</html>

