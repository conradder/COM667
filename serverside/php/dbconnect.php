<?php
//db connect for COM667
function db_connect(){
   	$host = 'localhost';
$username = 'B00699799';
$password = 'RdM3X9aa';
$database = 'b00699799x';

   $result = new mysqli($host, $username, $password, $database);
   
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

?>