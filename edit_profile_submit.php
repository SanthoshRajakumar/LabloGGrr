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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Prepare the SQL query to update the user's details
    $sql = "UPDATE People SET FirstName = ?, LastName = ?, Email = ?, UserName = ? WHERE ID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssssi", $firstName, $lastName, $email, $username, $userID);

    // Execute the query
    if ($stmt->execute()) {
        // If the update was successful, show a success message
        $message = "Profile updated successfully!";
    } else {
        // If there was an error, show a failure message
        $message = "Error updating profile. Please try again.";
    }
}

include 'dclose.php';  // Close the database connection
?>

<!-- HTML for the success/failure page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update Status</title>
    <link rel="stylesheet" href="style_.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>Profile Update</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">
    <!-- Display success or failure message -->
    <h2><?php echo htmlspecialchars($message); ?></h2>

    <!-- Button to go back to the homepage -->
    <form action="homepage.php" method="GET">
        <button type="submit" class="button button-large">Go Back to Homepage</button>
    </form>
  </div>
</div>

<div class="footer">
    <h4>&copy; 2024 LabLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a></h4>
</div>

</body>
</html>
