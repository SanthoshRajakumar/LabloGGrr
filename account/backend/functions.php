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

function sendEmail($toAddress, $subject, $body, $altBody) {
    $mail = new PHPMailer(true);
    $mail->isHTML(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "labloggr@gmail.com";
    $mail->Password = "jvyj tbnr tuxz yirj"; //labloggr123#
    $mail->SMTPSecure = 'tls'; 
    $mail->Port=587;
    $mail->setFrom("noreply@labloggr.com", "LabLoGGr");
    $mail->addAddress($toAddress);
    $mail->addReplyTo("labloggr@gmail.com", "LabLoGGr");
    //$mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $altBody;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent Error:". $mail->ErrorInfo ."";}
}
?>

