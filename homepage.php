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
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <form action="index.php" method="GET">
      <button type="submit" class="button">HOME</button>
    </form>

    <form action="about.php" method="GET">
      <button type="submit" class="button">ABOUT</button>
    </form>

    <h1>LabLoGGr</h1>

    <form action="faq.php" method="GET">
      <button type="submit" class="button">FAQ</button>
    </form>

    <form action="contact.php" method="GET">
      <button type="submit" class="button">CONTACT</button>
    </form>

</header>

<body>
<main>
<div class="button-container">
  <form action="room.php" method="POST">
    <input type="submit" value="Rooms" class="button button1"/>
  </form>
</div>

</main>
</body>




