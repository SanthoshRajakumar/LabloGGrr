<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
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
      <button type="submit" class="button">HOME</button>
    </form>
    <form action="about.php" method="GET">
      <button type="submit" class="button">ABOUT</button>
    </form>
    <form action="faq.php" method="GET">
      <button type="submit" class="button">FAQ</button>
    </form>
    <form action="contact.php" method="GET">
      <button type="submit" class="button">CONTACT</button>
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
        <button type="submit" class="button">Login</button>
    </form>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa...</p>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
      quis, sem. Nulla consequat massa quis enim. </p>

    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean
      vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam
      ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. </p>

    <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut
      libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. </p>

    <p>Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut,
      mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>

    <p>Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet
      nec, imperdiet iaculis, ipsum. </p>

    <p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut.</p>

    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
      quis, sem. Nulla consequat massa quis enim. </p>

    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean
      vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam
      ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. </p>





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

