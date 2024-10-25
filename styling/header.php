<?php

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $pageTitle . '</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <link rel="stylesheet" href="/styling/style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

  <header>
  <form action="/homepage.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="/site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="/site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="/site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
  </header>';


?>