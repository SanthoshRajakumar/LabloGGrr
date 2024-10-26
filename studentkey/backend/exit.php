<?php
session_start();
unset($_SESSION['roleID']);
unset($_SESSION['studentkey']);
header("Location: /index.php");
?>