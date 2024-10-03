<?php
include '../dopen.php';
$sql = "SELECT * FROM Roles";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ID"]. " - Name: " . $row["RoleType"]. "<br>";
    }
} else {
    echo "0 results";
}


?>