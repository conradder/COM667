<html>
	<head>
<style>div.vid {
	text-align:center;
  width: 900px;
  margin: auto;
  border: 1px solid ;
}</style>	</head>
	<body>
	<?php

	$search=$_POST['search'];
	$lang = $_POST['lang'];
	$long = $_POST['lon'];
	$lat = $_POST['lat'];

	if ($lang=="")
		$lang="EN";
	
	if (($long=="")||($lat=="")){
		$long = -5.929161; 
		$lat = 54.603978; 
	}
		
		if (isset($_POST['evID']))
			$eID = $_POST['evID'];
		else
			$eID="";
		
		




	
	$number=10;
	
	if ($number <=0)
		echo "<h3>". ($lang=='GA'?'Earráid':'Error') ."</h3>";
	
	if ($search=="")
			echo "<h3>". ($lang=='GA'?'Earráid':'Error') ."</h3>";
		
	if ($number >0 && $search!=""){
		
	//	require_once("utfFadaConvert.php");
		//$search = utfFadaConvert($search);
		
		$search = str_replace( " ", "+", $search);
		$search = str_replace( "á", "a", $search);		
		$search = str_replace( "é", "e", $search);		
		$search = str_replace( "í", "i", $search);		
		$search = str_replace( "ó", "o", $search);		
		$search = str_replace( "ú", "u", $search);		
		$search = str_replace( "Á", "A", $search);		
		$search = str_replace( "É", "E", $search);		
		$search = str_replace( "Í", "I", $search);		
		$search = str_replace( "Ó", "O", $search);
		$search = str_replace( "Ú", "U", $search);



		$clientID = 'YEVUYCTZCQIIXSRRA03TTWUMYNW1APGXDCRZNFF400UIM3CX';
		$clientSec = '133ZBUN14AURXANAHMMSK3RFCMJIMYCAYYFJOQL4PA3E52SG';
		$v = 20200101;
		
	//$fsqApiUrl = 'https://api.foursquare.com/v2/venues/search?client_id='.$clientID.'&client_secret='.$clientSec.'&v='.$v.'&near=belfast%20&query='.$search."&limit=".$number;	
 $fsqApiUrl = 'https://api.foursquare.com/v2/venues/search?client_id='.$clientID.'&client_secret='.$clientSec.'&v='.$v.'&ll='.$lat.','.$long.'&query='.$search."&limit=".$number.'&radius=100000';
//echo "<a href='$fsqApiUrl'> link</a>";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $fsqApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $value = json_decode(json_encode($data), true);

	echo '<br/>';

?>


<?php

//limit to 10 then get array size

$loop = sizeof($value['response']['venues']);
	$count=0;


/*echo '<script type="text/javascript"> function nextPge(x){
						
			window.location.href="createEvent.html?ven="+x;	
			
		}</script>';*/
	echo "<h3>". ($lang=='GA'?'Torthaí':'Results') ."</h3>";	
	echo '<form name="selectVenue">';
    for ($i = 0; $i < $loop; $i++) {
	
		$fqid =$value['response']['venues'][$i]['id'];
		$name = $value['response']['venues'][$i]['name'];
		$lng = $value['response']['venues'][$i]['location']['lng'];
		$lat = $value['response']['venues'][$i]['location']['lat'];
		
		if (isset($value['response']['venues'][$i]['location']['city']))
			$city = $value['response']['venues'][$i]['location']['city'];
		else
			$city="";
      
		if (isset($value['response']['venues'][$i]['location']['address']))
			$address= $value['response']['venues'][$i]['location']['address'];
		else
			$address = "";
			//on click on radio button?????
			
			
		
	/*	for ($f=0;$f<sizeof($value['response']['venues'][$i]['location']['formattedAddress']);$f++){
			echo $value['response']['venues'][$i]['location']['formattedAddress'][$f]." -";
		}*/
		
	
		
		
		if ($eID=="")
			$url= "location.href='createEvent.html?id=".$fqid."&name=".fixURLname($name)."&lng=".$lng."&lat=".$lat."&add=".$address."&city=".$city."'";
		else
			$url= "location.href='changeVenueConfirm.html?id=".$fqid."&name=".fixURLname($name)."&lng=".$lng."&lat=".$lat."&add=".$address."&city=".$city."&evID=".$eID."'";
		
		if ($city!=""){ // make sure no venues with incomplete data copied over
		echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.$name.'</i></b></div>
					<div class="content">'.($address!=""?$address . "</br>":"") . $city . '</div>
			</ons-card>';
			$count++;
		}
		
		//echo $fqid."<br/><b>".$name."</b><br/>".$lng.",".$lat."<br/>".$address.", ".$city."<br/><br/>";
		
		
	/*	$name=str_replace("'", "", $name);
		$name=str_replace("’", "", $name);
		$name=str_replace("&", "and", $name);
		
		if ($eID=="")
			echo "<a href='createEvent.html?id=".$fqid."&name=".$name."&lng=".$lng."&lat=".$lat."&add=".$address."&city=".$city."'>link</a>";
		else
			echo "<a href='changeVenueConfirm.html?id=".$fqid."&name=".$name."&lng=".$lng."&lat=".$lat."&add=".$address."&city=".$city."&evID=".$eID."'>Change Venue</a>";*/
       	 
        }
			echo '</form>';
			if (($loop == 0)||$count==0){
				$url = "location.href='fsq.html'";
	echo '<ons-card style="border-style: solid;" onclick="'.$url.'";>
					<div class="title"><b><i>Can&#39;t find that venue?</i></b></div>
					<div class="content">Click here to learn more!</div>
			</ons-card>';
			}
	else
	  echo "<img src='img/fsq.png' width='100%' />";	
		
		
    } 
     


	 
function fixURLname($name){
	
		$name=str_replace("'", "", $name);
		$name=str_replace("’", "", $name);
		$name=str_replace("&", "and", $name);
		return $name;
	
}
	   

?> 
	</body>
</html>