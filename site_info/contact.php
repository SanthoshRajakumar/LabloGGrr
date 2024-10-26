<?php
session_start();
$pageTitle = "Contact us";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<div class="div2">
<h2> We want to hear from you!</h2>
  <p>Whether you have questions, feedback, or just want to chat, we are here to help! Don’t hesitate to reach out—we're just a message away and excited to assist you!</p>
</div>

  <p style="text-decoration: underline;">info@labloggr.com</p>
  <p>Tel <span style="text-decoration: underline;">+46 123 45 67</span></p>
<p>
  Lägerhyddsvägen 1 <br>
  752 37 Uppsala <br>
  Sweden
</p>

<p>If you are already a client and need help, reach out to <span style="text-decoration: underline;"> support@labloggr.com.</span></p>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
?>
<script>
  window.onload = function() {
    const targetDiv = document.getElementById("target");
    targetDiv.scrollIntoView({ behavior: "smooth" });
  };
</script>