<form action="/backend/forgot_password.php" method="POST">
<label for="email">Email</label>
<input type="email" placeholder="Enter email" name="email" required/><br />
<input type="submit" value="Reset password"/>
</form>

<?php
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "$message";
    unset($_SESSION['message']);
}
?>