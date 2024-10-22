<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$_SESSION["userID"] = $_SESSION["userID"] ?? FALSE;

$_SESSION["studentkey"] = $_SESSION["studentkey"] ?? FALSE;

if ($_SESSION["userID"]) {
    echo $_SESSION["userID"];
    $sql = "SELECT ID AS RoomID, RoomName
            FROM Rooms
            INNER JOIN Access ON Access.RoomID = ID
            WHERE Access.PeopleID = ? AND Rooms.Active = 1"; 
    $stmt = $link->prepare($sql);
    $stmt -> bind_param("i", $_SESSION["userID"]);
    $stmt -> execute();
    $result = $stmt -> get_result(); 

    if ($result->num_rows < 1) {
        echo "<h1>aaaw man you got no rooms</h1>";
        }
}

if ($_SESSION["studentkey"]) {
    $sql = "SELECT Rooms.ID as RoomID, Rooms.RoomName, AccessLevel.AccessLevel 
    FROM StudentAccess 
    JOIN Rooms ON StudentAccess.RoomID = Rooms.ID 
    JOIN AccessLevel ON StudentAccess.AccessID = AccessLevel.ID 
    WHERE StudentAccess.KeyID = ?";

    # Prepare the statement.
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $_SESSION["studentKey"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        echo "<h1>aaaw man you got no rooms</h1>";
        }
}
$pageTitle = "Rooms";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


<div class="topnav">
  <!-- Global Search Form -->
  <form action="../inventory/backend/global_search.php" method="get">
        <input type="text" name="search" placeholder="Search for products..." required>
    </form>
</div>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <thead><tr><th>Room Name</th><th>Press to view inventory</th></tr></thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['RoomName'] . "</td>
                <td>
                    <form action='/inventory/inventory.php' method='get'>
                        <input type='hidden' name='room_id' value='" . $row['RoomID'] . "'>
                        <input type='submit' class='button button-small' value='View Inventory'>
                    </form>
                </td>
              </tr>"; 
    }
    echo "</tbody></table>";
} else {
    echo "<p style='text-align: center;'>0 results</p>";
}

if (isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
  echo '<form action="/room/new_room_form.php" method="GET">
          <button type="submit" class="button button-large">Create New Room</button>
        </form>';

  echo '<form action="/room/delete_room_form.php" method="GET">
          <button type="submit" class="button button-large">Delete Room</button>
        </form>';
}
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';

?>
