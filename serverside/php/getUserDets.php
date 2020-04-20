<?php

require_once("dbconnect.php");
//function to determine if the user is a standard, admin or 'facilities' 
//different access rights etc etc etc
function getUserType($hash){
	$db=db_connect();
	$qry = "select userTypeID from userdets where loginHash = '$hash'";
	
	
	  if(isset($db->query($qry)->fetch_object()->userTypeID))
		  $usertype	= $db->query($qry)->fetch_object()->userTypeID;
	  else
		  $usertype=2; //default to standard user!
			
			
	return $usertype;

}

function getFirstName($hash){
	$db=db_connect();
	$qry = "select forname from userdets where loginHash = '$hash'";
	
	
	  if(isset($db->query($qry)->fetch_object()->forname))
		  $name	= $db->query($qry)->fetch_object()->forname;
	  else
		  $name= " "; //default to standard user!
			
			
	return $name;

}

function getUserID($hash){
	
		$db=db_connect();
	$qry = "select userID from userdets where loginHash = '$hash'";
	
	
	  if(isset($db->query($qry)->fetch_object()->userID))
		  $id	= $db->query($qry)->fetch_object()->userID;
	  else
		  $id= " "; //default to standard user!
			
			
	return $id;

}

function getUserEm($hash){
	
		$db=db_connect();
	$qry = "select email from userdets where loginHash = '$hash'";
	
	
	  if(isset($db->query($qry)->fetch_object()->email))
		  $id	= $db->query($qry)->fetch_object()->email;
	  else
		  $id= " "; //default to standard user!
			
			
	return $id;

}


?>