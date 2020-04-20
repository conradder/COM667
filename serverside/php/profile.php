<?php

include("getClientVal.php");
include("getUserDets.php");



if ($hash=="" || getUserID($hash)== " "||$hash==null)
{

		echo ' <meta http-equiv="refresh" content="0;url=login.html">';	
}
else
{
		
		$uID = getUserID($hash);
		require_once("dbconnect.php");
		$db = db_connect();
		$qry="SELECT userdets.forname, userdets.surname, userdets.email, usertype.userTypeDets from userdets inner JOIN usertype on usertype.userTypeID = userdets.userTypeID where userdets.userID=$uID";
		$stmt = $db->prepare($qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($fname, $sname, $email, $utype);
		$resCount = $stmt->num_rows;
		
		if ($lang=='GA')
			($utype=="Admin User"?($uType="Riarthóir"):($uType="Caighdeán"));
		
	
		if ($resCount > 0 ){
		while($stmt->fetch()){
			
				
				if ($lang=='GA'){
				
				if ($utype=="Admin User")
				   $u="Riarthóir";
				else
					$u="Caighdeán";
				
				}
				else
					$u=$utype;
		
				echo '<ons-card style="border-style: solid;");>
					<div class="title"><b><i>'.($lang=='GA'?'Do shonraí':'Your Details').'</i></b></div>
					<div class="content">'.($lang=='GA'?'Ainm: ':'Name: ').$fname . " " . $sname .'<br/> '
						 .($lang=='GA'?'R-phost: ':'Email: '). $email . '<br/> '
						 . ($lang=='GA'?'Cineál úsáideoir: ':'Account Type: ') . $u .'
						</div>
					</ons-card>';
				
			
		}
			
		
		include("utfFadaConvert.php");
		$fname = utfFadaConvert($fname);
		$sname = utfFadaConvert($sname);
			$url = "location.href='editAcc.html?uID=$uID&fname=$fname&sname=$sname&email=$email'";
	
		//echo $urlEdAc;
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Edit account details
						</div>
					</ons-card>';
		$url = "location.href='changePW.html?uID=$uID&email=$email'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Change Password
						</div>
					</ons-card>';
		$url = "location.href='selectLang.html'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Language Settings
						</div>
					</ons-card>';
		$url = "location.href='myEvents.html?uID=$uID'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">My Events
						</div>
					</ons-card>';
		
		$url = "location.href='myInterested.html?uID=$uID'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Interested Events
						</div>
					</ons-card>';


	
 
	if (getUserType($hash)==1){
		echo "<h5 align='center'>Admin Dashboard</h5>";
		
			$url = "location.href='adminSearchEvent.html'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Search or Edit Event
						</div>
					</ons-card>';
			$url = "location.href='adminSearchUser.html'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="content">Find or Edit User
						</div>
					</ons-card>';
		

		
	}
		$url = "location.href='logout.html'";
		 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.($lang=='GA'?'Logáil amach':'Logout').'
						</b></i></div>
					</ons-card>';
		
}//resount		
	
	
} //hash==""







?>