<?php

 if ((isset($_GET['lang'])))
	$lang = $_GET['lang'];
  else 
	  $lang = "EN"; //if exception .. default to bearla!

if ((isset($_GET['lon']))&&(isset($_GET['lat']))){
	$long = $_GET['lon'];
	$lat = $_GET['lat'];
	
	}
  else 
  { 
	$long = -5.929161;
	$lat = 54.603978; //if exception ... default to UU Belfast - it's as good a place as any
  }

  if ((isset($_GET['login'])))
	$hash = $_GET['login'];
	else
		$hash="";




?>
