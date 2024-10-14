<?php
session_start();
include 'dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

$userID = $_SESSION["userID"]; // Get user ID from session

// Get the new password and confirmation password from the form
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Checking if the passwords match
if ($new_password !== $confirm_password) {
    $_SESSION['reset_message'] = "Passwords do not match!";
    header("Location: reset_password.php");  // Redirect back to reset password form
    exit();
}

// Fetch the user's salt from the database using userID
$sql = "SELECT Salt FROM People WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the salt for the user
    $row = $result->fetch_assoc();
    $salt = $row['Salt'];

    // Hash the new password using the existing salt
    $hash = md5($salt . $new_password . $salt);

    // Update the password in the database
    $sql = "UPDATE People SET HashCode = ? WHERE ID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("si", $hash, $userID);

    if ($stmt->execute()) {
        $_SESSION['reset_message'] = "Password successfully updated.";
    } else {
        $_SESSION['reset_message'] = "Error updating password. Please try again.";
    }
} else {
    $_SESSION['reset_message'] = "User not found.";
}

// Redirect to a result page
header("Location: password_reset_result.php");
exit();

include 'dclose.php';  // Close the database connection
?>
