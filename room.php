<?php
include "login.php";
if (!$link) { die("Connection failed: " . mysqli_connect_error()); }
$sql = "SELECT * FROM Rooms"; // Fixade SQL-fråga
$result = $link->query($sql); 
?>

<!DOCTYPE html>
<html lang="eng">
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
            <thead><tr><th>Room Name</th></tr></thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['RoomName'] . "</td></tr>"; 
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



