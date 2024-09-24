
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
            header("Location: student_login.php"); // Redirect to student page
            exit();
        }
    }
    ?>
</body>
</html>
