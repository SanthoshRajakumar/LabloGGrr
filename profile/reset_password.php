<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

# Include styling
$pageTitle = "Reset Password";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

// Display session message if it exists
if (isset($_SESSION['reset_message'])) {
  echo '<p style="color: red;">' . htmlspecialchars($_SESSION['reset_message']) . '</p>';
  unset($_SESSION['reset_message']);  // Clear message after displaying
}

// Get the userID from the session
$userID = $_SESSION["userID"];

?>
  <h2>Reset Password</h2>
<!-- Password Reset Form -->
<form action="password_reset_submit.php" method="POST">
    <label for="current_password">Current Password:</label>
    <input type="password" name="current_password" placeholder="Enter current password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" placeholder="Enter new password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" placeholder="Confirm new password" required><br>

    <!-- Submit button to update password -->
    <button type="submit" class="button button-large">Reset Password</button>
</form>


    <!-- Back Button -->
<?php
    if($userID === 1){
      echo '<br><br><button class="button button-large" onclick="window.location.href=\'/admin/admin_page.php\'">Back</button>';
    } else {
      echo '<br><br><button class="button button-large" onclick="window.location.href=\'/room/room.php\'">Back</button>';
    }
    ?>

  </div>
</div>

</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Include styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
