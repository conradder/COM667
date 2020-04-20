
<?php
function utfFadaConvert($input){

$input = str_replace('á', '	%C3%A1', $input);
$input = str_replace('é', '	%C3%A9', $input);
$input = str_replace('í', '	%C3%AD', $input);
$input = str_replace('ó', '	%C3%B3', $input);
$input = str_replace('ú', '	%C3%BA', $input);
$input = str_replace('Á', '	%C3%81', $input);
$input = str_replace('É', '	%C3%89', $input);
$input = str_replace('Í', '	%C3%8D', $input);
$input = str_replace('Ó', '	%C3%93', $input);
$input = str_replace('Ú', '	%C3%9A', $input);

return $input;

}
?>