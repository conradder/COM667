


<?php
session_start();
//COM667

 $email = $_POST['email'];
 $password = $_POST['password'];
 
 if (($email=="")||($password=="")){
	echo "<h2>Fields Cannot be Blank</h2>";
	

}
else
{
	require_once("dbconnect.php");
	$db=db_connect();
	$query = "SELECT * FROM userdets WHERE email='$email' and pw=sha1('$password')";
	$result = $db->query($query);
	
	//check if login okay, create hash
	//echo $query;

	 if ($result->num_rows) {
		
		 $hash = $email . $password;
		 
		  //$_SESSION['sessionID'] = sha1($hash);
		 //echo "success";
		 $qry = "UPDATE userdets SET loginHash = sha1('$hash') where email = '$email'";
		 
	
			if (mysqli_query($db, $qry)) {
				echo "
			      <script type='text/javascript' src='js/localforage.js'></script>
			         <script>
						localforage.setItem('lfHash','". sha1($hash)."').then(function(value){
							console.log('hash set to ' + '".sha1($hash)."'); //store hash locally, allowing to login!
							alert('Login Scuessful!');
						window.location.href='home.html';	
							
						});//set hash to lf
						</script>";
					}		
		 //create hash
		 //create session!
		 
	 }
	else
	{
		echo "Incorrect Password or Email address";
		
	}
	
	  
}

?>
 
 

