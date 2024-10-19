<?php
# Connect to database and start session.
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();

# Kills connectin on connection error.
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error()); # script stops
}

if ($_SESSION['roleID'] != 1) {
	header("Location: /homepage.php");
	exit();
}

# Styling
$pageTitle = "Product Management";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<div class="div1">
<body>
  <form action="" method="GET">
  	<select>
  		<?php

      $sql = "SELECT Product.ProductName, Product.Volume, Product.Mass, Product.Pieces, ProductLocation.Quantity, Product.ID
        FROM Product";

      $stmt = $link->prepare($sql);

      $stmt->execute();

      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) 
        {
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
            </form><form action='/inventory/backend/remove_product_from_room.php' method='post'>
            <input type='hidden' value='" . $roomID . "' name='room_id'>
            <input type='hidden' value='" . $row['ID'] . "' name='prodID'>
            <input type='submit' value='Delete'></form></td>";
        }
      }

  		?>
  	</select>
    <button type="submit" class="button button-large">List products by type</button>
  </form>
  </div>

<!-- Back Button -->
<button class="button button-small" onclick="window.location.href='/admin/admin_page.php'">Back to homepage</button>


<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>