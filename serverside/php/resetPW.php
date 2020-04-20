<?php

if (isset($_POST['em']))
	$email= $_POST['em'];
else
	$email = "";

$timestamp = time();
$hash = $email . $timestamp;
$hash = sha1($hash);




function checkValidEmail($input){
	
		if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $input)) {
						return true;
						} else {
						return false;
						}
						
}

function checkInDB($em){
		require_once("dbconnect.php");
	$db = db_connect();
	$query = "select email from userdets where email='$em'";
	
	 if ($dupcount = mysqli_query($db, $query))
			{
				
				if(mysqli_num_rows($dupcount) > 0){
					return true;
				}
				else
					return false;
			}
				
			
}



function checkInResetTbl($id){
		require_once("dbconnect.php");
	$db = db_connect();
		$query= "SELECT * from pwreset where userID =  $id";
	
	 if ($dupcount = mysqli_query($db, $query))
			{
				
				if(mysqli_num_rows($dupcount) > 0){
					return true;
				}
				else
					return false;
			}
				
			
}




function getUserID($em){
	

	
		$db=db_connect();
	$qry = "select userID from userdets where email = '$em'";
	
	
	  if(isset($db->query($qry)->fetch_object()->userID))
		  $id	= $db->query($qry)->fetch_object()->userID;
	  else
		  $id= " "; //default to standard user!
			
			
	return $id;


	
}

function getfname($em){
	

	
		$db=db_connect();
	$qry = "select forname from userdets where email = '$em'";
	
	
	  if(isset($db->query($qry)->fetch_object()->forname))
		  $name	= $db->query($qry)->fetch_object()->forname;
	  else
		  $name= " "; //default to standard user!
			
			
	return $name;


	
}




if ((checkInDB($email)==true) && (checkValidEmail($email)==true)){
		require_once("dbconnect.php");
		$db = db_connect();
		
		if (checkInResetTbl(getUserID($email))==true){
				$drop = "DELETE FROM pwreset WHERE userID = " . getUserID($email)."";
				mysqli_query($db, $drop);
		
		}
		
		
		
		$qry = "INSERT INTO pwreset(resetID, userID, resetHash, resetdate, resettime) VALUES (default,'".getUserID($email)."','$hash','".date('Y-m-d')."' ,'".date('H:i')."')";
			 require_once("../sendpulse/mailtest.php");
					
						
				if (mysqli_query($db, $qry)) {
					
					 require_once("../sendpulse/mailtest.php");
					 forgotPW($email, $hash, getfname($email));
					
					echo "
						<script>
							alert('Check Inbox');
									window.location.href='profile.html';	
						</script>";
					
					//now send an email confirmation!
						
						
					}//if qry success
					else
					{
				 	echo "Error: " . $qry. "<br>" . mysqli_error($db);
					}
					



}
else
{
	//im chosing not to do a "email not found" thing - if you wanted someones email address you could figure it out with trail and error.. well thats my logic...
	
	echo "
						<script>
							alert('Check Inbox');
									window.location.href='profile.html';	
						</script>";
	
	
}




//verify correct email
//verify if in DB
//create hash
//email




?>