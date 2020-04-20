
<?php
function getUpcoming($userLng, $userLat){
	require_once("getDistance.php");
	
//get upcoming events - stick them in an array to do something with them

include("getEventsFromDB.php");

//following code gives three random upcoming events 

$count=0;
$upcomingEv = array();
$match;
$rand;

if ($resCount>3)
	$range=3;
else
	$range=$resCount;



do {
	$match = false;
	$rand = array_rand($arrID);
	
	if ($count >0){
		//check for dup
			for ($i=0; $i<$count;$i++){
					if ($rand == $upcomingEv[$i])
						$match = true;
			}//for
	}//if
	
	
	if ($match==false){
		array_push($upcomingEv, $rand);
		$count++;
	}


} while ($count < $range);

for ($i=0;$i<sizeof($upcomingEv);$i++){
	$val =$upcomingEv[$i];
	$url="location.href='event.html?evID=$arrID[$val]'";
	echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.$arrCity[$val].'</i></b></div>
					<div class="content">'.$arrVen[$val].' <b style="float:right;">'. getDistance($userLng, $userLat, $arrLng[$val], $arrLat[$val]) .' km </b><br/>'.date_format(date_create($arrDate[$val]), 'd/m/Y').'
				</div>
			</ons-card>';
	
	
	
	
	
	/*"<div> 
		$arrCity[$val] <br/> 
		".date_format(date_create($arrDate[$val]), 'd/m/Y')." - ".date_format(date_create($arrTime[$val]), 'H:i')." <br/>
		$arrVen[$val] <br/>" 
		. getDistance($userLng, $userLat, $arrLng[$val], $arrLat[$val]) . "km <br/>
		<a href='event.html?evID=$arrID[$val]'>More Info</a><hr>
	
	</div>";*/
	//get info

	//make date time display better
	
}

}
?>