<?php

if (isset($_POST['fName']))
	$fName = $_POST['fName'];
else
	$fName = "";

if (isset($_POST['sName']))
	$sName = $_POST['sName'];
else
	$sName = "";


if (isset($_POST['email']))
	$email = $_POST['email'];
else 
	$email = "";

if (isset($_POST['cEmail']))
	$cEmail = $_POST['cEmail'];
else
	$cEmail = "";

if (isset($_POST['pw']))
	$pw = $_POST['pw'];
else
	$pw = "";

if (isset($_POST['cPw']))
	$cPw = $_POST['cPw'];
else
	$cPw = "";



	
	if ($email == $cEmail)
		$emailMatch = true;
	else
		$emailMatch = false;
	
	if ($pw==$cPw)
		$pwMatch = true;
	else
		$pwMatch = false;



function dupEmail($em){
		require_once("dbconnect.php");
	$db = db_connect();
	$query = "select email from userdets where email='$em'";
	
	 if ($dupcount = mysqli_query($db, $query))
			{
				
				if(mysqli_num_rows($dupcount) > 0){
					$dup = true;
				}
				else
					$dup = false;
			}
				
				if ($dup==false)
				return true; // not a duplicate (true means good... !)
				else 
					return false; // yes duplicate!
	
}

function validEmail($em){
	if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $em)) {
						return true;
						} else {
						return false;
						}
}


function checkText($input){
	$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " "); 
	if (ctype_alpha(str_replace($accLet,'',$input)))
		return true;
	else
		return false;
}


function confirm($input1, $input2){
	
	if ($input1!=$input2){
		return false;
	}
	else{
		return true;
	}
}


	if (($fName=="")||($sName=="")||($email=="")||($cEmail=="")||($pw=="")||($cPw=="")){
	
			echo "<div id='errMsg'><h3> The following information was missing: </h3>";
			echo"<ul class='errorlist'>";
			echo ($fName==""?"<li>Forename</li>":"");
			echo ($sName==""?"<li>Surname</li>":"");
			echo ($email==""?"<li>Email Address</li>":"");
			echo ($cEmail==""?"<li>Email Address Confirmation</li>":"");
			echo ($pw==""?"<li>Password</li>":"");
			echo ($cPw==""?"<li>Password Confirmation</li>":"");
			echo "</ul></div>";
	}
	else
	{
		if ((checkText($fName)==false)||(checkText($sName)==false)||(dupEmail($email)==false)||(validEmail($email)==false)||(confirm($pw, $cPw)==false)||(confirm($email, $cEmail)==false)){
	
			echo "<div id='errMsg'><h3> The data had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo (checkText($fName)==false?"<li>Forename can only alphanumeric characters</li>":"");
			echo (checkText($sName)==false?"<li>Surname Can only alphanumberic letters</li>":"");
			echo (dupEmail($email)==false?"<li>Email already exists on system</li>":"");
			echo (validEmail($email)==false?"<li>Email address invalid</li>":"");
			echo (confirm($email, $cEmail)==false?"<li>Email addresses don't match</li>":"");
			echo (confirm($pw, $cPw)==false?"<li>Paswords don't match</li>":"");
			echo "</ul></div>";
			
		}
		else 
		{
			$hash = $email . $pw;
				require_once("dbconnect.php");
	        $db = db_connect();
			$query = "INSERT INTO userdets(userID, forname, surname, email, pw, userTypeID, loginHash) VALUES (DEFAULT, '$fName' ,'$sName','$email', sha1('$pw'), 2, sha1('$hash'))";
		
			if (mysqli_query($db, $query)) {
               require_once("../sendpulse/mailtest.php");
			   createAcc($email, $fName);
			   
			   echo "
			      <script type='text/javascript' src='js/localforage.js'></script>
			         <script>
						localforage.setItem('lfHash','". sha1($hash)."').then(function(value){
							console.log('hash set to ' + '".sha1($hash)."'); //store hash locally, allowing to login!
							alert('Account Creation Scuessful!');
							window.location.href='home.html';	
							
						});//set hash to lf
						</script>";
					
					
						
						
                 } else {
					echo "Error: " . $query . "<br>" . mysqli_error($db);
					
					}
		}

	
		
	}


?>