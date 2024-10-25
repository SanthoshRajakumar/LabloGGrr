<?php
session_start();
if (!isset($_SESSION["studentkey"]) && !isset($_SESSION["userID"])) {
    header('Location: /index.php');
    exit();
}
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/room/backend/account.php';
if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$isAdmin = isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1;
$isStudent = isset($_SESSION['roleID']) && $_SESSION['roleID'] == 4;
    
    if ($isAdmin) {
        $sql = "SELECT ID AS RoomID, RoomName, Active 
                FROM Rooms
                INNER JOIN Access ON Access.RoomID = ID
                WHERE Access.PeopleID = ?";  
    } elseif (isset($_SESSION['userID'])) {

        $sql = "SELECT ID AS RoomID, RoomName
                FROM Rooms
                INNER JOIN Access ON Access.RoomID = ID
                WHERE Access.PeopleID = ? AND Rooms.Active = 1";  
    } elseif (isset($_SESSION['studentkey'])) {

        $sql = "SELECT ID AS RoomID, RoomName
                FROM Rooms
                INNER JOIN StudentAccess ON StudentAccess.RoomID = ID
                WHERE StudentAccess.KeyID = ? AND Rooms.Active = 1";  
    }


    $stmt = $link->prepare($sql);
    $stmt->bind_param("i",$row['ID'] );
    $stmt->execute();
    $result = $stmt->get_result(); 


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


    if ($isAdmin) {
        echo "<th>Status</th>";
    }

    echo "<th>Press to view inventory</th></tr></thead>
            <tbody>";

    while ($rowz = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $rowz['RoomName'] . "</td>";


        if ($isAdmin) {
            $status = $rowz['Active'] ? "Active" : "Inactive";
            echo "<td>" . $status . "</td>";
        }

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

if ($isAdmin) {

    echo '<form action="/room/new_room_form.php" method="GET">
            <button type="submit" class="button button-large">Create New Room</button>
          </form>';

    echo '<form action="/room/toggle_room_form.php" method="GET">
            <button type="submit" class="button button-large">Toggle Room</button>
          </form>';
}

if (!$isStudent){
echo '<br><br><button class="button button-small" onclick="window.location.href=\'/homepage.php\'">Back to homepage</button>';
}

if ($isStudent){
    unset($_SESSION['roleID']);
    unset($_SESSION['studentkey']);
    echo '<br><br><button class="button button-small" onclick="window.location.href=\'/index.php\'">Exit</button>';
}

?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>