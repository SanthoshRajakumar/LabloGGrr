<?php

# NEED TO BE ADDED:
# rooms input (double select??)
# sending info to new users email


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



<form action="create_account.php" method="POST">
    Firstname: <input type="text" id="fname" name="fname" required/><br/>
    Lastname: <input type="text" id="lname" name="lname" required/><br/>
    Email: <input type="email" id="email" name="email" required/><br/>
    Social Security Number: <input type="text" id="ssn" name="ssn" minlength="13" maxlength="13" placeholder="YYYYMMDD-XXXX" required/><br/>
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

<?php
if (isset($_SESSION['message'])) {
    echo "yaaahooooo";
    echo "<p>" . $_SESSION['message'] . "</p>"; // Display the message
    unset($_SESSION['message']); // Clear the message after displaying
}
?>

<script>
    const fnameInput = document.getElementById('fname');
    const lnameInput = document.getElementById('lname');
    const ssnInput = document.getElementById('ssn');

    // Function to automatically format SSN input
    function formatSSN(SSN) {
        const formattedSSN = SSN.replace(/\D/g, ''); // Remove non-numeric characters
        if (formattedSSN.length > 8) {
            return formattedSSN.slice(0, 8) + '-' + formattedSSN.slice(8, 12); // Format as YYYYMMDD-XXXX
        } else {
            return formattedSSN;
        }
    }

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

    // Event listener to update the ssn field as the user types
    ssnInput.addEventListener('input', function () {
        const cursorPosition = ssnInput.selectionStart; // Save cursor position

        // Format the SSN
        const formattedSSN = formatSSN(ssnInput.value);
        ssnInput.value = formattedSSN;

        // Calculate the new cursor position
        let newCursorPosition;
        if (cursorPosition < 8) {
            newCursorPosition = cursorPosition; 
        } else {
            newCursorPosition = cursorPosition + 1;
        }
        ssnInput.setSelectionRange(newCursorPosition, newCursorPosition);
    });

    // Event listener for Firstname input
    fnameInput.addEventListener('input', function() {
        fnameInput.value = formatName(fnameInput.value); 
    });

    // Event listener for Lastname input
    lnameInput.addEventListener('input', function() {
        lnameInput.value = formatName(lnameInput.value);
    });
</script>
