<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
include $_SERVER['DOCUMENT_ROOT'] . '/account/functions.php';
$email = $_POST['email'];

$sql = "SELECT ID, Salt FROM People WHERE email = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
    
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $ID = $row["ID"];
    $salt = $row["Salt"];
    $password = generatePassword();
    $hash = md5($salt . $password . $salt);

    $sql = "INSERT INTO People (HashCode) VALUES (?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $hashcode);
    $stmt->execute();

    sendEmail($email, "New password", "Your new password is $password", "Your new password is $password");
    $_SESSION['message'] = "A new password has been send to your email!";
    header("Location: ../forgot_password.php");
} else {
    $_SESSION['message'] = "Incorrect email, please try again!";
    header("Location: ../forgot_password.php");
}
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>