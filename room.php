<?php
include 'dopen.php';
session_start();
if (!$link) { die("Connection failed: " . mysqli_connect_error()); }
$sql = "SELECT ID AS RoomID, RoomName
        FROM Rooms
        INNER JOIN Access ON Access.RoomID = ID
        WHERE Access.PeopleID =" . $_SESSION["userID"]; // Fixade SQL-fråga
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
                    <form action='inventory.php' method='post'>
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

include 'dclose.php';

?>
</body>
</html>


<!-- Back Button -->

<!DOCTYPE html>
<html>
<head>
    <style>
        .button {
            background-color: #708090; 
            border: none;              
            color: white;              
            padding: 10px 20px;        
            text-align: center;        
            text-decoration: none;     
            display: inline-block;     
            font-size: 12px;           
            margin: 5px 2px;         
            cursor: pointer;           
            border-radius: 10px;       
            transition: background-color 0.3s ease; 
        }

        .button:hover {
            background-color: #708090; 
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <button class="button" onclick="window.location.href='homepage.php'">Back to Home</button>
</body>
</html>