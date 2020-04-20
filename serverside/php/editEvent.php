<?php

if (isset($_POST['date']))
	$date = $_POST['date'];
else
	$date = "";

if (isset($_POST['loc']))
	$vID = $_POST['loc'];
else
	$vID = "";

if (isset($_POST['time']))
	$time = $_POST['time'];
else
	$time = "";

if (isset($_POST['notes']))
	$notes = $_POST['notes'];
else
	$notes = "";



if (isset($_POST['hash']))
	$hash = $_POST['hash'];
else
	$hash = "";

if (isset($_POST['evID']))
	$evID = $_POST['evID'];
else
	$evID = "";


if (isset($_POST['cancelled']))
	$cancelled = 1;
else
	$cancelled = 0;

var_dump($cancelled);


function checkText($input){

if ($input=="")
	return true;
else{
$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " ", "-", "!", "?", ".",",", "-", "1","2","3","4","5","6","7","8","9","0"); //fix this up!!!

	if (ctype_alpha(str_replace($accLet,'',$input)))
		return true;
	else
		return false;
}


}


function checkTimeValid($input){
	//check 24 clock valid time
	if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $input))
		return true;
	else
		return false;	
}

function checkDateValid($input){
	
	$chkdate = new DateTime($input);

	$y= $chkdate->format('Y');
	$m = $chkdate->format('m');
	$d = $chkdate->format('d');

if (checkdate($m,$d,$y))
	return true;
else
	return false;
	
}

function checkDateFuture($input){
			if ($input >= date("Y-m-d"))
				return true;
			else
				return false;
}





function checkNoteSize($input){
	
	if (strlen($input)>250)
		return false;
	else
		return true;
}


function dupEvent($inID, $inDate, $evID){
	require_once("dbconnect.php");
	$db = db_connect();
	$checkDup = "SELECT * FROM `eventdets` WHERE evDate = '$inDate' and evLoc= '$inID' and eventID != '$evID'";
	
	 if ($dupcount = mysqli_query($db, $checkDup))
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

function getCreatedBy($evID){
	
		$db=db_connect();
		$qry = "select createdBy from eventdets where eventID = $evID";
	
	
	  if(isset($db->query($qry)->fetch_object()->createdBy))
		  $id	= $db->query($qry)->fetch_object()->createdBy;
	  else
		  $id= " "; //default to standard user!
			
	return $id;

}





require_once("getUserDets.php");



if (($hash=="")||(getUserID($hash)==" "))
{
	echo "here?";
	
}
else
{
	//if hash = admin, or user id == user ID!
		
	
	if ((checkNoteSize($notes)==true)&&(checkText($notes)==true)&&(checkDateFuture($date)==true)&&(checkDateValid($date)==true)&&(checkTimeValid($time)==true)&&(dupEvent($vID, $date,$evID)==true)&&((getCreatedBy($evID)==getUserID($hash))||(getUserType($hash)==1))){
		require_once("dbconnect.php");
	    $db = db_connect();
		$eQry = "UPDATE eventdets SET evDate='$date',evTime='$time',notes= '$notes', cancelled='$cancelled' WHERE eventID = $evID";
		
		if (mysqli_query($db, $eQry)) {
               echo "
			           <script>
					 
							alert('Event Edited Sucessfully!');
							window.location.href='event.html?evID=$evID';	
						</script>";
					
					//now send an email confirmation!
						
						
                 } else {
					echo "Error: " . $eQry . "<br>" . mysqli_error($db);
					
					}		
		
	}
	else
	{
		
		echo "<div id='errMsg'><h3> The data had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo (checkNoteSize($notes)==false?"<li>Notes Limitied to 250 characters</li>":"");
			echo (checkText($notes)==false?"<li>Notes only alphanumberic letters</li>":"");
			echo (checkDateFuture($date)==false?"<li>Selected date has already happened</li>":"");
			echo (checkDateValid($date)==false?"<li>Invalid Date - check again</li>":"");
			echo (checkTimeValid($time)==false?"<li>Invalid Time - check again</li>":"");
			echo (dupEvent($vID, $date)==false?"<li>Event already created for $vName on $date</li>":"");
			echo (getCreatedBy($evID)!=getUserID($hash)?"<li>Error with login</li>":"");
			echo (getUserType($hash)!=1?"<li>Error with login</li>":"");
			echo "</ul></div>";
	}
	
}



?>