<?php
//bi lingual stuff...


 require_once("getURL.php");
/* echo '<style type="text/css">td{text-align:center;}</style>';
 echo "<h1 align='center'> Login: </h1>";
 echo '<form action="'.getURL().'authLogin.php" method="post" >';
 echo '<table align="center">';
 echo '<tr><th>E-Mail Address:</th><td><input type="text" name="userid" id="userid" size="30"/></td></tr>';
 echo '<tr><th>Password:</th><td><input type="password" name="password" id="password" size="30"/></td></tr>';
 echo '<tr><td colspan="2"><button type="submit" name="login" class="btn btn-primary">Login</button></td></tr>';
 echo '</table>';
 echo '</form>';
 echo '<p align="center"> Need an Account? <a href="createAcc.php">Click Here!</a></p>';
*/

?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<form id="foo">
    <label for="bar">A bar</label>
    <input id="bar" name="bar" type="text" value="" />
    <input type="submit" value="Send" />
</form>

<!-- The result of the search will be rendered inside this div -->
<div id="result"></div>
<script>
//https://stackoverflow.com/a/14217926
	
	
	/* Attach a submit handler to the form */
$("#foo").submit(function(event) {
    var ajaxRequest;

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div. */
    /* I am not aborting the previous request, because it's an
       asynchronous request, meaning once it's sent it's out
       there. But in case you want to abort it you can do it
       by abort(). jQuery Ajax methods return an XMLHttpRequest
       object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "<?php echo getURL();?>authLogin.php",
            type: "post",
            data: values
        });

    /*  Request can be aborted by ajaxRequest.abort() */

    ajaxRequest.done(function (response, textStatus, jqXHR){

         // Show successfully for submit message
         $("#result").html('Submitted successfully');
			$("#result").html(response);
    });

    /* On failure of request this function will be called  */
    ajaxRequest.fail(function (){

        // Show error
        $("#result").html('There is error while submit');
    });
	
	
 ajaxRequest.done(function (response){
    alert(response);
 });

});
	


</script>



</body>
</html>