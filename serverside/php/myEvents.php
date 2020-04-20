<?php
require_once("getDistance.php");
include("getClientVal.php");

 if ((isset($_GET['uID'])))
	$uID = $_GET['uID'];
	else
		$uID="";
	



$qry1 = "SELECT eventdets.eventID, eventdets.evDate, eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueAdd, fsq_venuedets.venueCity, fsq_venuedets.venueLat, fsq_venuedets.venueLng, eventdets.notes, CONCAT(userdets.forname,' ', userdets.surname) as 'name' FROM eventdets inner join userdets on eventdets.createdBy = userdets.userID inner JOIN fsq_venuedets on eventdets.evLoc = fsq_venuedets.fsq_id WHERE evDate >= CURRENT_DATE and eventdets.createdBy = $uID  order by evDate asc" ;

$qry2 = "SELECT eventdets.eventID, eventdets.evDate, eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueAdd, fsq_venuedets.venueCity, fsq_venuedets.venueLat, fsq_venuedets.venueLng, eventdets.notes, CONCAT(userdets.forname,' ', userdets.surname) as 'name' FROM eventdets inner join userdets on eventdets.createdBy = userdets.userID inner JOIN fsq_venuedets on eventdets.evLoc = fsq_venuedets.fsq_id WHERE evDate < CURRENT_DATE and eventdets.createdBy = $uID  order by evDate asc" ;

require_once("myEventQry.php");

echo "<h5>My Upcoming Events</h5>";
if ($uID!="")
getEv($qry1, $long, $lat);
else
	echo "Problem Getting Events";

echo "<h5>My Previous Events</h5>";
if ($uID!="")
getEv($qry2, $long, $lat);
else
	echo "Problem Getting Events";

	
?>