<?php
session_start();
if (!isset($_SESSION["studentkey"]) && !isset($_SESSION["userID"])) {
    header('Location: /index.php');
    exit();
}
if (isset($_GET['room_id'])) {
    echo 'Received room_id: ' . htmlspecialchars($_GET['room_id']);
}
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$isTeacher = isset($_SESSION['userID']) && isset($_SESSION['roleID']) && ($_SESSION['roleID'] === 2 || $_SESSION['roleID'] == 3);
$isStudent = isset($_SESSION['studentkey']) && isset($_SESSION['roleID']) && $_SESSION['roleID'] === 4;

if($isTeacher){
    $sql = "SELECT ID AS RoomID, RoomName
            FROM Rooms
            INNER JOIN Access ON Access.RoomID = ID
            WHERE Access.PeopleID = ? AND Rooms.Active = 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $_SESSION['userID'] );
    $stmt->execute();
    $result = $stmt->get_result(); 
} else {

    $sql = "SELECT ID AS RoomID, RoomName
            FROM Rooms
            INNER JOIN StudentAccess ON StudentAccess.RoomID = ID
            WHERE StudentAccess.KeyID = ? AND Rooms.Active = 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $_SESSION['studentkey'] );
    $stmt->execute();
    $result = $stmt->get_result();   
}

$pageTitle = "Rooms";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<div class="topnav">

  <form action="../inventory/backend/global_search.php" method="get">
        <input type="text" name="search" placeholder="Search for products..." required>
    </form>
</div>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <thead><tr><th>Room Name</th>";




    echo "<th>Press to view inventory</th></tr></thead>
            <tbody>";

    while ($rowz = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $rowz['RoomName'] . "</td>";

        echo "<td>
                <form action='/inventory/inventory.php' method='get'>
                    <input type='hidden' name='room_id' value='" . $rowz['RoomID'] . "'>
                    <input type='submit' class='button button-small' value='View Inventory'>
                </form>
              </td>
              </tr>"; 
    }
    echo "</tbody></table>";
} else {
    echo "<p style='text-align: center;'>0 results</p>";
}

if ($_SESSION["roleID"] == 2) {

    echo '<form action="/studentkey/manage_keys.php" method="GET">
    <button type="submit" class="button button-large">Manage keys</button>
    </form>';
}


if ($isStudent){
    echo '<form action="/studentkey/backend/exit.php" method="GET">
          <button type="submit" class="button button-large">Exit</button>
          </form>';
}
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>