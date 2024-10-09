<?php

# NEED TO BE ADDED:
# rooms input (double select??)
# sending info to new users email

# Ta bort role???


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
include '../dopen.php';

$sql = "SELECT ID, RoleType FROM Roles";
$result = $link->query($sql);
?>

<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="icon" type="images/x-icon" href="/images/PastedGraphic-1.png">
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="../style_.css">
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

<form action="./backend/create_account.php" method="POST">
    Firstname: <input type="text" id="fname" name="fname" required/><br/>
    Lastname: <input type="text" id="lname" name="lname" required/><br/>
    Email: <input type="email" id="email" name="email" required/><br/>
    Role: <select name="roleid" required>
        <option value="" disabled selected hidden>Select a role</option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row['RoleType'] . "</option>";
            }
        }
        ?>
    </select><br/>    
    <input type="submit" value="Create account"/>
</form>

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


<script src="../java.js">
</script>

</body>
</html>