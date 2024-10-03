<?php
include '../dopen.php';
$sql = "SELECT * FROM Roles";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value=" . $row["ID"] . ">" . $row["RoleType"] . "</option>";
    }
} else {
    echo "0 results";
}


?>