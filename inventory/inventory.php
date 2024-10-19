<!-- GABRIEL -->
<?php 
session_start();
include 'dopen.php';

# Styling
$pageTitle = "Inventory";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 

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
            <input type='hidden' value='" . $roomID . "' name='room_id'>
            </form><form action='remove_product_from_room.php' method='post'>
            <input type='hidden' value='" . $roomID . "' name='room_id'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='submit' value='Delete'></form></td>";
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

    $sql = "SELECT Product.ID, Product.ProductName FROM Product WHERE Product.ID NOT IN (SELECT ProductLocation.ProductID FROM ProductLocation WHERE ProductLocation.RoomID = ?)";
    $stmt = $link->prepare($sql);

    $stmt->bind_param("s", $roomID);

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["ID"] . ">" . $row["ProductName"] . "</option>";
        }
    }

    echo "</select></td>";
    echo "<td><input type='number' min=0 value=1 name='quantity'></td>";
    echo "<input type='hidden' value='" . $roomID . "' name='room_id'>";
    echo "<td><input type='submit' value='Enter product'></td>";
    echo "</form></td>";

    echo "</tr>";
    echo "</form>";

    echo "</tbody></table>";

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

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include 'dclose.php';
?>
