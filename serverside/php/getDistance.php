<?php
//using haversine formula https://thisinterestsme.com/php-haversine-formula-function/
//or http://www.codecodex.com/wiki/Calculate_distance_between_two_points_on_a_globe#PHP


function getDistance($uLong, $uLat, $vLong, $vLat){
  $earth = 6371; 
    
    $dLat = deg2rad($vLat - $uLat);  
    $dLon = deg2rad($vLong - $uLong);  
      
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($uLat)) * cos(deg2rad($vLat)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth * $c;  
		if ($d < 10)
			return round($d, 2);
		else
			return round($d, 0);
		
}



?>