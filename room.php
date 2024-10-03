<?php
include 'dopen.php';
session_start();
if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$_SESSION["userID"] = $_SESSION["userID"] ?? FALSE;

if (!$_SESSION["userID"]) {
    echo "<h1>Oopsie! You should probably log in first.</h1>";
    echo "<a href=" . '"login_page.php"' . ">Go here!</a>";
}
else {
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
    <title>Roooms</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr</h1>
    <h2></h2>
  </div>
</div>


<!-- Content Section -->
<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
<form action="index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header>

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

<div class="footer">
  <h4> &copy; 2024 LabbLoGGr | Privacy policy | Terms & Condition </h4>
</div>

<script src="java.js">
</script>

</body>
</html>