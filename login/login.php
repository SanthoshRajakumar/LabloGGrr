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

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve and sanitize input values to prevent XSS
  $username = htmlspecialchars(trim($_POST['username']));
  $password = htmlspecialchars(trim($_POST['password']));

if (!preg_match($usernamePattern, $username)) {
  die("Invalid username. Must be 3-15 characters long and contain only letters, numbers, or underscores.");
}
 // Validate password
 if (!preg_match($passwordPattern, $password)) {
  die("Invalid password. Must be at least 8 characters long, include at least one letter, one number, and one special character.");
}
}
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "$message";
    unset($_SESSION['message']);
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>