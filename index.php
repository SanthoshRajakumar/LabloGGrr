<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();
$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


 <!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoGGr</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <link rel="stylesheet" href="style_.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr.</h1>
    <h2></h2>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

<header>
<form action="../index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="../site_info/about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="../site_info/faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="../site_info/contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header> -->

<div class="div1">
    <div class="box" id="box1">
        <img src="images/PastedGraphic-2.png" alt="Image 1">
        <p>Lead students directly to what they need, so students can dive right into learning with the exact right equipment in hand.</p>
    </div>
    <div class="box">
        <img src="images/PastedGraphic-3.png" alt="Image 2">
        <p>Maximize hands-on learning with more time on labs and tasks. Our product ensures students spend their session time there it should.</p>
    </div>
    <div class="box">
        <img src="images/PastedGraphic-4.png" alt="Image 3">
        <p>Our system keeps materials organized and minimizes material management, so teachers can focus on educating. </p>
    </div>
</div>
<!-- Has to get an error message in when the key is wrong -->
<div class="div_login">
    <h2>Enter student key here: </h2>
    <form action="/studentkey/validation.php" method="POST">
        <input type="text" placeholder="Enter student key" name="studentkey" required/><br />
    <button type="submit" class="button button-large">Enter</button>
</form>
</div>

<div class="div3">
    <!-- Form for Login -->
    <h3>Teacher or TA?</h3>
    <form method="get" action="/login/login.php">
        <button type="submit" class="button button-large">Login here</button>
    </form>
</div>

<!--
<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="../site_info/privacy_policy.php">Privacy policy</a> | <a href="../site_info/terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="java.js">
</script>

</body>
</html>
-->

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>