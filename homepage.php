<?php 
session_start();
?>

<!-- ELSA --> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header class="site-header">
    <h1 class="logo">LabLogger</h1>
</header>

<h2 style="font-size: 50px">Admin page</h2>

<form action="room.php" method="POST">
  <input type="submit" value="Rooms" class="button button5"/>
</form>

</body>
