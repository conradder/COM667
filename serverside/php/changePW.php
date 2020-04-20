<?php
echo "change PAssword";

if (isset($_POST['uID']))
	$uID= $_POST['uID'];
else
	$uID = "";

if (isset($_POST['oPW']))
	$oPW= $_POST['oPW'];
else
	$oPW = "";


if (isset($_POST['nPW']))
	$nPW= $_POST['nPW'];
else
	$nPW = "";


if (isset($_POST['cPW']))
	$cPW= $_POST['cPW'];
else
	$cPW = "";

function checkPW($uID, $oPW){
	
	require_once("dbconnect.php");
	$db=db_connect();
	$query = "SELECT * FROM userdets WHERE userID=$uID and pw=sha1('$oPW')";
	$result = $db->query($query);
	 
	 if ($result->num_rows)
		 return true;
	 else
		 return false;
	
}

if ($nPW==$cPW)
		$pwMatch = true;
	else
		$pwMatch = false;


function getEmail($id){
	$db=db_connect();
	$qry = "select email from userdets where userID = $id";
	
	
	  if(isset($db->query($qry)->fetch_object()->email))
		  $email	= $db->query($qry)->fetch_object()->email;
	  else
		  $email=""; 
			
			
	return $email;

}


function getName($id){
	$db=db_connect();
	$qry = "select forname from userdets where userID = $id";
	
	
	  if(isset($db->query($qry)->fetch_object()->forname))
		  $fname= $db->query($qry)->fetch_object()->forname;
	  else
		  $fname=""; 
			
			
	return $fname;

}



if (($uID=="")||($oPW=="")||($nPW=="")||($cPW=="")){
	echo ($uID==""?"Problem Retrieving User ID!":"Fields Cannot be Blank");
}
else{
	
		if ((checkPW($uID, $oPW)==true)&&($pwMatch==true)&&(getEmail($uID)!="")){
				$hash = getEmail($uID) . $nPW;
				require_once("dbconnect.php");
				$db = db_connect();
				$qry = "UPDATE userdets SET pw=sha1('$nPW'), loginHash=sha1('$hash') WHERE userID = $uID";
				 
				 require_once("../sendpulse/mailtest.php");
						pwchange(getEmail($uID),getName($uID));
						
				if (mysqli_query($db, $qry)) {
					echo "
					<script type='text/javascript' src='js/localforage.js'></script>
			         <script>
						localforage.setItem('lfHash','". sha1($hash)."').then(function(value){
							console.log('hash set to ' + '".sha1($hash)."'); //store hash locally, allowing to login!
							alert('Password Changed!');
							window.location.href='profile.html';	
							
						});//set hash to lf
						</script>";
					
					//now send an email confirmation!
						
						
					}//if qry success
					else
					{
				 	echo "Error: " . $qry. "<br>" . mysqli_error($db);
					}
					
		}
		else{
			echo "<div id='errMsg'><h3> The data had the following problems: </h3>";
			echo"<ul class='errorlist'>";
			echo (checkPW($uID, $oPW)==false?"<li>Old Password Incorrect</li>":"");
			echo ($pwMatch==false?"<li>New Passwords dont match</li>":"");
			echo "</ul></div>";	
			}
	}

?>