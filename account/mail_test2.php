<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include '/backend/functions.php';

sendEmail("sara_1022@hotmail.com", "test", "<h1> hej detta är ett test </h1>", "hej detta är ett test")




?>
