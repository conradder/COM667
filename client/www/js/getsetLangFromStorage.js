var lang;

function getLangFromStorage(){
//retrieves language prefrence from local storage: if null kick off function to select
localforage.getItem('langLF', function(err, value) {
      console.log("retrieve language prefrence:" + value); //console
	  	 
		  if (value==null)
			window.location.href = 'selectLang.html';	
			else{
			lang = value;
				window.location.href = 'home.html';	
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
		console.log('language set to :'+lan); 
			goHome();
		//	document.write("<meta http-equiv='Refresh' content='0; url=home.html' />");
		}); //set lfLang
		
	//	window.location.href = 'home.html';	
	//	window.location.href = 'home.html';	
		
	
}

function goHome(){
	
	window.location.href = 'home.html';
	
	
}
