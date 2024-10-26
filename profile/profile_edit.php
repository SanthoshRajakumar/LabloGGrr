<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection

# Include styling
$pageTitle = "Edit profile";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';


// Check if the user is logged in by verifying the session
if (!isset($_SESSION["userID"])) {
    header("Location: /login/login.php"); // Redirect to login if not logged in
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
  
  <h2>Edit Profile</h2>

    <!-- Display a welcome message to the user -->
    <h3>Welcome to the Edit Profile page, <?php echo htmlspecialchars($user['FirstName']); ?>!</h3>

<!-- Profile Edit Form -->
<form action="edit_profile_submit.php" method="POST">
    <!-- Label for First Name -->
    <label for="first_name">First Name:</label>
    <!-- Input field pre-filled with user's First Name from the database -->
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['FirstName']); ?>" placeholder="First Name" required><br>

    <!-- Label for Last Name -->
    <label for="last_name">Last Name:</label>
    <!-- Input field pre-filled with user's Last Name from the database -->
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['LastName']); ?>" placeholder="Last Name" required><br>

    <!-- Label for Email -->
    <label for="email">Email:</label>
    <!-- Input field pre-filled with user's Email from the database -->
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" placeholder="Email" required><br>

    <!-- Submit button to update profile -->
    <button type="submit" class="button button-large">Update Profile</button>
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
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';  // Close the database connection
?>
