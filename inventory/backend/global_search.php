<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

// Get the search query from the form input
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to show basic product information (Product Name and Product Type)
$globalSearchQuery = "
    SELECT 
        Product.ProductName AS name,
        ProductType.ProductType AS type
    FROM Product
    LEFT JOIN ProductType ON Product.ProductTypeID = ProductType.ID
    WHERE Product.ProductName LIKE ?
";

// Prepare statement
$stmt = mysqli_prepare($link, $globalSearchQuery);

// Bind the search query with wildcards to the statement
$searchParam = "%$searchQuery%";
mysqli_stmt_bind_param($stmt, 's', $searchParam);

// Execute the query
mysqli_stmt_execute($stmt);

// Get the result
$searchResult = mysqli_stmt_get_result($stmt);

// Fetch all the search results
$basicResults = mysqli_fetch_all($searchResult, MYSQLI_ASSOC);

// Close the statement
mysqli_stmt_close($stmt);

// If a product is selected or search results are present, display more details
$showDetails = !empty($searchQuery);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
    <link rel="stylesheet" href="/styling/style_.css">
</head>
<body>
    <!-- Search form -->
    <form action="/global_search.php" method="GET">
    </form>

    <!-- Display the search results -->
    <?php if ($showDetails): ?>
        <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Type</th>
                <th>Quantity (Volume/Mass/Pieces)</th>
                <th>Available Quantity</th>
                <th>Location</th>
            </tr>

            <?php
            // If a search has been made, get all the product details
            $detailsQuery = "
                SELECT 
                    Product.ProductName AS name,
                    ProductType.ProductType AS type,
                    COALESCE(Product.Volume, Product.Mass, Product.Pieces) AS quantity,
                    GROUP_CONCAT(Rooms.RoomName SEPARATOR ', ') AS locations,
                    SUM(ProductLocation.Quantity) AS total_quantity
                FROM Product
                LEFT JOIN ProductType ON Product.ProductTypeID = ProductType.ID
                LEFT JOIN ProductLocation ON Product.ID = ProductLocation.ProductID
                LEFT JOIN Rooms ON ProductLocation.RoomID = Rooms.ID
                WHERE Product.ProductName LIKE ?
                GROUP BY Product.ID
            ";

            // Prepare statement
            $stmtDetails = mysqli_prepare($link, $detailsQuery);

            // Bind the search query with wildcards to the statement
            mysqli_stmt_bind_param($stmtDetails, 's', $searchParam);

            // Execute the query
            mysqli_stmt_execute($stmtDetails);

            // Get the result
            $detailsResult = mysqli_stmt_get_result($stmtDetails);

            // Fetch all the search results
            $detailedResults = mysqli_fetch_all($detailsResult, MYSQLI_ASSOC);

            // Close the statement
            mysqli_stmt_close($stmtDetails);

            foreach ($detailedResults as $result): ?>
                <tr>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['type']; ?></td>
                    <td><?php echo $result['quantity']; ?></td>
                    <td><?php echo $result['total_quantity']; ?></td>
                    <td><?php echo $result['locations']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h2>Products</h2>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Type</th>
            </tr>

            <?php foreach ($basicResults as $result): ?>
                <tr>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['type']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

<?php
echo '<br><br><button class="button button-small" onclick="window.location.href=\'/room/room.php\'">Back</button>';
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
?>

