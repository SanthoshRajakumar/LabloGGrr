<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php';
?>

<?php
# Gets first name of active user.
$sql = "SELECT People.FirstName FROM People WHERE People.ID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("s", $_SESSION["userID"]); // Binds parameters

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();


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
  </form>';


  # Only shows manage users if user has role admin.
  if ($_SESSION["roleID"] == 1) {
    echo '<form action="/admin/account/user_management.php" method="GET">
    <button type="submit" class="button button-large">Manage users</button>
    </form>';

    echo '<form action="/admin//product_management.php" method="GET">
    <button type="submit" class="button button-large">Manage products</button>
    </form>';

    echo '<form action="/admin_page.php" method="GET">
    <button type="submit" class="button button-large">Admin suite</button>
    </form>';
  }
  

?>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>