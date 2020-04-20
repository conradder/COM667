<?php
require_once("dbconnect.php");
if (isset($_POST['uID']))
	$uID= $_POST['uID'];
else
	$uID = "";

if (isset($_POST['nPW']))
	$nPW= $_POST['nPW'];
else
	$nPW = "";


if (isset($_POST['cPW']))
	$cPW= $_POST['cPW'];
else
	$cPW = "";

if ($nPW==$cPW)
		$pwMatch = true;
	else
		$pwMatch = false;


function getEmail($id){
	$db=db_connect();
	$qry = "select email from userdets where userID = $id";
	
	
	  if(isset($db->query($qry)->fetch_object()->email))
		  $email	= $db->query($qry)->fetch_object()->email;
	  else
		  $email=""; 
			
			
	return $email;

}


function getName($id){
	$db=db_connect();
	$qry = "select forname from userdets where userID = $id";
	
	
	  if(isset($db->query($qry)->fetch_object()->forname))
		  $fname= $db->query($qry)->fetch_object()->forname;
	  else
		  $fname=""; 
			
			
	return $fname;

}


if (($uID=="")||($nPW=="")||($cPW=="")){

	echo ($uID==""?"Problem Resetting Password!":"Fields Cannot be Blank");

}
else{
	
	if (($pwMatch==true)&&(getEmail($uID)!="")){
				$hash = getEmail($uID) . $nPW;
				require_once("dbconnect.php");
				$db = db_connect();
				$qry = "UPDATE userdets SET pw=sha1('$nPW'), loginHash=sha1('$hash') WHERE userID = $uID";
				
				$timestamp = time();
				$newhash = $email . $timestamp;
				$newhash = sha1($newhash);
				
				 $qry2 = "UPDATE pwreset set resetHash='$newhash' where userID = $uID";
				 require_once("../sendpulse/mailtest.php");
						pwchange(getEmail($uID),getName($uID));
						
				if (mysqli_query($db, $qry)) {
					 require_once("../sendpulse/mailtest.php");
						pwchange(getEmail($uID),getName($uID));
						if (mysqli_query($db, $qry2)){
							echo "<script> alert('Password Sucessfuly Reset'); location.reload();</script>";
					//now send an email confirmation!
							}
							else
							echo "Error: " . $qry2. "<br>" . mysqli_error($db);
					}//if qry success
					else
					{
				 	echo "Error: " . $qry. "<br>" . mysqli_error($db);
					}
					
		}
		else{
			
			echo ($pwMatch==false?"Passwords dont match":"");
	
			}
	
	
}





?>