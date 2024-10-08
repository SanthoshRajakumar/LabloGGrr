<?php 
function generateUsername($fname, $lname) {
    $digits = [];
    for ($i = 0; $i < 4; $i++) {
        // Generate a random digit between 0 and 9
        $randomDigit = rand(0, 9);
        $digits[] = $randomDigit;
    }
    return strtolower(substr($fname, 0, 2) . substr($lname, 0, 2)) . implode('', $digits);
}

function generatePassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, $maxIndex);
        $password .= $characters[$index];
    }
    return $password;
}

function generateHexSalt($length = 16) {
    return bin2hex(random_bytes($length));
}
?>