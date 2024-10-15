<?php
session_start();
include 'dopen.php';

if (!$link) { die("Connection failed: " . mysqli_connect_error()); }

$_SESSION["userID"] = $_SESSION["userID"] ?? FALSE;

if (!$_SESSION["userID"]) {
    echo "<h1>Oopsie! You should probably log in first.</h1>";
    echo "<a href=" . '"login_page.php"' . ">Go here!</a>";
    exit();
}
else {
$sql = "SELECT ID AS RoomID, RoomName
        FROM Rooms
        INNER JOIN Access ON Access.RoomID = ID
        WHERE Access.PeopleID = ?"; // Fixade SQL-fråga
$stmt = $link->prepare($sql);
$stmt -> bind_param("i", $_SESSION["userID"]);
$stmt -> execute();
$result = $stmt -> get_result(); 

if ($result->num_rows > 0) {

    }
else { echo "<h1>aaaw man you got no rooms</h1>";
          
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roooms</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
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
    <form action="../site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header>

<div class="topnav">
  <!-- Global Search Form -->
  <form action="global_search.php" method="get">
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
                    <form action='inventory.php' method='get'>
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

include 'dclose.php';

?>
</body>
</html>


<!-- Back Button -->
<!--
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
<body> -->

<button onclick="window.location.href='homepage.php'" class="button button-small" >Back to Home</button>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="java.js">
</script>

</body>
</html>