
<?php
# Styling
$pageTitle = "Login";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


<form action="./backend/forgot_password.php" method="POST">
<label for="email">Email</label>
<input type="email" placeholder="Enter email" name="email" required/><br />
<input type="submit" value="Reset password" class="button button-large"/>
</form>

<?php
session_start();

if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "$message";
    unset($_SESSION['message']);
}
?>

<form action="./login.php">
    <br><br><button type="submit" class="button button-large">Back</button>
</form>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
?>