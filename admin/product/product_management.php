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

if ($_SESSION['roleID'] != 1) {
  header("Location: /homepage.php");

  include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
  exit();
}
?>



<div class="div1">
<body>
  
  		<?php

      $sql = "SELECT Product.ProductName, Product.Volume, Product.Mass, Product.Pieces, Product.ID, ProductType.ProductType
        FROM Product
        INNER JOIN ProductType ON ProductType.ID = Product.ProductTypeID";

      $stmt = $link->prepare($sql);

      $stmt->execute();

      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Product Name</th><th>Volume (ml)</th><th>Mass (mg)</th><th>Pieces</th><th>ProductType</th><th>ID</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) 
        {
          echo "<tr>";
          echo "<td>" . (isset($row['ProductName']) ? $row['ProductName'] : '') . "</td>";
          echo "<td>" . (isset($row['Volume']) ? $row['Volume'] : '') . "</td>";
          echo "<td>" . (isset($row['Mass']) ? $row['Mass'] : '') . "</td>";
          echo "<td>" . (isset($row['Pieces']) ? $row['Pieces'] : '') . "</td>";
          echo "<td>" . (isset($row['ProductType']) ? $row['ProductType'] : '') . "</td>";
          echo "<td>" . (isset($row['ID']) ? $row['ID'] : '') . "</td>";
          echo "</tr>";
        }
        echo "</tbody></table><br><br>";
      }

  		?>
  
  </div>

  <?php
    echo "<table border='1'>";
    echo "<thead><tr><th>Product Name</th><th>Volume (ml)</th><th>Mass (mg)</th><th>Pieces</th><th>Product type</th></tr></thead>";
    echo "<form action='/admin/product/backend/add_product_to_catalogue.php' method='post'>";
    echo "<tbody>";

    echo "<td><input type='text' name='productName'></td>";
    echo "<td><input type='number' name='productVolume' min=0></td>";
    echo "<td><input type='number' name='productMass' min=0></td>";
    echo "<td><input type='number' name='productPieces' min=0></td>";

    echo "<td><select name='prodType'>";

    $sql = "SELECT ProductType.ProductType, ProductType.ID FROM ProductType";

    $stmt = $link->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["ID"] . "'>" . $row["ProductType"] . "</option>";
        }
    }
    echo "</select></td>";

    echo "<td><input class='button button-small' type='submit' value='Enter product'></td>";

    echo "</form>";
    echo "</tbody></table><br><br>";

  ?>

<!-- Back Button -->
<button class="button button-large" onclick="window.location.href='/admin/admin_page.php'">Back</button>


<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>