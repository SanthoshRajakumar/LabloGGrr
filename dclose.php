<?php
// Kontrollera om $stmt är definierad och stäng den om den finns
if (isset($stmt) && $stmt !== null) {
    $stmt->close(); //chatgptad kod. problemet var att statement forcerades att stängas på vissa platser i koden innan den ens var definerad. detta blir oerhört problematiskt. 
}

// Kontrollera om $link är definierad och stäng databasanslutningen om den finns
if (isset($link) && $link !== null) {
    $link->close();
}
?>

