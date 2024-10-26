<?php
session_start();
$pageTitle = "Privacy Policy";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>


<h2> Privacy Policy </h2>

<h3> Information we collect</h3>
    <p>We collect information to provide better services to our users. This includes: </p>
        <p>- Personal Information: Name, email address, phone number, etc., if you voluntarily provide it through forms (e.g., contact forms, sign-ups).</p>
        <p>- Non-Personal Information: This includes IP addresses, browser type, language preference, referring site, and the date and time of each visitor request. We may collect this automatically to improve your browsing experience.</p>

<h3>How we use your information</h3>
    <p>We use the information we collect in the following ways: </p>
    <p>- To provide, operate, and maintain our website.</p>
    <p>- To improve, personalize, and expand our website’s functionality. </p>
    <p>- To communicate with you, either directly or through one of our partners, including for customer service, updates, and marketing. </p>
    <p>- To analyze how you use our website for performance monitoring. </p>


<?php 
  include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
?>
<script>
  window.onload = function() {
    const targetDiv = document.getElementById("target");
    targetDiv.scrollIntoView({ behavior: "smooth" });
  };
</script>