<?php
//check admin
//if admin! etc etc
 if ((isset($_POST['fname'])))
	$fname = $_POST['fname'];
	else
		$fname="";


 if ((isset($_POST['sname'])))
	$sname = $_POST['sname'];
	else
		$sname="";



 if ((isset($_POST['email'])))
	$email = $_POST['email'];
	else
		$email="";



 if ((isset($_POST['utype'])))
	$utype = $_POST['utype'];
	else
		$utype="";
	
	
 if ((isset($_POST['hash'])))
	$hash = $_POST['hash'];
	else
		$hash="";
	
	
 if ((isset($_POST['lang'])))
	$lang = $_POST['lang'];
	else
		$lang="";







function checkText($input){

if ($input=="")
	return "";
else{
$accLet= array('á','é','í','ó','ú', 'Á', 'É', 'Í', 'Ó', 'Ú', " ", "-", "!", "?", ".", "-", "1","2","3","4","5","6","7","8","9","0"); //fix this up!!!

	if (ctype_alpha(str_replace($accLet,'',$input)))
		return $input;
	else
		return "";
}


}


function validEmail($em){
	if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $em)) {
						return $em;
						} else {
						return "";
						}
}


$fname = checkText($fname);
$sname = checkText($sname);
$email = checkText($email);



require_once("getUserDets.php");



if  (getUserID($hash)==1){

$qry  = "SELECT userID, forname, surname, email, userTypeID from userdets where forname like".($fname==""?" '%'":" '%$fname%'"). " and surname like"  .($sname==""?" '%'":" '%$sname%'"). " and email like ".($email==""?" '%'":" '%$email%'"). " and userTypeID like " .(($utype==1)||($utype==2)?" '$utype'":" '%'");


require_once("dbconnect.php");
	$db=db_connect();
	

		$stmt = $db->prepare($qry);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $uFname, $uSname, $uEmail, $userType);
		
		$resCount = $stmt->num_rows; 
		$arrID=array();
		$arrFname=array();
		$arrSname=array();
		$arrEmail=array();
		$arrUtype=array();
		
			while($stmt->fetch()){
				array_push($arrID, $id);
				array_push($arrFname, $uFname);
				array_push($arrSname, $uSname);
				array_push($arrEmail, $uEmail);
				array_push($arrUtype, $userType);	
			
			}
			
			$count=0;
	$res = sizeof($arrID);

	 if ($res > 0){
			 for ($i=0;$i<$res;$i++){	
		require_once("utfFadaConvert.php");	
			$f = utfFadaConvert($arrFname[$i]);
			$s =  utfFadaConvert($arrSname[$i]);
			
			if ($lang=='GA')
				(($arrUtype[$i])==1?$u='Riarthóir':$u='Caighdeán');
			else
				(($arrUtype[$i])==1?$u='Admin':$u='Standard User');
			
			
			
			$url="location.href='adminEditUser.html?id=$arrID[$i]&fname=$f&sname=$s&email=$arrEmail[$i]&utype=$arrUtype[$i]'";
			 echo '<ons-card style="border-style: solid;" onclick="'.$url.'");>
					<div class="title"><b><i>'.$arrFname[$i]. ' '. $arrSname[$i] .'</i></b></div>
					<div class="content">'.$arrEmail[$i].'<br/> ' .$u .'
						</div>
					</ons-card>';
			
			
			
				/*	echo "<div> 
						
							
							$arrFname[$i] - $arrSname[$i] - $arrEmail[$i] - $arrUtype[$i] <br/>
							
						
							
							<a href='adminEditUser.html?id=$arrID[$i]&fname=$f&sname=$s&email=$arrEmail[$i]&utype=$arrUtype[$i]'>Edit</a><hr>
							</div>";*/
					//	$count++;
				
				 }//for
		 }
			else
				echo "ní raibh aon toradh / No Results Found!";
}
else
	echo "<h3>Earráid / Error</h3>";


?>