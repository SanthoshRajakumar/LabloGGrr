<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png"> 
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style_.css">
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
<form action="index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header>

<h2>Sign in here</h2>
<div class="div_login">
<form action="/backend/login.php" method="POST">
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

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="java.js">
</script>
</body>
</html>

<?php
session_start();
include 'dopen.php'; // Include your database connection file

// Function to hash password with the user's salt
function hashPassword($password, $salt) {
    return md5($password . $salt);
}

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Prepare a SQL query to find the user by username
    $sql = "SELECT * FROM People WHERE UserName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        $salt = $user['Salt'];
        $hashedPassword = hashPassword($password, $salt);

        // Verify the hashed password with the stored HashCode
        if ($hashedPassword === $user['HashCode']) {
            // Password is correct, start session and redirect to the home page
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['username'] = $user['UserName'];
            $_SESSION['role_id'] = $user['RoleID'];

            // Redirect to home or dashboard page
            header("Location:index.php");
            exit;
        } else {
            // Password is incorrect
            echo "Incorrect password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
} else {
    echo "Please fill in both fields.";
}

?>
