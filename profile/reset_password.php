<?php
session_start();
include 'dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

# Include styling
$pageTitle = "Reset Password";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

// Get the userID from the session
$userID = $_SESSION["userID"];

?>
  <h2>Reset Password</h2>

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

</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Include styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
