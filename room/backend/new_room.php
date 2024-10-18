<?php
session_start(); 
include '../../database/dopen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // hämta rumnamn 
    $room_name = trim($_POST['room_name']);
    
    // validering n shit 
    if (!preg_match('/^[A-Za-z]+(:\d+)?$|^\d+$/', $room_name)) {
        echo "<p>Error: Room name must contain only letters, numbers, or a combination of both separated by a colon (e.g., A:1234).</p>";
    } else {
        // kontroll av rum rum 
        $sql_check = "SELECT ID FROM Rooms WHERE RoomName = ?";
        $stmt_check = $link->prepare($sql_check);
        $stmt_check->bind_param("s", $room_name);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows == 0) {
            // rumm finns inte, lägg till det
            $sql_insert = "INSERT INTO Rooms (RoomName) VALUES (?)";
            $stmt_insert = $link->prepare($sql_insert);
            $stmt_insert->bind_param("s", $room_name);
            
            if ($stmt_insert->execute()) {
                // 
                
                // Stäng databasanslutningen innan omdirigeringen
                include '../../database/dclose.php';
                
                // Omdirigera tillbaka till room.php 
                header("Location: ../room.php");
                exit(); 
                

            } else {
                echo "<p>Error adding room: " . $stmt_insert->error . "</p>";
            }
        } else {
            echo "<p>Room already exists!</p>";
        }
    }
}

// Stäng anslutningen om inget rum lades till eller vid fel
include '../../database/dclose.php';
?>