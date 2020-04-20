<?php

function getURL(){
$domain = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
//echo $domain;
$filepath = strtok($_SERVER['REQUEST_URI'], '?');
//$filepath = strtok($filepath, '#');
//echo $filepath;
$dir = $domain . $filepath;
$path = dirname($dir)."/";
//echo "<br/><br.>".$path;

return $path;

}

?>