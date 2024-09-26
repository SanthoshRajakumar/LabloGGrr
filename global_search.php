<?php
include 'dopen.php'; // Your database connection

// Get the search query from the form input
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to show basic product information (Product Name and Product Type)
$globalSearchQuery = "
    SELECT 
        Product.ProductName AS name,
        ProductType.ProductType AS type
    FROM Product
    LEFT JOIN ProductType ON Product.ProductTypeID = ProductType.ID
    WHERE Product.ProductName LIKE '%$searchQuery%'
";

// Execute the query
$searchResult = mysqli_query($link, $globalSearchQuery);

// Fetch all the search results
$basicResults = mysqli_fetch_all($searchResult, MYSQLI_ASSOC);

// If a product is selected or search results are present, display more details
$showDetails = !empty($searchQuery);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
</head>
<body>
    <h1>Global Search</h1>

    <!-- Search form -->
    <form action="global_search.php" method="get">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" required><br><br>
        <button type="submit">Search</button>
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
                WHERE Product.ProductName LIKE '%$searchQuery%'
                GROUP BY Product.ID
            ";

            $detailsResult = mysqli_query($link, $detailsQuery);
            $detailedResults = mysqli_fetch_all($detailsResult, MYSQLI_ASSOC);

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
