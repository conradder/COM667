<!DOCTYPE html>
<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
	<img src='../media/logo.gif'/ height="111" width="500">
<?php

require_once("dbconnect.php");

if (isset($_GET['token']))
	$hash = $_GET['token'];
else
	$hash = "";

$dateChk = date('Y-m-d H:i', strtotime('-1 hour'));

function checkHash($input){
		require_once("dbconnect.php");
	$db = db_connect();
	$query = "select resetID from pwreset where resetHash='$input'";
	
	 if ($dupcount = mysqli_query($db, $query))
			{
				
				if(mysqli_num_rows($dupcount) > 0){
					return true;
				}
				else
					return false;
			}
				
			
}

function getdbDate($input){
	$db=db_connect();
		$qry = "select resetdate from pwreset where resetHash='$input'";
	
	
	  if(isset($db->query($qry)->fetch_object()->resetdate))
		  $date= $db->query($qry)->fetch_object()->resetdate;
	  else
		  $date=""; 
			
			
	return $date;

}

function getdbTime($input){
	$db=db_connect();
	$qry = "select resettime from pwreset where resetHash='$input'";
	
	
	  if(isset($db->query($qry)->fetch_object()->resettime))
		  $time= $db->query($qry)->fetch_object()->resettime;
	  else
		  $time=""; 
			
			
	return $time;

}

function getUID($input){
	$db=db_connect();
	$qry = "select userID from pwreset where resetHash='$input'";
	
	
	  if(isset($db->query($qry)->fetch_object()->userID))
		  $userID= $db->query($qry)->fetch_object()->userID;
	  else
		  $userID=""; 
			
			
	return $userID;

}

$uID=getUID($hash);

if ((getdbDate($hash)!="")&&(getdbTime($hash)!=""))
$rdate = getdbDate($hash) . " " .getdbTime($hash);
else
	$rdate = "error";


if (($hash!="")&&(checkHash($hash)!=false)&&($rdate!="error")){
	
	$date = date('Y-m-d H:i', strtotime('-1 hour'));echo "<br/>";
	if ($date <= $rdate){
		echo '<h3>Enter New Password</h5>
			<form id="resetPW">
				<table>
				<div id="em"></div>
					<tr>
			   <td>New Password </td><td><input id="nPW" name="nPW" type="Password" value="" /></td>
			   </tr>
				<tr>
			   <td>Confirm New Password </td><td><input id="cPW" name="cPW" type="Password" value="" /></td>
			   </tr>
				<tr>
				<td>
					<input readonly hidden  id="uID" name="uID" type="text" value="'.$uID.'">
				
				<input type="submit" value="Submit" /></td></tr>
					</table>
			</form>';		
	}
	else{ 
		echo "<h2>Link has expired</h2>";
		}
	
	
}
else
{
	echo "<h2>Link has expired</h2>";
	
}



//echo date("Y-m-d H:i:s", strtotime('+4 hours', strtotime($date)));





//reset
//check pw match
//send an email!


?>


<div id="result"></div>



<script>
//https://stackoverflow.com/a/14217926
	
	
	/* Attach a submit handler to the form */
$("#resetPW").submit(function(event) {
    var ajaxRequest;

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div. */
    /* I am not aborting the previous request, because it's an
       asynchronous request, meaning once it's sent it's out
       there. But in case you want to abort it you can do it
       by abort(). jQuery Ajax methods return an XMLHttpRequest
       object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url:  "confirmPWreset.php",
            type: "post",
            data: values
        });

    /*  Request can be aborted by ajaxRequest.abort() */

    ajaxRequest.done(function (response, textStatus, jqXHR){

         // Show successfully for submit message
         $("#result").html('Submitted successfully');
			$("#result").html(response);
    });

    /* On failure of request this function will be called  */
    ajaxRequest.fail(function (){

        // Show error
        $("#result").html('There is error while submit');
    });
	
	

});
	


</script>
</body>
</html>