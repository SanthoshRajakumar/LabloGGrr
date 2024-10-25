<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID'])) {
    header("Location: /index.php");
    exit();
}

$pageTitle = "Log Out";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>
  <h3>Confirm Logout</h3>

  <table border="1">
    <tr>
      <th>Action</th>
    </tr>
    <tr>
      <td>
        <form action="/logout/backend/logout.php" method="POST">
            <button type="submit" class="button2">Yes, log me out</button>
        </form>
      </td>
    </tr>
    <tr>
      <td>
    <?php
      if($_SESSION['roleID'] === 1){
      echo '<button class="button2" onclick="window.location.href=\'/admin/admin_page.php\'">Back</button>';
    } else {
      echo '<button class="button2" onclick="window.location.href=\'/room/room.php\'">No, take me back</button>';
    }
    ?>
      </td>
    </tr>
  </table>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
