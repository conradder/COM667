  <?php 


	include("getClientVal.php");
	
	require_once("getUserDets.php");

	
	  $welcome = "";
			if ($lang=="GA")
				$welcome = $welcome . " Fáilte";
			else
				$welcome = $welcome . " Welcome";
	
	
	if (($hash =="")||getFirstName($hash)==" ")
		$welcome = $welcome . ($lang=="GA" ? ", a chara!":", friend!");
	else
		$welcome = $welcome . ", ". getFirstName($hash) ."!";
	
	echo "<h1>$welcome</h1>";
	
	if ($lang=="GA")
		echo "<h2>Pop Up Gaelteacht atá le teacht</h2>";
	else
		echo "<h2>Upcoming Pop Up Gaelteacht</h2>";
	
	require_once("getUpcomming.php");
	getUpcoming($long, $lat);

  
 
  
  ?>
  
  