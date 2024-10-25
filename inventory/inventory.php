<!-- GABRIEL -->
<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
include $_SERVER['DOCUMENT_ROOT'] . '/account.php';

$pageTitle = "Inventory";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 

if (!$link) { die("HELVETE: " . mysqli_connect_error()); } 

if(isset($_SESSION['userID'])) {
    $sql = "SELECT Access.AccessID, Rooms.Active FROM Access 
            INNER JOIN Rooms ON Rooms.ID = Access.RoomID 
            WHERE PeopleID = ? AND RoomID = ?";
} elseif (isset($_SESSION['studentkey'])) {
    $sql = "SELECT StudentAccess.AccessID, Rooms.Active FROM StudentAccess 
            INNER JOIN Rooms ON Rooms.ID = StudentAccess.RoomID 
            WHERE KeyID = ? AND RoomID = ?"; 
}
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $row['ID'], $_GET["room_id"]);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$access = $row['AccessID'] ?? FALSE;
$roomActive = $row['Active'] ?? FALSE;

# Redirects back to room.php if room is inactive and user does not have admin access for room.
if ($access == FALSE || ($access > 1 && !$roomActive)) {
    header("Location: /room/room.php");
    exit();
}


$roomID = isset($_GET['room_id']) ? $_GET['room_id'] : die("room_id saknas");

# Find shelves for room.
$sql = "SELECT Shelf.ID, Shelf.Name FROM Shelf WHERE Shelf.RoomID = ?";

$stmt = $link->prepare($sql);
$stmt->bind_param("i", $roomID);

$stmt->execute();

$shelfResult = $stmt->get_result();

if ($shelfResult && $shelfResult->num_rows > 0) {
        while ($shelfRow = $shelfResult->fetch_assoc()) {


$sql = "SELECT Product.ProductName, Product.Volume, Product.Mass, Product.Pieces, ProductLocation.Quantity, Product.ID
        FROM Product
        INNER JOIN ProductLocation ON Product.ID = ProductLocation.ProductID 
        INNER JOIN Rooms ON ProductLocation.RoomID = Rooms.ID
        WHERE ProductLocation.RoomID = ? AND (Rooms.Active = TRUE OR ? = 1) AND ProductLocation.ShelfID = ?"; 

$stmt = $link->prepare($sql);
$stmt->bind_param("iii", $roomID, $access, $shelfRow['ID']);

$stmt->execute();

$result = $stmt->get_result();

if (!$result) { 
    die("fan också: " . $link->error); 
}


if ($access <= 2 || $_SESSION['roleID'] == 1) {
    echo "<h2>" . $shelfRow['Name'] . "</h2>";

    echo "<table border='1'>";
    echo "<thead><tr><th>Product Name</th><th>Volume</th><th>Mass</th><th>Pieces</th><th>Quantity</th><th>Edit</th></tr></thead>";
    echo "<tbody>";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . (isset($row['ProductName']) ? $row['ProductName'] : '') . "</td>";
            echo "<td>" . (isset($row['Volume']) ? $row['Volume'] : '') . "</td>";
            echo "<td>" . (isset($row['Mass']) ? $row['Mass'] : '') . "</td>";
            echo "<td>" . (isset($row['Pieces']) ? $row['Pieces'] : '') . "</td>";
            echo "<td>" . (isset($row['Quantity']) ? $row['Quantity'] : '') . "</td>";
            echo "<td><form action='/inventory/backend/update_product_quantity.php' method='post'>
            <input type='number' min='0' value='" . $row['Quantity'] . "' name='quantNew'>
            <input type='submit' value='Update quantity'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='hidden' value='" . $roomID . "' name='room_id'>
            <input type='hidden' value='" . $shelfRow['ID'] . "' name='shelf_id'>
            </form><form action='/inventory/backend/remove_product_from_room.php' method='post'>
            <input type='hidden' value='" . $roomID . "' name='room_id'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='hidden' value='" . $shelfRow['ID'] . "' name='shelf_id'>
            <input type='submit' value='Delete'></form></td>";
            echo "</tr>";
        }
    }
    echo "</tbody></table><br><br>";


    echo "<table border='1'>";
    echo "<thead><tr><th>Product</th><th>Quantity</th><th>Confirm</th></tr></thead>";
    echo "<tbody>";

    echo "<form action='/inventory/backend/add_product_to_location.php' method='post'>";
    echo "<tr>";
    echo "<td><select name='prodID'>";

    $sql = "SELECT Product.ID, Product.ProductName FROM Product WHERE Product.ID NOT IN (SELECT ProductLocation.ProductID FROM ProductLocation WHERE ProductLocation.RoomID = ?)";
    $stmt = $link->prepare($sql);

    $stmt->bind_param("i", $roomID); 

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
    echo "<input type='hidden' value='" . $shelfRow['ID'] . "' name='shelf_id'>";
    echo "<td><input type='submit' value='Enter product'></td>";
    echo "</form></td>";

    echo "</tr>";
    echo "</form>";

    echo "</tbody></table>";

}

elseif ($access == 3) {
    echo "<h2>" . $shelfRow['Name'] . "</h2>";

    echo "<table border='1'>";
    echo "<thead><tr><th>Product Name</th><th>Volume</th><th>Mass</th><th>Pieces</th><th>Quantity</th><th>Edit</th></tr></thead>";
    echo "<tbody>";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . (isset($row['ProductName']) ? $row['ProductName'] : '') . "</td>";
            echo "<td>" . (isset($row['Volume']) ? $row['Volume'] : '') . "</td>";
            echo "<td>" . (isset($row['Mass']) ? $row['Mass'] : '') . "</td>";
            echo "<td>" . (isset($row['Pieces']) ? $row['Pieces'] : '') . "</td>";
            echo "<td>" . (isset($row['Quantity']) ? $row['Quantity'] : '') . "</td>";
            echo "<td><form action='/inventory/backend/update_product_quantity.php' method='post'>
            <input type='number' min='0' max='" . $row['Quantity'] . "' value='" . $row['Quantity'] . "' name='quantNew'>
            <input type='hidden' value='" . $shelfRow['ID'] . "' name='shelf_id'>
            <input type='submit' value='Update quantity'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>

            <input type='hidden' value='" . $roomID . "' name='room_id'></form></td>";
            echo "</tr>";
        }
    }
    echo "</tbody></table>";
}

else {
    echo "<h2>" . $shelfRow['Name'] . "</h2>";
    
    echo "<table border='1'>";
    echo "<thead><tr><th>Product Name</th><th>Volume</th><th>Mass</th><th>Pieces</th><th>Quantity</th></tr></thead>";
    echo "<tbody>";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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

}
}

?>
<!-- Back Button -->
<br><br><button class="button button-small" onclick="window.location.href='/room/room.php'">Back to rooms</button>
<?php

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
