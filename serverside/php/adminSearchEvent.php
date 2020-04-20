<?php

require_once("getDistance.php");

 if ((isset($_POST['evID'])))
	$evID = $_POST['evID'];
	else
		$evID="";
	
 if ((isset($_POST['city'])))
	$city= $_POST['city'];
	else
		$city="";

 if ((isset($_POST['venue'])))
	$venue = $_POST['venue'];
	else
		$venue="";
	
if ((isset($_POST['date'])))
	$date = $_POST['date'];
	else
		$date="";

if ((isset($_POST['lon'])))
	$long = $_POST['lon'];
	else
		$long="";
	
	if ((isset($_POST['lat'])))
	$lat = $_POST['lat'];
	else
		$lat="";

function checkDateValid($input){
	if ($input=="")
		return false;
	else
	{
	$chkdate = new DateTime($input);

	$y= $chkdate->format('Y');
	$m = $chkdate->format('m');
	$d = $chkdate->format('d');

if (checkdate($m,$d,$y)){
	return true;

}
else
	return false;
	}
	
}


function checkText($input){

if ($input=="")
	return "";
else{
$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " ", "-", "!", "?", ".", "-", "1","2","3","4","5","6","7","8","9","0"); //fix this up!!!

	if (ctype_alpha(str_replace($accLet,'',$input)))
		return $input;
	else
		return "";
}


}

function idNum($input){
//qry fails if non numberic entered as ID	
	if (is_numeric($input))
		return $input;
	else
		return "";

}

$city = checkText($city);
$venue = checkText($venue); 
$evID = idNum($evID);



$qry1 = "SELECT eventdets.eventID, eventdets.evDate, eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueAdd, fsq_venuedets.venueCity, fsq_venuedets.venueLat, fsq_venuedets.venueLng, eventdets.notes, CONCAT(userdets.forname,' ', userdets.surname) as 'name' FROM eventdets inner join userdets on eventdets.createdBy = userdets.userID inner JOIN fsq_venuedets on eventdets.evLoc = fsq_venuedets.fsq_id where " . (checkDateValid($date)==true?" evDate ='$date' ":" evDate >= CURRENT_DATE"). " and " . ($evID!=''?"eventdets.eventID=$evID":"eventdets.eventID like '%' "). " and " . ($city!=''?"fsq_venuedets.venueCity like '%$city%'":"fsq_venuedets.venueCity like '%'") . " and " . ($venue!=''?"fsq_venuedets.venueName like '%$venue%'":"fsq_venuedets.venueName like '%'") ." order by evDate asc" ;



require_once("myEventQry.php");

echo "<h5>Search Results</h5>";

getEv($qry1, $long, $lat);


?>