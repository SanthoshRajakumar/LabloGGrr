<!DOCTYPE html> 
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Database</title>
</head>
<body>
    <h1>Lab Database</h1>

    <!-- Sökformulär -->
    <form action="handle_search.php" method="POST">
        <label for="searchInput">Search for some shitin the lab or view the entire fng chaoz:</label>
        <input type="text" id="searchInput" name="searchInput" placeholder="Enter search term" />

        <!-- Knapp för att söka -->
        <input type="submit" name="search" value="Search">

        <!-- Knapp för att visa allt innehåll -->
        <input type="submit" name="view_all" formaction="view_lab_content.php" value="View All Lab Content">
    </form>

</body>
</html>