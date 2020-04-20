<?php


echo "
			      <script type='text/javascript' src='js/localforage.js'></script>
			         <script>
						localforage.setItem('lfHash','').then(function(value){
							console.log('hash set to ''); //store hash locally, allowing to login!
							alert('Log Out Scuessful!');
						window.location.href='home.html';	
							
						});//set hash to lf
						</script>";

?>