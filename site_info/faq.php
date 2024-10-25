<?php
session_start();
$pageTitle = "FAQ";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<div class="div2">
    <h2> FAQs</h2>
    <p>Have a question for us? Perhaps you can find the answers below!</p>
</div>

<div class="div1">
  <div class="box1">
    <h3>How do you make the inventory tables? What do you need from me to get started?</h3>
        <p>We take the list with names of all the shelfs in your inventory (in .csv format) and upload them to our system. 
        The inventory are then displayed in our system and you can start creating courses and sessions with different access. 
        We also put in a bit of manual work to make sure the storage is just as you want it!</p>
    </div>
    <div class="box1">
        <h3>What industries do you create the inventory displays for?</h3>
        <p>We create inventory displays for all educational laboratories; university, healthcare, reseach and more! </p>
    </div>
</div>

<div class="div1">
    <div class="box1">
    <h3>How much does it cost?</h3>
        <p>Our pricing is dependant upon the size of your inventory, and also the solutions that you’re interested in implementing. 
        For a price quote, visit our contact page and get in touch with us. </p>
    </div>
    <div class="box1">
    <h3>How long do the inventory take to set-up?</h3>
        <p>The time it takes to set-up your inventory depends on which features you wish to implement, your existing stucture of the storage, etc. 
        The inventory table and amount display on their own are typically straightforward and quick to set-up. 
        For any additional features you select, this time may increase - but it’s hard to give an exact number as it will be assessed on a case-by-case basis.</p>
    </div>
</div>

<div class="div1">
    <div class="box1">
    <h3>Can I customize the design of my inventory?</h3>
        <p>The look and feel of the inventory table as a whole (interface, fonts, etc.) cannot be changed. 
        However, you can customize the what you want to be written and displayed. Get in touch with us and we will explain more!</p>
    </div>
    <div class="box1">
    <h3>How do students access the lab inventory?</h3>
        <p>Students are granted access to LabLoGGr through course keys provided by their teachers or TAs. Once they log in, they can view
        a filtered version of the inventory, displaying only the materials relevant to their coursework.</p>
    </div>
</div>

<div class="div1">
<div class="box1">
    <h3> Could not find the answers you were looking for?</h3>
        <p>Do not hesitate to<a href="../contact.php">contact us.</a></p>
    </div>
</div>

<?php 
  include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
?>
<script>
  window.onload = function() {
    const targetDiv = document.getElementById("target");
    targetDiv.scrollIntoView({ behavior: "smooth" });
  };
</script>