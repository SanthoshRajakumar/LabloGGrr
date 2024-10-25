<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

$userID = $_SESSION["userID"];

// Get the current password, new password, and confirmation password from the form
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Checking if the new passwords match
if ($new_password !== $confirm_password) {
    $_SESSION['reset_message'] = "New passwords do not match!";
    header("Location: reset_password.php");
    exit();
}

// Fetch the user's salt and current hash from the database using userID
$sql = "SELECT Salt, HashCode FROM People WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the salt and current hash for the user
    $row = $result->fetch_assoc();
    $salt = $row['Salt'];
    $current_hash = $row['HashCode'];

    // Verify the current password
    if ($current_hash !== md5($salt . $current_password . $salt)) {
        $_SESSION['reset_message'] = "Current password is incorrect.";
        header("Location: reset_password.php");
        exit();
    }

    // Hash the new password using the existing salt
    $new_hash = md5($salt . $new_password . $salt);

    // Update the password in the database
    $sql = "UPDATE People SET HashCode = ? WHERE ID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("si", $new_hash, $userID);

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

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
    