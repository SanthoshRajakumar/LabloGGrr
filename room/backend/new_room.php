<?php
session_start(); 
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $room_name = trim($_POST['room_name']);
    
    // Validera rumsnamn
    if (!preg_match('/^[A-Za-z]+(:\d+)?$|^\d+$/', $room_name)) {
        $_SESSION['message'] = "Error: Room name must contain only letters, numbers, or a combination of both separated by a colon (e.g., A:1234).";
        header("Location: ../new_room_form.php");
        exit(); 
    } else {

        $sql_check = "SELECT ID FROM Rooms WHERE RoomName = ?";
        $stmt_check = $link->prepare($sql_check);
        $stmt_check->bind_param("s", $room_name);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows == 0) {
            $sql_insert = "INSERT INTO Rooms (RoomName) VALUES (?)";
            $stmt_insert = $link->prepare($sql_insert);
            $stmt_insert->bind_param("s", $room_name);
            
            if ($stmt_insert->execute()) {
                $_SESSION['message'] = "Room created!";
                include '../../database/dclose.php';
                header("Location: ../new_room_form.php");
                exit(); 
            } else {
                $_SESSION['message'] = "eeeeerrgh call support (therese)" . $stmt_insert->error;
                header("Location: ../new_room_form.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Room already exists!";
            header("Location: ../new_room_form.php");
            exit();
        }
    }
}

// Stäng anslutningen om inget rum lades till eller vid fel
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>
