<?php
# Connect to database and start session.

session_start();

if (!isset($_SESSION["studentkey"]) && !isset($_SESSION["userID"])) {
    header('Location: ../../index.php');
}

if (isset($_SESSION["studentkey"])){
    $sql = "SELECT * FROM StudentKey WHERE StudentKey.ID = ?";
    $stmt = $link->prepare($sql);
    
    $stmt->bind_param("s", $_SESSION["studentkey"]); // Binds parameters
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

}


if (isset($_SESSION["userID"])){
    # Gets first name of active user.
$sql = "SELECT * FROM People WHERE People.ID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("s", $_SESSION["userID"]); // Binds parameters

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();


}
?>