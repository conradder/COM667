<?php
include("getClientVal.php");
require_once("getUserDets.php");
require_once("dbconnect.php");
$db=db_connect();


  if ((isset($_GET['evID'])))
	$evID = $_GET['evID'];
	else
		$evID="";
	


	if ((isset($_GET['fqid'])))
	$fqid = $_GET['fqid'];
	else
		$fqid="";
	

	
	if ((isset($_GET['name'])))
	$vName = $_GET['name'];
	else
		$vName="";

	if ((isset($_GET['vlng'])))
	$vlng = $_GET['vlng'];
	else
		$vlng="";
	
		if ((isset($_GET['vlat'])))
	$vlat = $_GET['vlat'];
	else
		$vlat="";
	
		if ((isset($_GET['address'])))
	$vAddress= $_GET['address'];
	else
		$vAddress="";

	if ((isset($_GET['city'])))
	$vCity = $_GET['city'];
	else
		$vCity="";
	

	
	
	function getCreatedBy($evID){
	
		$db=db_connect();
		$qry = "select createdBy from eventdets where eventID = $evID";
	
	
	  if(isset($db->query($qry)->fetch_object()->createdBy))
		  $id	= $db->query($qry)->fetch_object()->createdBy;
	  else
		  $id= " "; //default to standard user!
			
	return $id;

}

	function getEvDate($evID){
	
		$db=db_connect();
		$qry = "select evDate from eventdets where eventID = $evID";
	
	
	  if(isset($db->query($qry)->fetch_object()->evDate))
		  $date	= $db->query($qry)->fetch_object()->evDate;
	  else
		  $date= ""; 
			
	return $date;

}

function dupEvent($inID, $inDate){
	require_once("dbconnect.php");
	$db = db_connect();
	$checkDup = "SELECT * FROM `eventdets` WHERE evDate = '$inDate' and evLoc= '$inID'";
	
	 if ($dupcount = mysqli_query($db, $checkDup))
			{
				
				if(mysqli_num_rows($dupcount) > 0){
					$dup = true;
				}
				else
					$dup = false;
			}
				
				if ($dup==false)
				return true; // not a duplicate (true means good... !)
				else 
					return false; // yes duplicate!
	
}

function checkText($input){

if ($input=="")
	return true;
else{
$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " ", "-", "!", "?", ".", "-", "1","2","3","4","5","6","7","8","9","0"); //fix this up!!!

	if (ctype_alpha(str_replace($accLet,'',$input)))
		return true;
	else
		return false;
}


}






$qry = "SELECT * FROM `fsq_venuedets` WHERE fsq_id = '$fqid'";
$result = $db->query($qry);
 if ($result->num_rows){
	$venueOK=true;
 }
 else
 {
	 
	 	 if (($fqid!="")&&($vName!="")&&($vlat!="")&&($vlng!="")&&($vCity!="")&&(checkText($fqid)==true)&&(checkText($vName)==true)&&(checkText($vCity)==true)&&(is_numeric($vlat)==true)&&(is_numeric($vlng)==true)&&(checkText($vAddress)==true)){
		 //all good! 
		 $vQry = "INSERT INTO fsq_venuedets (fsq_id, venueName, venueAdd, venueCity, venueLat, venueLng) VALUES ('$fqid','$vName','$vAddress','$vCity','$vlat','$vlng')";
		 
		 if (mysqli_query($db, $vQry)) {
						$venueOK=true;

                 } else {
					echo "Error: " . $vQry . "<br>" . mysqli_error($db);
					$venueOK = false;
				 }//else query fail
	 //write to database
	 
	}//checks
	else{
		echo "<div id='errMsg'><h3> The Venue had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo ($fqid==""?"<li>No Venue ID</li>":"");
			echo ($vName==""?"<li>No Venue Name</li>":"");
			echo ($vlat==""?"<li>No Latitude</li>":"");
			echo ($vlng==""?"<li>No Longitude</li>":"");
			echo ($vCity==""?"<li>No City</li>":"");
			echo (checkText($fqid)==false?"<li>Invalid ID</li>":"");
			echo (checkText($vCity)==false?"<li>Invalid Text in City</li>":"");
			echo (checkText($vAddress)==false?"<li>Invalid Text in Address</li>":"");
			echo (is_numeric($vlat)==false?"<li>Invalid Latitude </li>":"");
			echo (is_numeric($vlng)==false?"<li>Invalid longitude </li>":"");
			echo "</ul></div>";
		$venueOK = false;
		
		echo "return to home";
	 
 }
}





if (($hash=="")||(getUserID($hash)==" "))
{
	/*echo "<script>
	window.location.href=home.html;
	</script>";*/
}
else{
			
			if (($venueOK==true)&&(dupEvent($fqid, getEvDate($evID))==true)&&(getEvDate($evID)!="")&&((getCreatedBy($evID)==getUserID($hash))||(getUserType($hash)==1))){
				require_once("dbconnect.php");
				$db = db_connect();
				$qry = "UPDATE eventdets SET evLoc='$fqid' WHERE eventID=$evID";
				if (mysqli_query($db, $qry)) {
              
			echo ' <h3> Venue Change Sucessful </h3>';
					
					
					
						
						
                 } else {
					echo "Error: " . $qry . "<br>" . mysqli_error($db);
					
					}		
				
			}
			else{

			if (dupEvent($fqid, getEvDate($evID))==false)
				$alert = "Duplicate Event at venue";
			else
				$alert = "Problem changing venue";
					
				echo "<h3>$alert</h3>";
				
			}


}







?>