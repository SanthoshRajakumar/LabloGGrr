<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: ../room.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_id'])) {
    $room_id = $_POST['room_id'];

    if (isset($_POST['confirm'])) {
        // Om admin bekräftar radering
        if ($_POST['confirm'] == 'yes') {
            // Radera rummet från databasen
            $sql_delete = "DELETE FROM Rooms WHERE ID = ?";
            $stmt_delete = $link->prepare($sql_delete);
            $stmt_delete->bind_param("i", $room_id);

            if ($stmt_delete->execute()) {
                echo "<p>Room successfully deleted!</p>";
            } else {
                echo "<p>Error deleting room: " . $stmt_delete->error . "</p>";
            }
        } else {
            echo "<p>Room deletion cancelled.</p>";
        }

        // Omdirigera tillbaka till room.php efter åtgärden
        header("Refresh: 3; URL=../room.php");
        exit();
    } else {
        // Visa bekräftelsefråga
        $sql_room = "SELECT RoomName FROM Rooms WHERE ID = ?";
        $stmt_room = $link->prepare($sql_room);
        $stmt_room->bind_param("i", $room_id);
        $stmt_room->execute();
        $result_room = $stmt_room->get_result();
        $room = $result_room->fetch_assoc();

        echo "<h2>Are you sure you want to delete the room: " . $room['RoomName'] . "?</h2>";
        echo "<form action='delete_room.php' method='POST'>
                <input type='hidden' name='room_id' value='$room_id'>
                <button type='submit' name='confirm' value='yes'>Yes</button>
                <button type='submit' name='confirm' value='no'>No</button>
              </form>";
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>