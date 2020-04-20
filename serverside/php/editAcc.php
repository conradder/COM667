<?php

if (isset($_POST['fname']))
	$fname = $_POST['fname'];
else
	$fname = "";


if (isset($_POST['sname']))
	$sname = $_POST['sname'];
else
	$sname = "";


if (isset($_POST['email']))
	$email= $_POST['email'];
else
	$email = "";

if (isset($_POST['uID']))
	$uID= $_POST['uID'];
else
	$uID = "";

//dont think i need this if pw being entered!
if (isset($_POST['hash']))
	$hash = $_POST['hash'];
else
	$hash = "";

if (isset($_POST['pw']))
	$pw = $_POST['pw'];
else
	$pw = "";


//valiate functions!

function checkPW($uID, $pw){
	
	require_once("dbconnect.php");
	$db=db_connect();
	$query = "SELECT * FROM userdets WHERE userID=$uID and pw=sha1('$pw')";
	$result = $db->query($query);
	 
	 if ($result->num_rows)
		 return true;
	 else
		 return false;
	
}

function checkText($input){
	$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " "); 
	if (ctype_alpha(str_replace($accLet,'',$input)))
		return true;
	else
		return false;
	
}

function checkValidEmail($input){
	
		if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $input)) {
						return true;
						} else {
						return false;
						}
						
}


function checkDupEmail($em, $id){
		require_once("dbconnect.php");
	$db = db_connect();
	$query = "select email from userdets where email='$em' and userID != $id";
	
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



if (($email=="")||($pw=="")||($uID=="")||($fname=="")||($sname=="")){
	echo ($pw==""?"password must be entered!":"Fields Cannot be Blank");

}
else
{
		if (checkPW($uID, $pw)==true){
			
			if ((checkText($fname)==true)&&(checkText($sname)==true)&&(checkDupEmail($email, $uID)==true)&&(checkValidEmail($email)==true)){
				$hash= $email . $pw;
				require_once("dbconnect.php");
				$db = db_connect();
				$qry = "UPDATE userdets SET forname='$fname',surname='$sname',email='$email',loginHash=sha1('$hash') WHERE userID=$uID";
						
						
						
						
					if (mysqli_query($db, $qry)) {
						
						require_once("../sendpulse/mailtest.php");
						editaccEM($email, $fname, $sname);
						
					echo "
					<script type='text/javascript' src='js/localforage.js'></script>
			         <script>
						localforage.setItem('lfHash','". sha1($hash)."').then(function(value){
							console.log('hash set to ' + '".sha1($hash)."'); //store hash locally, allowing to login!
							alert('Account Edited Scuessfully!');
							window.location.href='profile.html';	
							
						});//set hash to lf
						</script>";
					
					//now send an email confirmation!
						
						
					}//if qry success
					else
					{
				 	echo "Error: " . $query . "<br>" . mysqli_error($db);
					}
												
			}//if valid
			else{
			echo "<div id='errMsg'><h3> The data had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo (checkText($fname)==false?"<li>Forename can only alphanumeric characters</li>":"");
			echo (checkText($sname)==false?"<li>Surname Can only alphanumberic letters</li>":"");
			echo (checkDupEmail($email, $uID)==false?"<li>Email already exists on system</li>":"");
			echo (checkValidEmail($email)==false?"<li>Email address invalid</li>":"");
			echo "</ul></div>";
			}





			
		}
		else
		{

			echo "<h1>password incorrect</h1>";
		
		
		}
}
//validate
//change hash!, save, move to profile
//push to 

?>
