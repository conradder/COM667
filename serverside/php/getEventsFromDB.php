<?php require_once("dbconnect.php");
$db=db_connect();
$qry = "SELECT eventdets.eventID, eventdets.evDate, eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueAdd, fsq_venuedets.venueCity, fsq_venuedets.venueLat, fsq_venuedets.venueLng, eventdets.notes, CONCAT(userdets.forname,' ', userdets.surname) as 'name' FROM eventdets inner join userdets on eventdets.createdBy = userdets.userID inner JOIN fsq_venuedets on eventdets.evLoc = fsq_venuedets.fsq_id WHERE evDate >= CURRENT_DATE  and (eventdets.cancelled = 0 or eventdets.cancelled is null) order by evDate asc" ;

	$stmt = $db->prepare($qry);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($evID, $evDate, $evTime, $venue, $add, $city, $lat, $lng, $notes, $name);
	
	$resCount = $stmt->num_rows; // useful if < 3 results
	$arrID=array();
	$arrDate=array();
	$arrTime=array();
	$arrCity=array();
	$arrVen=array();
	$arrLat=array();
	$arrLng=array();
	
	
		while($stmt->fetch()){
			array_push($arrID, $evID);
			array_push($arrDate, $evDate);
			array_push($arrTime, $evTime);
			array_push($arrCity, $city);
			array_push($arrVen, $venue);	
			array_push($arrLat, $lat);
			array_push($arrLng, $lng);
		}
		?>