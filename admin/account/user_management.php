<?php
# Connect to database and start session.
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if ($_SESSION['roleID'] != 1) {
	header("Location: /homepage.php");

  include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
	exit();
}
# Styling
$pageTitle = "Manage Users";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 

?>


<div class="div1">
<body>
  <form action="./create_account.php" method="GET">
    <button type="submit" class="button button-large">Create user</button>
  </form>
  <form action="./manage_users.php" method="GET">
    <button type="submit" class="button button-large">Edit room access</button>
  </form>



  </div>

<!-- Back Button -->
<button class="button button-small" onclick="window.location.href='/admin/admin_page.php'">Back to admin suite</button>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="/site_info/privacy_policy.php">Privacy policy</a> | <a href="/site_info/terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="/styling/java.js">
</script>

</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>