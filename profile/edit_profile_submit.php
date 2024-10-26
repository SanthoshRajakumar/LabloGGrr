<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';  // Include the database connection
# Include styling

include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login_page.php");
    exit();
}

// Get the userID from the session
$userID = $_SESSION["userID"];

// Fetch current user details including username
$sql = "SELECT FirstName, LastName, Email, UserName FROM People WHERE ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($currentFirstName, $currentLastName, $currentEmail, $currentUsername);
$stmt->fetch();
$stmt->close();

$namePattern = "/^[a-zA-Z'-. ]+$/";  // Allow letters, apostrophes, hyphens, periods, and spaces
$emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";  // Valid email format

// Initialize an array to store error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form values
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));

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
        $sql = "UPDATE People SET FirstName = ?, LastName = ?, Email = ? WHERE ID = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $userID);

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
?>

    <!-- Display success or failure message -->
    <h2><?php if (isset($message)) echo htmlspecialchars($message); ?></h2>

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