
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
            url: getController() + "authLogin.php",
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
	

