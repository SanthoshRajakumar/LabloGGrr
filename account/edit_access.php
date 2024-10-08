<?php 
session_start();
include '../dopen.php';

$newUserID = $_SESSION['newUserID'];
$newUserName = $_SESSION['newUserName'];
$newUserPassword = $_SESSION['newUserPassword'];
$roleID = $_SESSION['roleID'];

$sql = "SELECT ID, RoomName FROM Rooms WHERE ID NOT IN(SELECT R.ID AS RoomID FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        WHERE A.PeopleID = ?)";
$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $newUserID);
$stmt -> execute();
$rooms = $stmt -> get_result();


$sql = "SELECT * FROM AccessLevel";
$accesslevel = $link -> query($sql);

$sql = "SELECT R.ID AS RoomID, R.RoomName, AL.ID AS AccessID, AL.AccessLevel FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        INNER JOIN AccessLevel AL ON AL.ID = A.AccessID
        WHERE A.PeopleID = ?";

$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $newUserID);
$stmt -> execute();
$result = $stmt -> get_result();

if ($result->num_rows > 0) {
    echo '<table><tr><th>Room</th><th>Access Level</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        $roomName = htmlspecialchars($row["RoomName"]);
        $accessLevel = htmlspecialchars($row["AccessLevel"]);
        $accessID = htmlspecialchars($row["AccessID"]);

        echo "<tr>
                <td>{$roomName}</td>
                <td>{$accessLevel}</td>
                <td>
                    <form action='./backend/delete_access.php' method='post' style='display:inline;'>
                        <input type='hidden' name='accessID' value='{$accessID}'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
    echo '</table>';
} else {
    echo "No current accesses";
}

?>
<button class="btn" onclick="showAddForm()">Add</button>

<div id="addAccess" class="form-container">
    <h3>Edit access</h3>
    <form action="./backend/add_access.php" method="POST">
    Room: <select name = "room">
        <?php
        if ($rooms -> num_rows >0) {
            while ($row = $rooms -> fetch_assoc()){
                echo "<option value = '" . $row["ID"] . "'>" . $row['RoomName'] . "</option>";
            }
        }
        ?>
    </select>
    Access Level: <select name="accessLevel">
        <?php
        if ($accesslevel->num_rows > 0) {
            while ($row = $accesslevel->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row['AccessLevel'] . "</option>";
            }
        }
        ?>
    </select>
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