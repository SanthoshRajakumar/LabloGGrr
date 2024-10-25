<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

$namePattern = "/^[a-zA-Z'-]+$/";  // Only letters, apostrophes, and hyphens for names
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Email format
$usernamePattern = "/^[a-zA-Z0-9_]{3,15}$/";  // Alphanumeric, underscores, 3-15 characters
$passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/";  // At least 8 chars, 1 letter, 1 number, 1 special char
# Styling
$pageTitle = "Login";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


<h2>Sign in here</h2>
<?php
if(isset($_SESSION['message'])){
  $message = $_SESSION['message'];
  echo "$message";
  unset($_SESSION['message']);
}
?>
<div class="div_login">
<?php echo ' <form action="/login/backend/login.php" method="POST">'; ?>
    <label for="username">Username</label>
    <input type="text" placeholder="Enter username" name="username" required/><br />
            
    <label for="password">Password</label>
    <input type="password" placeholder="Enter password" name="password" required /><br />
    <div class="form-footer">
      <a href="/login/forgot_password.php">Forgot your password?</a>
      <button type="submit" class="button button-large">Login</button>
    </div>
</form>
</div>
<br><br><button class="button button-small" onclick="window.location.href='/index.php'">Back</button>


<?php

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>