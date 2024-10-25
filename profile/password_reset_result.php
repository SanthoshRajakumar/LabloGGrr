<?php
session_start();

$userID = $_SESSION["userID"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Result</title>
    <link rel="stylesheet" href="/styling/style_.css">
</head>
<body>

<div class="sample-header">
  <div class="sample-header-section">
    <h1>Password Reset</h1>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">

    <!-- Display the password reset result message -->
    <h2><?php echo htmlspecialchars($_SESSION['reset_message']); ?></h2>

    <!-- Button to go back to homepage -->
    <?php
    if($userID === 1){
      echo '<br><br><button class="button button-large" onclick="window.location.href=\'/admin/admin_page.php\'">Back</button>';
    } else {
      echo '<br><br><button class="button button-large" onclick="window.location.href=\'/room/room.php\'">Back</button>';
    }
    ?>

  </div>
</div>

<div class="footer">
    <h4>&copy; 2024 LabLoGGr | <a href="privacy_policy.php">Privacy policy</a> | <a href="terms_condi.php">Terms & Condition</a></h4>
</div>

</body>
</html>

<?php
unset($_SESSION['reset_message']);
?>
