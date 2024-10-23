<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

// Get the userID from the session
$userID = $_SESSION["userID"];

$namePattern = "/^[a-zA-Z'-]+$/";  // Only letters, apostrophes, and hyphens for names
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";  // Valid email format

// Initialize an array to store error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form values
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));

    // Validate first name
    if (!preg_match($namePattern, $firstName)) {
      $errors[] = "Invalid first name. Only letters, apostrophes, and hyphens are allowed.";
  }

  // Validate last name
  if (!preg_match($namePattern, $lastName)) {
      $errors[] = "Invalid last name. Only letters, apostrophes, and hyphens are allowed.";
  }

  // Validate email
  if (!preg_match($emailPattern, $email)) {
      $errors[] = "Invalid email format.";
  }

      // If there are no validation errors, prepare the SQL query to update the user's details
    if (empty($errors)) {
      $sql = "UPDATE People SET FirstName = ?, LastName = ?, Email = ?, UserName = ? WHERE ID = ?";
      $stmt = $link->prepare($sql);
      $stmt->bind_param("ssssi", $firstName, $lastName, $email, $username, $userID);

      // Execute the query
      if ($stmt->execute()) {
          $message = "Profile updated successfully!";
      } else {
          $message = "Error updating profile. Please try again.";
      }
  } else {
      // If there are validation errors, concatenate them into a single message
      $message = implode("<br>", $errors);
  }
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';  // Close the database connection
?>

<!-- HTML for the success/failure page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update Status</title>
    <link rel="stylesheet" href="/styling/style_.css"> <!-- Link to your CSS file -->
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
    <form action="/homepage.php" method="GET">
        <button type="submit" class="button button-large">Go Back to Homepage</button>
    </form>
  </div>
</div>

<div class="footer">
    <h4>&copy; 2024 LabLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a></h4>
</div>

</body>
</html>
