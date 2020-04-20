<?php 
include("getClientVal.php");


if ($hash!=""){
require_once("dbconnect.php");
$db=db_connect();
$qry = "SELECT * FROM `userdets` WHERE loginHash='$hash'";
$result = $db->query($qry);
 if ($result->num_rows){

	echo ' <meta http-equiv="refresh" content="0;url=searchVenue.html">';
 
 
 }
 else
		echo ' <meta http-equiv="refresh" content="0;url=login.html">';
}
else
		echo ' <meta http-equiv="refresh" content="0;url=login.html">';



?>