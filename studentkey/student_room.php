<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$_SESSION["studentKey"] = $_SESSION["studentKey"];

if (!$_SESSION["studentKey"]) {
    echo "<h1>Oopsie! You should probably log in first.</h1>";
    echo "<a href=" . '"login_page.php"' . ">Go here!</a>";
    exit();
}

else {
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

if ($result->num_rows > 0) {

    }
else { echo "<h1>aaaw man you got no rooms</h1>";
          
    }
}

# Styling
$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <thead><tr><th>Room Name</th><th>Press to view inventory</th></tr></thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['RoomName'] . "</td>
                <td>
                    <form action='/studentkey/student_inventory.php' method='get'>
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


include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>

<button onclick="window.location.href='homepage.php'" class="button button-small" >Back to Home</button>
