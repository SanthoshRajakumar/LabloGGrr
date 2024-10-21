<?php
# Connect to database and start session.
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if (isset($_POST['studentkey']) && !empty($_POST['studentkey'])) {

    # User input.
    $studentkey = $_POST['studentkey'];

    # SQL query to check if the studentkey exists.
    $sql = "SELECT COUNT(*) AS key_exists FROM StudentKey WHERE ID = ?";

    # Prepare the statement.
    if ($stmt = $link->prepare($sql)) {

        # Bind the studentkey parameter.
        $stmt->bind_param("s", $studentkey);

        # Execute the query.
        $stmt->execute();

        # Bind the result to a variable.
        $stmt->bind_result($key_exists);

        # Fetch the result.
        $stmt->fetch();

        # Check if the studentkey exists.
        if ($key_exists > 0) {
            # Set the session variable for studentKey.
            $_SESSION["studentKey"] = $studentkey;

            # Redirect to the next page.
            header('Location: ../student_room.php');
            exit();
        } else {
            $_SESSION["error"] = "The Student Key is invalid. Please try again.";

            header('Location: ../index.php');
            exit();
        }

        # Close the statement.
        $stmt->close();
    }
}
# Closing the statement.
$stmt->close();

include '../dclose.php'

?>