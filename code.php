
<?php
function generateHexSalt($length = 16) {
    return bin2hex(random_bytes($length));
}

print(generateHexSalt())
?>
