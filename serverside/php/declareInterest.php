<?php
 if ((isset($_GET['uID'])))
	$uID = $_GET['uID'];
	else
		$uID="";

 if ((isset($_GET['eID'])))
	$eID = $_GET['eID'];
	else
		$eID="";

require_once("dbconnect.php");
$db =  db_connect();

if ($eID==""||$uID==""){
	 echo "<meta http-equiv='Refresh' content='0; url=home.html' />";
					
}
else
{
	
	$query = "INSERT INTO userreminder(userID, eventID) VALUES ($uID,$eID)";
		
			if (mysqli_query($db, $query)) {
             echo "<meta http-equiv='Refresh' content='0; url=event.html?evID=$eID' />";
			/*   echo " <script>
			   
							window.location.href='event.html?evID=$eID';	
							

						</script>";*/
					
					
						
						
                 } else 
					{
					echo "Error: " . $query . "<br>" . mysqli_error($db);
					   echo "<meta http-equiv='Refresh' content='0; url=event.html?evID=$eID' />";
					}
	
	
	
	
}

?>