<?php

include("getClientVal.php");
include("getUserDets.php");




function getinterested($ID){
			require_once("dbconnect.php");
			$db = db_connect();
			$qry = "select count(userID) as 'num' from userreminder where eventID = $ID";
	
	if(isset($db->query($qry)->fetch_object()->num))
		  $num	= $db->query($qry)->fetch_object()->num;
	  else
		  $num= 0;
			
			
	return $num;
}
			


 if ((isset($_GET['evID']))){
	 	$evID = $_GET['evID'];
		if ($evID!=false){
		
		require_once("dbconnect.php");
		$db = db_connect();
		
		$evQry = "select eventdets.evDate, eventdets.evTime, eventdets.notes, fsq_venuedets.venueName, fsq_venuedets.venueAdd, fsq_venuedets.venueCity,fsq_venuedets.venueLat,fsq_venuedets.venueLng, concat(userdets.forname,' ', userdets.surname) as 'host', eventdets.createdBy, eventdets.evLoc, eventdets.cancelled from eventdets inner join fsq_venuedets on eventdets.evLoc = fsq_venuedets.fsq_id inner join userdets on userdets.userID = eventdets.createdBy where eventID = $evID";
		$stmt = $db->prepare($evQry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($date, $time, $notes, $venue, $add, $city, $lat, $lng, $name, $uID, $loc, $cancelled);
		$resCount = $stmt->num_rows;
		
		if ($resCount > 0 ){
		while($stmt->fetch()){
			
	
				
				if (strlen($notes)!=0){
				
				$notes1	= '<b>' . ($lang=="GA"?"Nótaí ":"Notes: ") . '</b>' .$notes; 
				}
				else
					$notes1="";
			
			$time = date_format(date_create($time), 'H:i');
					$interested = getinterested($evID);
		echo '<ons-card style="border-style: solid;");>
			<div class="title"><b><i>'.$city.' ' .date_format(date_create($date), 'd/m/Y') .'</i></b></div>
					<div class="content">' 
					 . ($lang=="GA"?"<b>Ionad: </b>":"<b>Venue: </b>") . $venue . '<br/>'  
					 . ($lang=="GA"?"<b>Deoladh: </b>":"<b>Address: </b>") . $add . '<br/>'
					 . ($lang=="GA"?"<b>Am: </b>":"<b>Time: </b>") . $time . '<br/>' 
					 . ($lang=="GA"?"<b>Óstachr: </b>":"<b>Created By: </b>") . $name . '<br/><br/> ' 
					 . $notes1 . '<br/><br/>'
					 . $interested .  ($lang=="GA"?" bhfuil suim":" are interested") .' 
						</div>
					</ons-card>';
			
			/*echo '<table>';
			echo '<tr><td><b>' . ($lang=="GA"?"Catdair:":"City:") . '</b></td><td>' .$city.'</td></tr>'; 
			echo '<tr><td><b>' . ($lang=="GA"?"Ionad":"Venue") . '</b></td><td>' .$venue.'</td></tr>'; 
			echo '<tr><td><b>' . ($lang=="GA"?"Deoladh":"Address") . '</b></td><td>' .$add.'</td></tr>'; 
			echo '<tr><td><b>' . ($lang=="GA"?"Dáta":"Date") . '</b></td><td>' .date_format(date_create($date), 'd/m/Y').'</td></tr>'; 		
			echo '<tr><td><b>' . ($lang=="GA"?"Am":"Time") . '</b></td><td>' .$time.'</td></tr>'; 	
			echo '<tr><td><b>' . ($lang=="GA"?"Óstachr":"Created By:") . '</b></td><td>' .$name.'</td></tr>'; 	
			echo $notes1;
			echo '</table>';*/
			
		//	echo $city . "<br/>". $date . " -" . $time . "<br/>" . $venue . $notes . "etc etc<br/><br/>";
			//make nice
		}
		
		
		if (getUserID($hash)!=" "){
			$db = db_connect();
			$qry = "SELECT * FROM `userreminder` WHERE userID = ".getUserID($hash)." and eventID = $evID";
			$result = $db->query($qry);
			 if ($result->num_rows) {
				 	echo '<ons-card style="border-style: solid;" );>
			<div class="title"><b><i>' . ($lang=='GA'?' Tá mé leasmhar':' I am interested') .'</i></b></div>
					</ons-card>';
			 }
			else{
			
			
		$usID= getUserID($hash);
		$url = "location.href='declareInterest.html?eID=$evID&uID=$usID'";
		
		echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
			<div class="title"><b><i>' . ($lang=='GA'?' An bhfuil tú leasmhar?':' Are you interested?') .'</i></b></div>
					</ons-card>';
			}

		
		}
		
		echo "<br/><br/>";
	    if((getUserType($hash)==1)||(getUserID($hash)==$uID)){
			
			require_once("utfFadaConvert.php");
			$notes = utfFadaConvert($notes);
			
			//if admin or hash==userID
			$url = "location.href='editEvent.html?id=$evID&evDate=$date&evTime=$time&evNotes=$notes&venue=$loc&cancelled=$cancelled&lang=$lang'";
			 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Edit Event
						</div>
					</ons-card>';
			
				$url = "location.href='changeVenue.html?id=$evID'";
			 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Change Venue
						</div>
					</ons-card>';
			
			//echo "<a href='editEvent.html?id=$evID&evDate=$date&evTime=$time&evNotes=$notes&venue=$loc&cancelled=$cancelled&lang=$lang'>".($lang=='GA'?'Cuir in eagar':'Edit Event')."</a><br/><a href='changeVenue.html?id=$evID'>".($lang=='GA'?'Athrú ionaid':'Change Venue')." </a>";
			
		}
		
	
		
		
		}
		else
			echo ($lang=='GA'?'<h2>Earráid</h2?':'<h2>Error Getting Result</h2>'); 
		
			//$stmt->free_result();
			//$db->close();
		
	
	//	echo $evID;
	//get stuff from tde data base!
	//link to edit if applicaple // if user id matches!
	//interested button!
	
	}
	else
		echo "error getting result!";





 }
 else 
	  echo "error getting result!";//if exception 



?>