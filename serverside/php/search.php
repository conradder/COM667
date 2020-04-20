<?php

require_once("getDistance.php");

$lang = $_POST['lang'];
$ulat = $_POST['lat'];
$long = $_POST['lon'];
$dist = $_POST['dist'];
$when = $_POST['when'];
$today = date("Y-m-d");


switch ($when){
	case "Today" : $when = $today; break;
	case "Week" : $when = date('Y-m-d', strtotime($today. ' + 7 days'));break;
	case "Month" :$when = date('Y-m-d', strtotime($today. ' + 1 month'));break;
	case "SixMonth":$when = date('Y-m-d', strtotime($today. ' + 6 month'));break;
	case "Year":$when = date('Y-m-d', strtotime($today. ' + 1 year'));break;
	case "All": $when = "9999-12-31";break;
	default:$when="9999-12-31";
}



include("getEventsFromDB.php");
$count=0;
$res = sizeof($arrID);

 if ($res > 0){
	 	 for ($i=0;$i<$res;$i++){	 
		 if ($arrDate[$i]<=$when){
				if (getDistance($long, $ulat, $arrLng[$i], $arrLat[$i]) <= $dist){
					$url="location.href='event.html?evID=$arrID[$i]'";
					
					echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.$arrCity[$i].'</i></b></div>
					<div class="content">'.$arrVen[$i].' <b style="float:right;">'. getDistance($long, $ulat, $arrLng[$i], $arrLat[$i]) .' km </b><br/>'.date_format(date_create($arrDate[$i]), 'd/m/Y').'
						</div>
					</ons-card>';
	
					
				/*	echo "<div> 
						$arrCity[$i] <br/> 
					".date_format(date_create($arrDate[$i]), 'd/m/Y')." - ".date_format(date_create($arrTime[$i]), 'H:i')." <br/>
					$arrVen[$i] <br/>" .
					getDistance($long, $ulat, $arrLng[$i], $arrLat[$i]) . "km <br/> <a href='event.html?evID=$arrID[$i]'>More Info</a><hr>
						</div>";*/
					
					$count++;
				}//distance
			}//date		
	 }//for
	 
	 
	if ($count==0)
		echo ($lang=="GA"? "<h3>Ní raibh aon toradh</h3>":"<h3>No Results Found</h3>");
	 
	 
	 //print
 }
 else
	echo ($lang=="GA"? "<h3>Ní raibh aon toradh</h3>":"<h3>No Results Found</h3>");
 



?>