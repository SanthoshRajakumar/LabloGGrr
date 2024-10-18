<?php
# detta block ställer in fältets parametrar. Nu är standardvärdena inlagda. 
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "labloggr";

$link = mysqli_connect($servername, $username, $password, $dbname); # denna rad initierar koppling mellan databasen. 4 parametrar krävs
#variabeln $link lagrar variabelns resultat. Om connection finns, så lagrar den en referens till db. Annars får $link värdet = False 

unset($servername, $username, $password, $dbname); # tar bort variablerna efter, annars är de sparade på andra sidor som importerar scriptet o skapar knas

// Check if connection is established
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


