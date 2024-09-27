
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabLoGGr</title>
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <form action="index.php" method="POST">
        <input type="submit" value="HOME" class="button"/>
    </form>

    <form action="about.php" method="POST">
        <input type="submit" value="ABOUT" class="button"/>
    </form>

    <h1>LabLoGGr</h1>

    <form action="faq.php" method="POST">
        <input type="submit" value="FAQ" class="button"/>
    </form>

    <form action="contact.php" method="POST">
        <input type="submit" value="CONTACT" class="button"/>
    </form>

</header>

<main>
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
</main>

<body>
    <h1>Information Management Systems 1DL471</h1>

    <div class="about"></div>
        <h3>ABOUT</h3>
        <p>BLA BLA BLA...</p>
    </div>
<<<<<<< HEAD
    <div class="login">
        <!-- Form for Login -->
        <form method="get" action="login.php">
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>



=======

    <div class="login"></div>
        <!-- Form for Teacher and Student Login -->
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
</body>
</html>
>>>>>>> a9daaeeaf4f0c961320043fa57ebe9b56db700a0
