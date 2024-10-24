<?php 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
$pageTitle = "Edit access";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 



if ($_SESSION['roleID'] != 1) {
    header("Location: /homepage.php");
    exit();
}

$editUserID = $_POST['ID'];/* ?? $_SESSION['userID']*/

$_SESSION['editUserID'] = $editUserID;


    /*echo '<form action="/admin/account/backend/update_edit_user.php" method="post">';

    echo '<select name="editUserID">';

    $sql = "SELECT People.ID, People.UserName FROM People";
    $stmt = $link->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["ID"] . ">" . $row["UserName"] . "</option>";
        }
    }

    echo "</select>";

    echo '<button type="submit" class="button button-large">Choose user</button>';

    echo '</form>';*/

    $sql = "SELECT People.UserName FROM People WHERE People.ID = ?";
    $stmt = $link->prepare($sql);

    $stmt->bind_param("i", $editUserID);

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    echo '<h2>Now editing ' . $row['UserName'] . '</h2>';




# Should probably be get request and accessible from user management later.
/*$newUserID = $_SESSION['newUserID'];
# Below 2 not used. Remove?
$newUserName = $_SESSION['newUserName'];
$newUserPassword = $_SESSION['newUserPassword'];*/

$sql = "SELECT ID, RoomName FROM Rooms WHERE ID NOT IN(SELECT R.ID AS RoomID FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        WHERE A.PeopleID = ?)";
$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $editUserID); # changed from newUserID to editUserID
$stmt -> execute();
$rooms = $stmt -> get_result();


$sql = "SELECT * FROM AccessLevel";
$accesslevel = $link -> query($sql);

$sql = "SELECT R.ID AS RoomID, R.RoomName, AL.ID AS AccessID, AL.AccessLevel FROM Access A
        INNER JOIN Rooms R ON R.ID = A.RoomID
        INNER JOIN AccessLevel AL ON AL.ID = A.AccessID
        WHERE A.PeopleID = ?";

$stmt = $link->prepare($sql);
$stmt -> bind_param('s', $editUserID); # changed from newUserID to editUserID
$stmt -> execute();
$result = $stmt -> get_result();

if ($result->num_rows > 0) {
    echo '<table><tr><th>Room</th><th>Access Level</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        $roomName = htmlspecialchars($row["RoomName"]);
        $roomID = htmlspecialchars($row["RoomID"]);
        $accessLevel = htmlspecialchars($row["AccessLevel"]);
        $accessID = htmlspecialchars($row["AccessID"]);

        # Changed from newUserID to editUserID in this block.
        echo "<tr>
                <td>{$roomName}</td>
                <td>{$accessLevel}</td>
                <td>
                    <form action='/admin/account/backend/delete_access.php' method='post' style='display:inline;' class='delete-button-form'>
                        <input type='hidden' name='roomID' value='{$roomID}'>
                        <button type='delete'>Delete</button>
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
    <form action="/admin/account/backend/add_access.php" method="POST">
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

<!-- Back Button -->
<br><br><button class="button button-small" onclick="window.location.href='/admin/account/manage_users.php'">Back to User management</button>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php'; # Include styling
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>