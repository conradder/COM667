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
 $mail->AltBody = 'Dia Duit, '.$fn.'You have sucessfully registered. Kind Regards';
$mail->SMTPDebug =0;

$mail->send();


}


function createEventEM($em, $fn, $date, $time, $notes, $vName, $vAdd, $vCity){
	
	
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
$mail->Subject = 'Event Created  '.$fn;
$mail->Body = 'Dia Duit, '.$fn.'<br/>You have sucessfully registered a new event<br/>Details: 
<ul>
	<li>Date/Time:'.$date .'- '. $time .'</li>
	<li>Venue:'.$vName.'</li>
	<li>Address:'.$vAdd . ', '. $vCity .'</li>
	<li>Notes: '.$notes.'</li>
</ul>';
 $mail->AltBody = 'Dia Duit, '.$fn.'. You have sucessfully registered a new event. Details: Date/Time:'.$date .'- '. $time .'Venue:'.$vName.'Address:'.$vAdd . ', '. $vCity .'Notes: '.$notes.'. Regards';
$mail->SMTPDebug =0;

$mail->send();
	
	
}

function editaccEM($em, $fn, $sn){
	
	
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
$mail->Subject = 'Changes to account  ';
$mail->Body = 'Dia Duit, '.$fn.'<br/>Changes Made to your PUG App account<br/>Details: 
<ul>
	<li>Name:'.$fn .' '. $sn .'</li>
	<li>Email :'.$em.'</li>
</ul>';
 $mail->AltBody = 'Dia Duit, '.$fn.'. Changes Made to your PUG App account<br/>Details: Name:'.$fn .' '. $sn .'Email :'.$em.' - Regards';
$mail->SMTPDebug =0;

$mail->send();
	
	
}



function forgotPW($em, $hash, $fn){
	
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
$mail->Subject = $fn . ' - Here is your password reset link  ';
$mail->Body = 'Dia Duit, ' .$fn .'<br/> A password reset has been requested <br/>If this was not you please contact us.<br/> Follow link below to reset password <a href="https://scm.ulster.ac.uk/~b00699799/COM667/php/newPW.php?token='.$hash.'">Click Here</a> to reset Password<br/> regards';
 $mail->AltBody =  'Dia Duit, ' .$fn .' A password reset has been requested <br/>If this was not you please contact us. Follow link to reset password https://scm.ulster.ac.uk/~b00699799/COM667/php/newPW.php?token='.$hash.' regards';
$mail->SMTPDebug =0;

$mail->send();
	
	
}



function pwchange($em, $fn){
	
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
$mail->Subject = 'Changes to account  ';
$mail->Body = 'Dia Duit, ' .$fn .'<br/> The password has been sucessfully changed on your account. <br/>If this change was not instigated by you please contact us<br/> regards';
 $mail->AltBody = 'Dia Duit, ' .$fn .' The password has been sucessfully changed on your account. If this change was not instigated by you please contact us. Regards';
$mail->SMTPDebug =0;

$mail->send();
	
}




?>