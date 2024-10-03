<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoGGr</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style_.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr</h1>
    <h2></h2>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

<header>
<form action="index.php" method="GET">
      <button type="submit" class="button2">HOME</button>
    </form>
    <form action="about.php" method="GET">
      <button type="submit" class="button2">ABOUT</button>
    </form>
    <form action="faq.php" method="GET">
      <button type="submit" class="button2">FAQ</button>
    </form>
    <form action="contact.php" method="GET">
      <button type="submit" class="button2">CONTACT</button>
    </form>
</header>

<div class="div1">
    <div class="box" id="box1">
        <img src="images/PastedGraphic-1.png" alt="Image 1">
        <p>Lead students directly to what they need, so students can dive right into learning with the exact right equipment in hand.</p>
    </div>
    <div class="box">
        <img src="images/PastedGraphic-2.png" alt="Image 2">
        <p>Maximize hands-on learning with more time on labs and tasks. Our product ensures students spend their session time there it should.</p>
    </div>
    <div class="box">
        <img src="images/PastedGraphic-3.png" alt="Image 3">
        <p>Our system keeps materials organized and minimizes material management, so teachers can focus on educating. </p>
    </div>
</div>
<!-- 
    <h1>Information Management Systems 1DL471</h1>

    <div class="about"></div>
        <h3>ABOUT</h3>
        <p>BLA BLA BLA...</p>
    </div>
-->

<div class="div1">
    <!-- Form for Login -->
    <form method="get" action="login_page.php">
        <button type="submit" class="button2">Login here</button>
    </form>
</div>

    <div class="login"></div>
        <!--Form for Teacher and Student Login -->
        <form method="post">
            <button type="submit" name="role" value="teacher">Teacher</button>
            <button type="submit" name="role" value="student">Student</button>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check which button was pressed based on the value of 'role'
        if ($_POST['role'] == 'teacher') {
            header("Location: teacher.php"); // Redirect to teacher page
            exit();
        } elseif ($_POST['role'] == 'student') {
            header("Location: login_page.php"); // Redirect to student page
            exit();
        }
    }
    ?>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | Privacy policy | Terms & Condition </h4>
</div>

<script src="java.js">
</script>

</body>
</html>

