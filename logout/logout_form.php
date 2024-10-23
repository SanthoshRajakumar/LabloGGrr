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
  <h2>Confirm Logout</h2>

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
        <form action="/homepage.php" method="GET">
            <button type="submit" class="button2">No, take me back</button>
        </form>
      </td>
    </tr>
  </table>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
