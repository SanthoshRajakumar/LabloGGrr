<?php
session_start();
$pageTitle = "Terms & Conditions";
include $_SERVER['DOCUMENT_ROOT'] . '/styling/header.php'; 
?>

<h2> Terms & Conditions </h2>
<h4>Uptaded on October 13th 2024</h4>

<h3>1. Acceptance of Terms </h3>
<p>
By accessing and using the LabLoGGr software ("Service"), you agree to be bound by these Terms and Conditions ("Terms"). 
If you do not agree with any part of these terms, you are prohibited from using the Service.
</p>

<h3>2. Service description </h3>
<p>
LabLoGGr is a digital inventory management system designed to streamline the management of laboratory inventories in university settings. 
The Service provides tools for users to visualize inventory, manage access, and maintain accurate records of laboratory materials and equipment.
</p>

<h3>3. User accounts </h3>
<h4 style="font-weight: 700"> a. User Roles and Permissions</h4>
<p>- Administrators have full access to the Service, including the rights to create, modify, and delete user accounts and inventory records. </p>
<p>- Teachers and Teaching Assistants (TAs) are granted access to manage and view inventory in their assigned laboratories. </p>
<p>- Students will, with the use of a code-key, have access to view a filtered list of inventory items relevant to their coursework during designated courses. </p>

<h4 style="font-weight: 700"> b. Security </h4>
<p>Users are responsible for maintaining the confidentiality of their account and password and for restricting access to their computer, and they agree to accept responsibility for all activities that occur under their account. </p>

<h3>4. Intellectual Property </h3>
<p>The Service and its original content, features, and functionality are and will remain the exclusive property of LabLoGGr and its licensors. The software is protected by copyright and intellectual property laws of the country and any unauthorized use of the material may be a violation of these laws.</p>

<h3>5. Modifications to Service</h3>
<p>LabLoGGr reserves the right at any time to modify or discontinue, temporarily or permanently, the Service (or any part thereof) with or without notice. You agree that LabLoGGR shall not be liable to you or to any third party for any modification, suspension, or discontinuance of the Service.</p>

<h3>6. Termination</h3>
<p>LabLoGGr may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including, without limitation, if you breach the Terms.</p>

<h3>7. Indemnification</h3>
<p>You agree to indemnify, defend, and hold harmless LabLoGGr, its principals, officers, directors, representatives, employees, contractors, licensors, licensees, suppliers, and agents, from and against any claims, losses, damages, obligations, costs, actions, or demands.</p>

<h3>8. Limitations of Liability</h3>
<p>In no event shall LabLoGGr nor its directors, employees, or partners, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>

<h3>9. Governing Law</h3>
<p>These Terms shall be governed and construed in accordance with the laws of Sweden, without regard to its conflict of law provisions.</p>

<h3>10. Changes</h3>
<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

<h3>11. Contact Information</h3>
<p>If you have any questions about these Terms, you can find our contact information<a href="../contact.php">here</a>.</p>


<?php 
  include $_SERVER['DOCUMENT_ROOT'] . '/styling/footer.php';
?>
<script>
  window.onload = function() {
    const targetDiv = document.getElementById("target");
    targetDiv.scrollIntoView({ behavior: "smooth" });
  };
</script>