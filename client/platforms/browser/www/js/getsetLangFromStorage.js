var lang;

function getLangFromStorage(){
//retrieves language prefrence from local storage: if null kick off function to select
localforage.getItem('langLF', function(err, value) {
      console.log("retrieve language prefrence:" + value); //console
	  	 
		  if (value==null)
			window.location.href = 'selectLang.html';	
			else{
			lang = value;
			document.write(lang);
			}
		});//getItem
}//getNameFromStorage()

function selectLang(){
	    
		if (document.getElementById("ga").checked==true)
			lang = "GA"
	   else	if (document.getElementById("en").checked==true)
			lang = "EN";
		


		setLang(lang);
}


function setLang(lan){
	
		localforage.setItem('langLF', lan).then(function(value){
		console.log("language set to :"+value); 
			//window.location.href = 'home.html';	
		}); //set lfLang
		
	
		
	
}


