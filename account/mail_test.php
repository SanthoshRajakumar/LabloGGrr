<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isHTML(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->Username = "labloggr@gmail.com";
$mail->Password = "labloggr123#";
$mail->SMTPSecure = 'tls'; 
$mail->Port=587;
$mail->setFrom("labloggr@gmail.com", "LabLoGGr");
$mail->addAddress("sara_1022@hotmail.com", "Sara");
$mail->addReplyTo("labloggr@gmail.com", "LabLoGGr");
$mail->isHTML(false);
$mail->Subject = 'MailMail';
$mail->Body = "hejhejhej";
$mail->AltBody = "AltAltAlt";
$mail->SMTPDebug = 3; // Enable verbose debug output


try {
    $mail->send();
    echo "tried?";
} catch (Exception $e) {
    echo "Message could not be sent Error:". $mail->ErrorInfo ."";}



?>
