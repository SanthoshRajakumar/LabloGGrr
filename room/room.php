<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$_SESSION["userID"] = $_SESSION["userID"] ?? FALSE;

if (!$_SESSION["userID"]) {
    echo "<h1>Oopsie! You should probably log in first.</h1>";
    echo "<a href=" . '"/login/login.php"' . ">Go here!</a>";
}
else {
    // Kontrollera om användaren är admin
    $isAdmin = isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1;

    // SQL-fråga för att hämta rum
    if ($isAdmin) {
        // Admin kan se både aktiva och inaktiva rum
        $sql = "SELECT ID AS RoomID, RoomName, Active 
                FROM Rooms
                INNER JOIN Access ON Access.RoomID = ID
                WHERE Access.PeopleID = ?";  // Ingen filter på Active
    } else {
        // Icke-admin kan bara se aktiva rum
        $sql = "SELECT ID AS RoomID, RoomName
                FROM Rooms
                INNER JOIN Access ON Access.RoomID = ID
                WHERE Access.PeopleID = ? AND Rooms.Active = 1";  // Filter för att bara visa aktiva rum
    }

    // Förbered och exekvera SQL-frågan
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $_SESSION["userID"]);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        // Det finns rum att visa
    } else {
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
            <thead><tr><th>Room Name</th>";

    // Visa Status-kolumnen endast om användaren är admin
    if ($isAdmin) {
        echo "<th>Status</th>";
    }

    echo "<th>Press to view inventory</th></tr></thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['RoomName'] . "</td>";

        // Visa status endast om användaren är admin
        if ($isAdmin) {
            $status = $row['Active'] ? "Active" : "Inactive";
            echo "<td>" . $status . "</td>";
        }

        echo "<td>
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

if ($isAdmin) {
    // Endast admin kan se knapparna för att skapa och ta bort rum
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