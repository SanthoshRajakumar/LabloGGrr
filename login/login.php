<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Styling
$pageTitle = "Login";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


<h2>Sign in here</h2>
<div class="div_login">
<?php echo ' <form action="/login/backend/login.php" method="POST">'; ?>
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

if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "$message";
    unset($_SESSION['message']);
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>