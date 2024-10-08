<?php 
session_start();
include '../dopen.php';

//$newUserID = $_SESSION['newUserID'];
//$newUserName = $_SESSION['newUserName'];
//$newUserPassword = $_SESSION['newUserPassword'];
//$roleID = $_SESSION['roleID'];

$sql = "SELECT ID, RoomName FROM Rooms WHERE ID NOT IN(SELECT R.ID AS RoomID FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        WHERE A.PeopleID = ?)";
$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $newUserID);
$stmt -> execute();
$rooms = $stmt -> get_result();


$sql = "SELECT * FROM AccessLevel";
$accesslevel = $link -> query($sql);

$newUserID = 2;

$sql = "SELECT R.ID AS RoomID, R.RoomName, AL.ID AS AccessID, AL.AccessLevel FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        INNER JOIN AccessLevel AL ON AL.ID = A.AccessID
        WHERE A.PeopleID = ?";

$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $newUserID);
$stmt -> execute();
$result = $stmt -> get_result();

$sql = ""


if ($result->num_rows > 0) {
    echo '<table><tr><th>Room</th><th>Access level</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["RoomName"] . "</td><td>" . $row["AccessLevel"] . "</td></tr>";
    }
    echo '</table>';
} else {
    echo "No current accesses";
}
?>
<button class="btn" onclick="showAddForm()">Add</button>

<div id="addAccess" class="form-container">
    <h3>My Form</h3>
    <form>
    Genre: <select name = "mgenreid">  <!-- Do not need "type" since options are predefined -->
        <?php
        if ($rooms -> num_rows >0) {
            while ($row = $result -> fetch_assoc()){
                echo "<option value = '" . $row["gid"] . "'>" . $row['mgenre'] . "</option>";
            }
        }
        ?>
    </select>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

<script>
    // JavaScript function to toggle form visibility
    function showAddForm() {
        var form = document.getElementById("addAccess");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>


<style>
        /* Hide the form by default */
        #addAccess {
            display: none; /* Form is hidden initially */
        }
</style>