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
    <title>Inventory</title>
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

# Now with prepared statement!
$roomID = isset($_GET['room_id']) ? $_GET['room_id'] : die("room_id saknas");
$sql = "SELECT Product.ProductName, Product.Volume, Product.Mass, Product.Pieces, ProductLocation.Quantity, Product.ID
        FROM Product
        INNER JOIN ProductLocation ON Product.ID = ProductLocation.ProductID 
        WHERE ProductLocation.RoomID = ?";

$stmt = $link->prepare($sql);

$stmt->bind_param("i", $roomID);

$stmt->execute();

$result = $stmt->get_result();

if (!$result) {
    die("fan också: " . $link->error);
}

# Edit and add.
if ($access <= 2) {



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
            echo "<td><form action='update_product_quantity.php' method='post'>
            <input type='number' min='0' value='" . $row['Quantity'] . "' name='quantNew'>
            <input type='submit' value='Update quantity'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='hidden' value='" . $roomID . "' name='room_id'></form></td>";
            echo "</tr>";
        }
    }
    echo "</tbody></table><br><br>";

    

    # Table to enter new products.
    echo "<table border='1'>";
    echo "<thead><tr><th>Product</th><th>Quantity</th><th>Confirm</th></tr></thead>";
    echo "<tbody>";

    echo "<form action='add_product_to_location.php' method='post'>";
    echo "<tr>";
    echo "<td><select name='prodID'>";

    $sql = "SELECT ID, ProductName FROM Product";
    $stmt = $link->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["ID"] . ">" . $row["ProductName"] . "</option>";
        }
    }

    echo "</select></td>";
    echo "<td><input type='number' min=0 name='quantity'></td>";
    echo "<input type='hidden' value='" . $roomID . "' name='room_id'>";
    echo "<td><input type='submit' value='Enter product'></td>";
    echo "</form></td>";

    echo "</tr>";
    echo "</form>";

    echo "</tbody></table>";


    # Garbage bad nono-use.
    /*echo "<form action='add_product.php' method='post'>";
    echo "<tr>";
    echo "<td><select name='prodType'>";

    $sql = "SELECT ID, ProductType FROM ProductType";
    $stmt = $link->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["ID"] . ">" . $row["ProductType"] . "</option>";
        }
    }

    echo "</select></td>";
    echo "<td><input type='text' name='prodName'></td>";
    echo "<td><input type='number' name='volume'></td>";
    echo "<td><input type='number' name='mass'></td>";
    echo "<td><input type='number' name='pieces'></td>";
    echo "<td><input type='number' name='quantity'></td>";
    echo "<td><input type='submit' value='Enter product'></td>";
    echo "<input type='hidden' value='" . $roomID . "' name='room_id'></form></td>";*/

}
# Reduce/edit only.
elseif ($access == 3) {
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
            echo "<td><form action='update_product_quantity.php' method='post'>
            <input type='number' min='0' max='" . $row['Quantity'] . "' value='" . $row['Quantity'] . "' name='quantNew'>
            <input type='submit' value='Update quantity'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='hidden' value='" . $roomID . "' name='room_id'></form></td>";
            echo "</tr>";
        }
    }
    echo "</tbody></table>";
}
# View only.
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
    echo "</tbody></table>";
}

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

<div class="footer">
  <h4> &copy; 2024 LabbLoGGr | Privacy policy | Terms & Condition </h4>
</div>

<script src="java.js">
</script>

</body>
</html>