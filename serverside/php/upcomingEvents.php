

<?php
//to go get GPS co-ords, convert to Radians
//to do  - ability filter by dates and distance!
//default to eng but if GA selected go for GA!!!!!!!!!!!

function monthname($mth){

	switch ($mth){
	case 1: return "January";break;
	case 2: return "February";break;
	case 3: return "March";break;
	case 4: return "April";break;
	case 5: return "May";break;
	case 6: return "June";break;
	case 7: return "July";break;
	case 8: return "August";break;
	case 9: return "September";break;
	case 10: return "October";break;
	case 11: return "November";break;
	case 12: return "December";break;
    }//switch
//monthname
}

function GAmonthname($mth){

	switch ($mth){
	case 1: return "Eanáir";break;
	case 2: return "Feabhra";break;
	case 3: return "Márta";break;
	case 4: return "Aibreán";break;
	case 5: return "Bealtaine";break;
	case 6: return "Meitheamh";break;
	case 7: return "Iúil";break;
	case 8: return "Lúnasa";break;
	case 9: return "Meán Fomhair";break;
	case 10: return "Deireadh Fomhair";break;
	case 11: return "Samhain";break;
	case 12: return "Nollaig";break;
    }//switch
//monthname
}



require_once("dbconnect.php");
	$db = db_connect();
//	$query = "select * from vupcoming";
//$query ="select eventdets.eventID, eventdets.evDate, eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueCity, radians(fsq_venuedets.venueLat), radians(fsq_venuedets.venueLng) from eventdets inner JOIN fsq_venuedets on fsq_venuedets.fsq_id = eventdets.evLoc";
$query ="select eventdets.eventID, day(eventdets.evDate), month(eventdets.evDate), year(eventdets.evDate), eventdets.evTime, fsq_venuedets.venueName, fsq_venuedets.venueCity,radians(fsq_venuedets.venueLat) as 'latRad', radians(fsq_venuedets.venueLng) as 'longRad' from eventdets inner JOIN fsq_venuedets on fsq_venuedets.fsq_id = eventdets.evLoc where eventdets.evDate >= CURRENT_DATE()";

/**
For some reason it won't recgonise the view!!!!!! why!?!?
**/
	
	
	$stmt = $db->prepare($query);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id, $day,$month,$year, $time, $venue, $city, $latRad, $longRad);
	


		
	//to do - sort out styling this nice
		while($stmt->fetch()){
			echo $id . "<br/>";
			echo $day . " " . GAmonthname($month) . " " . $year .  "<br/>"; //date to display more meaningful! GA?


			echo $time . "<br/>";
			echo $venue . "<br/>";
			echo $city . "<br/>";
//to do, use formula to work out distance.
		echo $latRad ." " .$longRad. "<br/><br/><br/>";
			
		}

			$stmt->free_result();
				$db->close();
	

echo "test2";

?>
