
<!DOCTYPE html>
<html>
<head>
    <title>LabLoGGr</title>
</head>
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
