<?php
include '/Users/johaneliasson/Desktop/LabLoGGr/login/login.php';
if (!$link) { die("Connection failed: " . mysqli_connect_error()); }
$sql = "SELECT Rooms.RoomName, ProductLocation.RoomID FROM Rooms LEFT JOIN ProductLocation ON Rooms.RoomName = ProductLocation.RoomID"; // Fixade SQL-fråga
$result = $link->query($sql); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
</head>
<body>
<h1>All rooms</h1>
<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <thead><tr><th>Room Name</th><th>Press to view inventory</th></tr></thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['RoomName'] . "</td>
                <td>
                    <form action='inventory.php' method='get'>
                        <input type='hidden' name='room_id' value='" . $row['RoomID'] . "'>
                        <input type='submit' value='View Inventory'>
                    </form>
                </td>
              </tr>"; 
    }
    echo "</tbody></table>";
} else {
    echo "<p style='text-align: center;'>0 results</p>";
}

if ($link)
    $link->close();
?>
</body>
</html>


