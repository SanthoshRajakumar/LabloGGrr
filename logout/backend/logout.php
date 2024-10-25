<?php
session_start();
unset($_SESSION['roleID']);
unset($_SESSION['userID']);
//session_start();
// Förstör alla session-variabler
//session_unset();
// Förstör sessionen helt
//session_destroy();
// Omdirigera till startsidan (index.php)
header("Location: /index.php");
//exit();
?>