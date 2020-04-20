var curLong, curLat;

     var onSuccess = function(position) {
		//get latest position.
			  curLong = position.coords.longitude;
			  curLat = position.coords.latitude;
		//store latest position.
		
		localforage.setItem('longLF', curLong).then(function(value){
		console.log("current longitude set to :"+value); 
		}); //store long
		
		localforage.setItem('latLF', curLat).then(function(value){
		console.log("current latitude  set to :"+value); 

		}); //store lat
			  
			
			  
             
    };

    // onError Callback receives a PositionError object
    //
    function onError(error) {
        alert('code: '    + error.code    + '\n' +
              'message: ' + error.message + '\n');
			  //on error get from storage, else default to UU belfast 

		
		localforage.getItem('longLF', function(err, value) {
		console.log("retrieve longitude from storage:" + value); //console
	  	 
		  if (value==null){
			  localforage.setItem('longLF', 54.603978).then(function(value){
				console.log("current longitude set to :"+value); 
				}); //set long to UU Belfast 
			}//if

						localforage.getItem('latLF', function(err, value) {
							console.log("retrieve longitude from storage:" + value); //console
						
						 if (value==null){
						  localforage.setItem('longLF', -5.929161).then(function(value){
							console.log("current longitude set to :"+value); 
							}); //set long to UU Belfast 
							}//if
			
			
						});//get lat
		});//getLongLF
}// on error
		
		
			  
			  
    
	
	var watchID =  navigator.geolocation.watchPosition(onSuccess, onError, {timeout:10000});
	
	