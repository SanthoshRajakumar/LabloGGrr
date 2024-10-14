<?php
session_start();
include 'dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

// Get the userID from the session
$userID = $_SESSION["userID"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style_.css"> 
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>Reset Password</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

    <!-- Password Reset Form -->
    <form action="reset_password_submit.php" method="POST">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" placeholder="Enter new password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required><br>

        <!-- Submit button to update password -->
        <button type="submit" class="button button-large">Reset Password</button>
    </form>

  </div>
</div>

<div class="footer">
    <h4>&copy; 2024 LabLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a></h4>
</div>

</body>
</html>

<?php
include 'dclose.php';  
?>
