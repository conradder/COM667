<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';


function createAcc($em, $fn){


$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp-pulse.com';
$mail->SMTPAuth = true;
$mail->Username = 'conorfearon@hotmail.com';
$mail->Password = 'oZ8EQ8jBeNr29oe';
$mail->SMTPSecure = 'ssl';
$mail->Port='465';
$mail->CharSet = 'UTF-8';
$mail->setFrom('fearon-c8@ulster.ac.uk', 'PUG App');
$mail->addAddress($em);
$mail->isHTML(true);   
$mail->Subject = 'Fáilte/Welcome  '.$fn;
$mail->Body = 'Dia Duit, '.$fn.'<br/>You have sucessfully registered<br/>Kind Regards';
$mail->SMTPDebug =1;

if ($mail->send())
	echo "Email Sent";

}

?>