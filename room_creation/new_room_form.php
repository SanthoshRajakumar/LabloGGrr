<?php
session_start(); 
include '../dopen.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2></h2>
  </div>
</div>


<!-- Content Section -->
<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
<form action="../index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="../about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>

</header>
</div>



