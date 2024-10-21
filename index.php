<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();
$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

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
    <form action="/studentkey/backend/validation.php" method="POST">
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


<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>