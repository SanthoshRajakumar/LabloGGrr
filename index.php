<?php
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';
session_start();
$pageTitle = "LabLoGGr";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 

?>

<div class="div1">
    <div class="box" id="box1">
        <img src="/images/PastedGraphic-2.png" alt="Image 1">
        <p>Lead students directly to what they need.</p>
    </div>
    <div class="box">
        <img src="/images/PastedGraphic-3.png" alt="Image 2">
        <p>Maximize hands-on learning with more time on labs and tasks.</p>
    </div>
    <div class="box">
        <img src="/images/PastedGraphic-4.png" alt="Image 3">
        <p>Keep materials organized so teachers can focus on educating. </p>
    </div>
</div>
<!-- Has to get an error message in when the key is wrong -->
<div class="div_login" id="key">
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
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    echo "$error";
    unset($_SESSION['error']);
}

include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>

<script>
  function scrollToKey() {
    // Get the target div by its ID
    const targetDiv = document.getElementById("key");
    // Scroll to the target div with smooth scrolling
    targetDiv.scrollIntoView({ behavior: "smooth" });
  }
</script>