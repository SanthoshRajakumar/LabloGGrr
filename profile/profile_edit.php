<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection

$namePattern = "/^[a-zA-ZÀ-ÿ' -]+$/";  // Only letters, apostrophes, and hyphens for names
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Email format


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
        <label for="first_name"><?php echo htmlspecialchars($user['FirstName']); ?></label>
        <input type="text" name="first_name" placeholder="First Name" required><br>

        <label for="last_name"><?php echo htmlspecialchars($user['LastName']); ?></label>
        <input type="text" name="last_name" placeholder="Last Name" required><br>

        <label for="email"><?php echo htmlspecialchars($user['Email']); ?></label>
        <input type="email" name="email" placeholder="Email" required><br>

        <!-- Submit button to update profile -->
        <button type="submit" class="button button-large">Update Profile</button>
    </form>
    <!-- Back Button -->
    <br><br><button class="button button-small" onclick="window.location.href='/homepage.php'">Back to homepage</button>

    </div>
</div>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve updated form values
  $firstName = htmlspecialchars(trim($_POST['first_name']));
  $lastName = htmlspecialchars(trim($_POST['last_name']));
  $email = htmlspecialchars(trim($_POST['email']));
// Validate first name
if (!preg_match($namePattern, $firstName)) {
  die("Invalid first name. Only letters, apostrophes, and hyphens are allowed.");
}

// Validate last name
if (!preg_match($namePattern, $lastName)) {
  die("Invalid last name. Only letters, apostrophes, and hyphens are allowed.");
}

// Validate email
if (!preg_match($emailPattern, $email)) {
  die("Invalid email format.");
}
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Include styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';  // Close the database connection
?>
