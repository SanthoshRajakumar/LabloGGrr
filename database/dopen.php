<?php
# detta block ställer in fältets parametrar. Nu är standardvärdena inlagda. 
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "labloggr"; 

// base directory
$base_dir = __DIR__;

#$doc_root = $_SERVER['DOCUMENT_ROOT'];

// server protocol
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

// domain name
$domain = $_SERVER['SERVER_NAME'];

// base url
#$base_url = preg_replace("!^" . $doc_root . "!", '', $base_dir);

// server port
$port = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

// put em all together to get the complete base URL
$url = $protocol . "://" . $domain . $disp_port;

$link = mysqli_connect($servername, $username, $password, $dbname); # denna rad initierar koppling mellan databasen. 4 parametrar krävs
#variabeln $link lagrar variabelns resultat. Om connection finns, så lagrar den en referens till db. Annars får $link värdet = False 

unset($servername, $username, $password, $dbname); # tar bort variablerna efter, annars är de sparade på andra sidor som importerar scriptet o skapar knas

// Check if connection is established
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


