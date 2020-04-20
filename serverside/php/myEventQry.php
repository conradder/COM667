<?php
function getEv($qry, $long, $lat){

	require_once("dbconnect.php");
	$db=db_connect();
	

		$stmt = $db->prepare($qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($evID, $evDate, $evTime, $venue, $add, $city, $lt, $lng, $notes, $name);
		
		$resCount = $stmt->num_rows; 
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
				array_push($arrLat, $lt);
				array_push($arrLng, $lng);
			}
			
			$count=0;
	$res = sizeof($arrID);

	 if ($res > 0){
			 for ($i=0;$i<$res;$i++){	 
			 
							$url="location.href='event.html?evID=$arrID[$i]'";
					echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.$arrCity[$i].'</i></b></div>
					<div class="content">'.$arrVen[$i].' <b style="float:right;">'. getDistance($long, $lat, $arrLng[$i], $arrLat[$i]) .' km </b><br/>'.date_format(date_create($arrDate[$i]), 'd/m/Y').'
						</div>
					</ons-card>';
			 
			/*			echo "<div> 
							$arrCity[$i] <br/> 
						".date_format(date_create($arrDate[$i]), 'd/m/Y')." - ".date_format(date_create($arrTime[$i]), 'H:i')." <br/>
						$arrVen[$i] <br/>" .
						getDistance($long, $lat, $arrLng[$i], $arrLat[$i]) . "km <br/> <a href='event.html?evID=$arrID[$i]'>More Info</a><hr>
							</div>";*/
					//	$count++;
				
				 }//for
		 }
			else
				echo "Ní raibh aon toradh / No Results Found!";
	
	}//func
?>