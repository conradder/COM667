<?php
require_once("dbconnect.php");
$db=db_connect();


if (isset($_POST['vID']))
	$vID = $_POST['vID'];
else
	$vID = "";

if (isset($_POST['vName']))
	$vName = $_POST['vName'];
else
	$vName = "";

if (isset($_POST['vAdd']))
	$vAdd = $_POST['vAdd'];
else
	$vAdd = "";

if (isset($_POST['vCity']))
	$vCity = $_POST['vCity'];
else
	$vCity = "";


if (isset($_POST['vLng']))
	$vLng = $_POST['vLng'];
else
	$vLng = "";


if (isset($_POST['vAdd']))
	$vLat = $_POST['vLat'];
else
	$vLat = "";

if (isset($_POST['hash']))
	$hash = $_POST['hash'];
else
	$hash = "";



//check  no bad characters in venue dets



function checkText($input){

if ($input=="")
	return true;
else{
$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " ", "-", "!", "?", ".", "-", "1","2","3","4","5","6","7","8","9","0"); //fix this up!!!

	if (ctype_alpha(str_replace($accLet,'',$input)))
		return true;
	else
		return false;
}


}





$qry = "SELECT * FROM `fsq_venuedets` WHERE fsq_id = '$vID'";
$result = $db->query($qry);
 if ($result->num_rows){
	$venueOK=true;
 }
 else
 {
	 if (($vID!=="")&&($vName!=="")&&($vLat!=="")&&($vLng!=="")&&($vCity!=="")&&(checkText($vID)==true)&&(checkText($vName)==true)&&(checkText($vCity)==true)&&(is_numeric($vLat)==true)&&(is_numeric($vLng)==true)&&(checkText($vAdd)==true)){
		 //all good! 
		 $vQry = "INSERT INTO fsq_venuedets (fsq_id, venueName, venueAdd, venueCity, venueLat, venueLng) VALUES ('$vID','$vName','$vAdd','$vCity','$vLat','$vLng')";
		 
		 if (mysqli_query($db, $vQry)) {
						$venueOK=true;

                 } else {
					echo "Error: " . $vQry . "<br>" . mysqli_error($db);
					$venueOK = false;
				 }//else query fail
	 //write to database
	 
	}//checks
	else{
		echo "<div id='errMsg'><h3> The Venue had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo ($vID!==""?"<li>No Venue ID</li>":"");
			echo ($vName!==""?"<li>No Venue Name</li>":"");
			echo ($vLat!==""?"<li>No Latitude</li>":"");
			echo ($vLng!==""?"<li>No Longitude</li>":"");
			echo ($vCity!==""?"<li>No City</li>":"");
			echo (checkText($vID)==false?"<li>Invalid ID</li>":"");
			echo (checkText($vCity)==false?"<li>Invalid Text in City</li>":"");
			echo (checkText($vAdd)==false?"<li>Invalid Text in Address</li>":"");
			echo (is_numeric($vLat)==false?"<li>Invalid Latitude </li>":"");
			echo (is_numeric($vLng)==false?"<li>Invalid longitude </li>":"");
			echo "</ul></div>";
		$venueOK = false;
		}
 }//else write to db


if (isset($_POST['date']))
	$date = $_POST['date'];
else
	$date = "";

if (isset($_POST['time']))
	$time = $_POST['time'];
else
	$time = "";

if (isset($_POST['notes']))
	$notes = $_POST['notes'];
else
	$notes = "";


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


function dupEvent($inID, $inDate){
	require_once("dbconnect.php");
	$db = db_connect();
	$checkDup = "SELECT * FROM `eventdets` WHERE evDate = '$inDate' and evLoc= '$inID'";
	
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



require_once("getUserDets.php");



if (($hash=="")||(getUserID($hash)==" "))
{
	echo "here?";
	
}
else
{
	
	
	
	if (($venueOK==true)&&(checkNoteSize($notes)==true)&&(checkText($notes)==true)&&(checkDateFuture($date)==true)&&(checkDateValid($date)==true)&&(checkTimeValid($time)==true)&&(dupEvent($vID, $date)==true)){
		require_once("dbconnect.php");
	    $db = db_connect();
		$eQry = "INSERT INTO eventdets (eventID, evDate, evTime, evLoc, notes, createdBy) VALUES (DEFAULT,'$date','$time','$vID','$notes', ".getUserID($hash).")";
		if (mysqli_query($db, $eQry)) {
               $em = getUserEm($hash);
			   $fn = getFirstName($hash);
			   
			       require_once("../sendpulse/mailtest.php");
			   createEventEM($em, $fn, $date, $time, $notes, $vName, $vAdd, $vCity);
			   
			   echo "
			           <script>
							alert('Event Creation Scuessful!');
							window.location.href='home.html';	
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
			echo ($venueOK==false?"<li>Problem Writing Venue to database </li>":"");
			echo "</ul></div>";
	}
	
}

?>