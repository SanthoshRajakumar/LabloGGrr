<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga ut</title>
    <link rel="stylesheet" href="../style_.css">
</head>
<body>
<div class="sample-header">
  <div class="sample-header-section">
    <h1>LabLoGGr</h1>
    <h2>Vill du logga ut?</h2>
  </div>
</div>

<div class="sample-section-wrap">
  <div class="sample-section">
    <!-- Form för att bekräfta utloggning -->
    <form action="backend/logout.php" method="POST">
      <button type="submit" class="button2">Yes log me the fuck out of this shit </button>
    </form>
    
    <!-- Avbryt och gå tillbaka till homepage -->
    <form action="../homepage.php" method="GET">
      <button type="submit" class="button2">NO I don't want to be logged out </button>
    </form>
  </div>
</div>

</body>
</html>