

function loadDoc(clientPage) {
var lang, lon, lat, log;


    localforage.getItem('langLF').then(function(value) { 
	console.log("retrieve from lang from storage:"+value);
	lang=value;
			localforage.getItem('longLF').then(function(value) { 
			console.log("retrieve from long from storage:"+value);
			
			if (value==null)
				lon = -5.929161; //default to UU Belfast if an error
			else
				lon = value;
				
				localforage.getItem('latLF').then(function(value) { 
				console.log("retrieve lat from storage:"+value); 
				//lat= value;			
				
				if (value==null)
				lat = 54.603978;
			else
				lat = value;
				
					localforage.getItem('lfHash').then(function(value) { 
				console.log("retrieve loginHash from storage:"+value); 
					log= value;	
					//get a login hash!!!!	
					
					if (value==null)
				log = "";
			else
				log = value;
			
			
						getfromcontroller(lang, lon, lat, log);
				});
			});
		});
	});	

	function getfromcontroller(la,lg,lt){
			 
				var xhttp = new XMLHttpRequest();
				var controller = getController();
				xhttp.onreadystatechange = function() {

				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("demo").innerHTML = this.responseText;   }

					};

  
				xhttp.open("GET", controller+clientPage+".php?lang="+la+"&lon="+lg+"&lat="+lt+'&login='+log, true);	
				console.log("get info from: " + controller+"home.php?lang="+la+"&lon="+lg+"&lat="+lt+'&login='+log );
				xhttp.send();
		}

}
