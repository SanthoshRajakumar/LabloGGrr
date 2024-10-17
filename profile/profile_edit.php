<?php 
session_start();
include 'dopen.php';  // Include the database connection

// Check if the user is logged in by verifying the session
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php"); // Redirect to login if not logged in
    exit();
}

// Get the userID from the session
$userID = $_SESSION["userID"];

// Query to fetch all details of the user from the People table using the userID from the session
$sql = "SELECT FirstName, LastName, Email, UserName FROM People WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID); // Bind the userID parameter (integer)

// Execute the query and fetch the result
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data as an associative array
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!-- HTML for displaying the profile edit form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style_.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>Edit Profile</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

    <!-- Display a welcome message to the user -->
    <h2>Welcome to the Edit Profile page, <?php echo htmlspecialchars($user['FirstName']); ?>!</h2>

    <!-- Profile Edit Form -->
    <form action="edit_profile_submit.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" placeholder="First Name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" placeholder="Last Name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" required><br>

        <label for="username">User Name:</label>
        <input type="text" name="username" placeholder="User Name" required><br>

        <!-- Submit button to update profile -->
        <button type="submit" class="button button-large">Update Profile</button>
    </form>

  </div>
</div>

<div class="footer">
    <h4>&copy; 2024 LabLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a></h4>
</div>

</body>
</html>

<?php
include 'dclose.php';  // Close the database connection
?>
