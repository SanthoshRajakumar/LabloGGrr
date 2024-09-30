<!-- GABRIEL -->
<?php 
session_start();
include 'dopen.php';
?>

<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- ELSA (jag testade att lägga in lite kod här för att se om det fungerar.) --> 

<h1 style="font-size: 420">Inventory</h1>
<?php

if (!$link) { die("HELVETE: " . mysqli_connect_error()); }

# Gets access level.
$sql = "SELECT Access.AccessID FROM Access WHERE PeopleID = ? AND RoomID = ?";
$stmt = $link->prepare($sql);

$stmt->bind_param("ss", $_SESSION["userID"], $_GET["room_id"]);

$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$access = $row['AccessID'] ?? FALSE;

# Redirects on no access.
if ($access == FALSE) {
    header("Location: room.php");
    exit();
}

$roomID = isset($_GET['room_id']) ? $_GET['room_id'] : die("room_id saknas");
$sql = "SELECT Product.ProductName, Product.Volume, Product.Mass, Product.Pieces, ProductLocation.Quantity, Product.ID
        FROM Product
        INNER JOIN ProductLocation ON Product.ID = ProductLocation.ProductID 
        WHERE ProductLocation.RoomID = $roomID";
$result = $link->query($sql);
if (!$result) {
    die("fan också: " . $link->error);
}

if ($access <= 3) {



echo "<table border='1'>";
echo "<thead><tr><th>Product Name</th><th>Volume</th><th>Mass</th><th>Pieces</th><th>Quantity</th><th>Edit</th></tr></thead>";
echo "<tbody>";

    if ($result && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>" . (isset($row['ProductName']) ? $row['ProductName'] : '') . "</td>";
            echo "<td>" . (isset($row['Volume']) ? $row['Volume'] : '') . "</td>";
            echo "<td>" . (isset($row['Mass']) ? $row['Mass'] : '') . "</td>";
            echo "<td>" . (isset($row['Pieces']) ? $row['Pieces'] : '') . "</td>";
            echo "<td>" . (isset($row['Quantity']) ? $row['Quantity'] : '') . "</td>";
            echo "<td><form action='update_product_quantity.php' method='post'><input type='number' name='quantNew'><input type='submit' value='Update quantity'><input type='hidden' value='" . $row['ID'] . "' name='prodID'><input type='hidden' value='" . $roomID . "' name='room_id'></form></td>";
            echo "</tr>";
        }
    }

}

else {
echo "<table border='1'>";
echo "<thead><tr><th>Product Name</th><th>Volume</th><th>Mass</th><th>Pieces</th><th>Quantity</th></tr></thead>";
echo "<tbody>";

    if ($result && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>" . (isset($row['ProductName']) ? $row['ProductName'] : '') . "</td>";
            echo "<td>" . (isset($row['Volume']) ? $row['Volume'] : '') . "</td>";
            echo "<td>" . (isset($row['Mass']) ? $row['Mass'] : '') . "</td>";
            echo "<td>" . (isset($row['Pieces']) ? $row['Pieces'] : '') . "</td>";
            echo "<td>" . (isset($row['Quantity']) ? $row['Quantity'] : '') . "</td>";
            echo "</tr>";
        }
    

    } else {
        echo "<tr><td colspan='4'>No products found for this room.</td></tr>";
    }
}
echo "</tbody></table>";
include 'dclose.php';
?>
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
    <button class="button" onclick="window.location.href='room.php'">Back to Rooms</button>
</body>
</html>
