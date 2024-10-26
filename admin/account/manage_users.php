<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 

$sql = "SELECT P.ID, P.Firstname, P.Lastname, P.Active, R.RoleType FROM People P
        INNER JOIN Roles R ON R.ID = P.RoleID
        WHERE R.ID != 1";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo '<table><tr><th>Firstname</th><th>Lastname</th><th>Role</th><th>Active</th><th>Deactivate</th><th>Edit Access</th></tr>';
    while($row = $result->fetch_assoc()) {
        $ID = htmlspecialchars($row["ID"]);
        $firstname = htmlspecialchars($row["Firstname"]);
        $lastname = htmlspecialchars($row["Lastname"]);
        $role = htmlspecialchars($row["RoleType"]);
        $active = htmlspecialchars($row["Active"]);

        echo "<tr><td>{$firstname}</td><td>{$lastname}</td><td>{$role}</td>";

        if ($active){
            echo "<td>Yes</td><td>
                    <form action='./backend/deactivate_account.php' method='post' style='display:inline;' class='delete-button-form'>
                        <input type='hidden' name='ID' value='{$ID}'>
                        <button class='button button-small' type='submit'>Deactivate</button>
                    </form>
                </td>";
        } else {
            echo "<td>No</td><td>
                    <form action='./backend/deactivate_account.php' method='post' style='display:inline;' class='delete-button-form'>
                        <input type='hidden' name='ID' value='{$ID}'>
                        <button class='button button-small type='submit'>Activate</button>
                    </form>
                </td>";
        }
        echo "<td><form action='./edit_access.php' method='post' style='display:inline;' class='delete-button-form'>
                <input type='hidden' name='ID' value='{$ID}'>
                <button class='button button-small' type='submit'>Edit access</button>
            </form></td></tr>";
    }
    echo '</table>';
}
?>

<form action="./create_account.php" method="GET">
    <button type="submit" class="button button-large">Create new user</button>
</form>

<br><br><button class="button button-large" onclick="window.location.href='/admin/admin_page.php'">Back</button>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>



