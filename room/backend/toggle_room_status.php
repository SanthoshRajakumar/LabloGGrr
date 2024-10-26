<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if (!isset($_SESSION['roleID']) || $_SESSION['roleID'] != 1) {
    header("Location: /room/room.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_id'])) {
    $room_id = $_POST['room_id'];

    $sql = "SELECT Active FROM Rooms WHERE ID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $_POST['room_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    
    if ($row['Active'] == 1) {

        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] == 'yes') {
                // Sätt rummet som inaktivt istället för att radera
                $sql_deactivate = "UPDATE Rooms SET Active = 0 WHERE ID = ?";
                $stmt_deactivate = $link->prepare($sql_deactivate);
                $stmt_deactivate->bind_param("i", $room_id);

                if ($stmt_deactivate->execute()) {
                    echo "<p>Room successfully deactivated!</p>";
                } else {
                    echo "<p>Error deactivating room: " . $stmt_deactivate->error . "</p>";
                }
            } else {
                echo "<p>Room deactivation cancelled.</p>";
            }

            header("Refresh: 3; URL=../room.php");
            exit();
        } else {

            $sql_room = "SELECT RoomName FROM Rooms WHERE ID = ?";
            $stmt_room = $link->prepare($sql_room);
            $stmt_room->bind_param("i", $room_id);
            $stmt_room->execute();
            $result_room = $stmt_room->get_result();
            $room = $result_room->fetch_assoc();

            echo "<h2>Are you sure you want to deactivate the room: " . $room['RoomName'] . "?</h2>";
            echo "<form action='toggle_room_status.php' method='POST'>
                    <input type='hidden' name='room_id' value='$room_id'>
                    <button type='submit' name='confirm' value='yes'>Yes</button>
                    <button type='submit' name='confirm' value='no'>No</button>
                  </form>";
        }
    }

    else {
        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] == 'yes') {
                // Sätt rummet som inaktivt istället för att radera
                $sql_deactivate = "UPDATE Rooms SET Active = 1 WHERE ID = ?";
                $stmt_deactivate = $link->prepare($sql_deactivate);
                $stmt_deactivate->bind_param("i", $room_id);

                if ($stmt_deactivate->execute()) {
                    echo "<p>Room successfully deactivated!</p>";
                } else {
                    echo "<p>Error deactivating room: " . $stmt_deactivate->error . "</p>";
                }
            } else {
                echo "<p>Room deactivation cancelled.</p>";
            }

            header("Refresh: 3; URL=../room.php");
            exit();
        }
        else {

            $sql_room = "SELECT RoomName FROM Rooms WHERE ID = ?";
            $stmt_room = $link->prepare($sql_room);
            $stmt_room->bind_param("i", $room_id);
            $stmt_room->execute();
            $result_room = $stmt_room->get_result();
            $room = $result_room->fetch_assoc();

            echo "<h2>Are you sure you want to activate the room: " . $room['RoomName'] . "?</h2>";
            echo "<form action='toggle_room_status.php' method='POST'>
                    <input type='hidden' name='room_id' value='$room_id'>
                    <button type='submit' name='confirm' value='yes'>Yes</button>
                    <button type='submit' name='confirm' value='no'>No</button>
                  </form>";
        }
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
