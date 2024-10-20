<?php

#session_set_cookie_params([
#    'lifetime' => 0,
#    'path' => '/',
#    'domain' => '', // Set to your domain
#    'secure' => true, // Use true if using HTTPS
#    'httponly' => true, // Prevent JavaScript access
#    'samesite' => 'Strict' // Helps prevent CSRF
#]);
session_start();

# Connect to database
include $_SERVER['DOCUMENT_ROOT'] . '/database/dopen.php';

$sql = "SELECT * FROM Roles WHERE RoleType IN ('Teacher', 'Teacher Assistant')";
$result = $link->query($sql);

include $_SERVER['DOCUMENT_ROOT'] . '/database/dclose.php';
?>

<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="/styling/style_.css">
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

<h2>Create user</h2>
<h4>** Some description **</h4>

<div class="div_login">

<form action="./backend/create_account.php" method="POST">
  <label for="fname">Firstname:</label>
  <input type="text" placeholder="Enter firstname" id="fname" name="fname" required/><br/>

  <label for="lname">Lastname:</label>
  <input type="text" placeholder="Enter lastname" id="lname" name="lname" required/><br/>

  <label for="email">Email: </label>
  <input type="email" placeholder="Enter email" id="email" name="email" required/><br/>

    <label for="role">Role:</label>
    <select name="roleid" name="role" required>
        <option value="" disabled selected hidden class="placeholder-option">Select a role</option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row['RoleType'] . "</option>";
            }
        }
        ?>
    </select><br/>    
    <input type="submit" class="button button-large" value="Create user"/>
</form>
</div>

<button class="button button-small" onclick="window.location.href='/admin/account/user_management.php'">Back</button>


<script>
    const fnameInput = document.getElementById('fname');
    const lnameInput = document.getElementById('lname');

    // Function to automatically format name input
    function formatName(name){
        const formattedName = name.replace(/[^a-zA-ZÀ-ÿ\s-]/g, ''); // Remove numeric and special characters
        return formattedName.split(/(\s|-)/) // Capitalize first letter after - or space
            .map(word => {
                if (word.length === 0) return ""; 
                if (word === " " || word === "-") return word;
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            })
            .join('');
    }

    // Event listener for Firstname input
    fnameInput.addEventListener('input', function() {
        fnameInput.value = formatName(fnameInput.value); 
    });

    // Event listener for Lastname input
    lnameInput.addEventListener('input', function() {
        lnameInput.value = formatName(lnameInput.value);
    });
</script>

<div class="footer">
    <h4> &copy; 2024 LabbLoGGr | <a href="/site_info/privacy_policy.php">Privacy policy</a> | <a href="/site_info/terms_condi.php">Terms & Condition</a> </h4>
</div>

<script src="/styling/java.js">
</script>

</body>
</html>