<?php 
session_start();
if (!isset($_SESSION["userID"])) {
  header('Location: /index.php');
  exit();
}
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
$sql = "SELECT FirstName FROM People WHERE People.ID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("s", $_SESSION["userID"]); // Binds parameters

$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/account.php';

?>

<?php


echo '<h2>Welcome, ' . $row["FirstName"] . '!</h2>';

echo '
  <div class="div1">
<body>
  <form action="/room/room.php" method="GET">
    <button type="submit" class="button button-large">Rooms</button>
  </form>
  <form action="/profile/profile_edit.php" method="GET">
    <button type="submit" class="button button-large">Edit Profile</button>
  </form>
  <form action="/profile/reset_password.php" method="GET">
    <button type="submit" class="button button-large">Reset Password</button>
  </form>
  <form action="/logout/logout_form.php" method="GET">
  <button type="submit" class="button button-large">Logout</button>
</form>';


  # Only shows manage users if user has role admin.
  if ($_SESSION["roleID"] == 1) {

    echo '<form action="/admin/admin_page.php" method="GET">
    <button type="submit" class="button button-large">Admin suite</button>
    </form>';
  }
  

?>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>