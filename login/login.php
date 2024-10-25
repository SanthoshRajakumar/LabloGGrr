<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

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
    <input type="text" placeholder="Enter username" name="username" id="username" required/><br />
            
    <label for="password">Password</label>
    <input type="password" placeholder="Enter password" name="password" id="password" required/><br />
    <div class="form-footer">
      <a href="/login/forgot_password.php">Forgot your password?</a>
      <button type="submit" class="button button-large">Login</button>
    </div>
</form>
</div>
<br><br><button class="button button-large" onclick="window.location.href='/index.php'">Back</button>


<?php

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>

<script>
    const usernameInput = document.getElementById('username');
    //const lnameInput = document.getElementById('lname');

    // Function to automatically format username input
    function formatUsername(username){
        const formattedUsername = username.replace(/[^a-zA-ZÀ-ÿ0-9\s-]/g, ''); // Remove numeric and special characters
        return formattedUsername.slice(0, 8);
    }

    // Event listener for Firstname input
    usernameInput.addEventListener('input', function() {
        usernameInput.value = formatUsername(usernameInput.value); 
    });
</script>