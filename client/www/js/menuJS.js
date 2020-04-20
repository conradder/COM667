//"public" variables that get called by a few different functons.

var uName;
var arrArousal;
var arrValance;
var arrDateTime;
var arrAdditional
var arrEmotoions;
var param = window.location.search.substr(1).split('&');


function getNameFromStorage(){
//retrieves name from local storage: if null kick off function to enter name
localforage.getItem('lfName', function(err, value) {
      console.log("retrieve name:" + value); //console
	  	 
		  if (value==null)
			enterName();
			else{
			uName = value;
			document.getElementById('welcome').innerHTML = "<h5>Hey there <i>" + uName + "</i>! <br /> Please select an option</h5>";
			}
		});//getItem
}//getNameFromStorage()


function enterName(){
window.location.href = 'entername.html';	
}

function subName(){
	var enteruname = document.getElementById('userName').value;
	var namelength = enteruname.length;
	var invalid=false;
	
	//check for dodgy characters.. prevents HTML tags or script being entered that breaks the app
	for (var i=0; i<namelength; i++){
		if ((enteruname[i]=="<")||(enteruname[i]==">") || (enteruname[i]=="?") || (enteruname[i]=="$") || (enteruname[i]=="+") 
			|| (enteruname[i]=="-")|| (enteruname[i]=="[")|| (enteruname[i]=="]")|| (enteruname[i]=="}")|| (enteruname[i]=="{")
			|| (enteruname[i]=="\\"))
			invalid=true;		
	}	
	
	
	if (invalid==true)
			alert("invalid characters!");
	else if((namelength == 0)||(namelength > 25)) //prevent having a really long name and makes the app look bad
		  alert("Name must be between 1 and 25 characters");
	else
		 setLFName(enteruname);
	//window.location.href = 'menu.html';

} //subname

function setLFName(enteruname){
	//store the user name to storage
	localforage.setItem('lfName', enteruname).then(function(value) {
    console.log("name saved to storage:" + value);
	window.location.href = 'menu.html';
	});	
}

function validateTest(){
	//this is probably the most convoluted way of checking all the radio buttons have been checked.

	var qcheck=[false, false,false,false,false];
	var count=0;
	
	
	for (var q=1;q<=10;q++){
		for(var a=0;a<5;a++){
			if (document.getElementById('q'+q+'_'+a).checked==false)
				qcheck[a]=0;
			else
				qcheck[a]=1;
		}//'a' loop
		if ((qcheck[0]==0)&&(qcheck[1]==0)&&(qcheck[2]==0)&&(qcheck[3]==0)&&(qcheck[4]==0))
			checkAnser(q);
		else 
			count++;	  
	}//q loop

	if (count==10)
	calcResults();
}

function checkAnser(question){
	//if a question is missed it will give a message and jump to that question
	document.getElementById('checkAns'+question).innerHTML = "<h6>Ensure question " + question + " is answered</h6>";
	window.location.href ='#no'+question;
}


function calcResults(){
	var xArousal=0; //= q1 + q3+ q5+q7+q9;
	var yValance=0;// = q2 + q4+ q6+q8+q10;

	//gets the results and assigns to valance and arousal - note: i may have mixed them up.... but the logic is sound...
	for (var q=1;q<=10;q++){
		for(var a=0;a<5;a++){
			if (document.getElementById('q'+q+'_'+a).checked==true)	{
				if ((q%2)==0)	
					yValance = yValance + a;
				else
					xArousal = xArousal +a;
			}//if checked		
		}//'a' loop
	}//q loop
	
	
	var dateTime = new Date().toLocaleString('en-GB'); //get date time
	
	window.location.href = 'results.html?xArousal='+xArousal+'&yValance='+yValance+'&dateTime='+dateTime;
	
}//subtest

function getResultHistoryFromStorage(){


    localforage.getItem('lfArousal').then(function(value) { 
	console.log("retrieve from arousal from storage:"+value);
	arrArousal=value;
			localforage.getItem('lfValance').then(function(value) { 
			console.log("retrieve from Valance from storage:"+value);
			arrValance = value;
				localforage.getItem('lfDateTime').then(function(value) { 
				console.log("retrieve date and time from storage:"+value); 
				arrDateTime = value;
					localforage.getItem('additional').then(function(value) { 
					console.log("retrieve additional info from storage:"+value); 
					arrAdditional = value;
						localforage.getItem('emotions').then(function(value) { 
						console.log("retrieve emotions from storage:"+value); 
						arrEmotoions = value;
			
							displayResults(arrArousal, arrDateTime, arrValance, arrAdditional, arrEmotoions);
						});//getEmotions
					});//getadditional
			});//dateTime
		});//valance
	});	//
}//getResultsFromStorage()


function displayResults(arrArousal, arrDateTime,  arrValance, arrAdditional, arrEmotoions){
	
	var dispHistory='<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"><link rel="stylesheet" href="css/bootstrap.css"><link rel="stylesheet" href="css/gm.css"><title>Giúmar Maith</title></head><body"><script type="text/javascript" src="js/menuJS.js"></script> <script type="text/javascript" src="js/localforage.js"></script> <div class="jumbotron"><h1>Giúmar Maith</h1><h2>/gu-mer-moy/</h2></div><style type="text/css">img{max-height: 100%; max-width: 100%;}.parent {position: relative;top: 0;left: 0;}.chart {position: relative;top: 0;left: 0;}';
				//check if you have a result history.. if not take a test
			if (arrArousal == null){
				alert("No results history.. take the questionnaire");
				window.location.href = 'questionare.html';
			}//if
			else{
				for(var i=0; i<arrArousal.length; i++){
					
					var pVal = ((arrValance[i]/20)*90); //for dot location
					var pAr = ((arrArousal[i]/20)*90); //for dot location
					
				dispHistory=dispHistory +'.reddot'+i+'{position: absolute;top:'+pAr+'%;left:'+pVal+'%;padding:10px;}';
					
				//document.write(arrDateTime[i] + " - " + arrArousal[i] + "  - " + arrValance[i] + "<br/>");
			}	//for
			dispHistory = dispHistory + '</style><h6> Your Results History:</h6><div class="parent"><div class="chart"><img src="images/russell_chart_blank.jpg"></div>'
			
			//a bit of error handling, i thought i covered it somewhere else but this happens if you crash the test after submission but before adding extra emotions etc, then you select history... so this was a specific fix for one specific event!
			if (arrAdditional==null)
				arrAdditional = "Nothing Entered";
			if (arrEmotoions==null)
				arrEmotoions="Nothing Selected;"
			
			
			for(var i=0;i<arrArousal.length;i++){
				dispHistory = dispHistory + '<div class="reddot'+i+'"><img src="images/RedDot.png"></div>';
			}//for
				dispHistory = dispHistory + '</div><br/><h6>Further Information: </h6><table><tr><th>Time of Test</th><th>Arousal %</th><th>Valance %</th></tr>'
				
				for (var i=0;i<arrArousal.length;i++){
					dispHistory = dispHistory + '<tr><td><a href="histIndiv.html?dt='+arrDateTime[i]+'&va='+arrValance[i]+'&ar='+arrArousal[i]+'&ad='+arrAdditional[i]+'&em='+arrEmotoions[i]+'">'+arrDateTime[i]+'</a></td><td>'+(arrArousal[i]*5)+'</td><td>'+(arrValance[i]*5)+'</td></tr>'
				}//for
				
				
				dispHistory = dispHistory + '</table></p><a class="btn btn-primary btn-lg" href="menu.html" role="button">Main Menu</a></p></body></html>'
					document.write(dispHistory);
					
		}//else
			


	}//func



function setLFresults(){
		
	
	//source of inspiration https://github.com/scotttrinh/angular-localForage/issues/48 
	//but i cant remember why i felt the need to reference it... being safe i guess 
	//accessed 20/3/19
	
	localforage.setItem('lfArousal', arrArousal).then(function(value){
		console.log("set Arousal in storage:"+value); 
		}); //set lfArousal
	localforage.setItem('lfValance', arrValance).then(function(value){
		console.log("set Valance in storage:"+value); 
		}); //set lfValance
	localforage.setItem('lfDateTime', arrDateTime).then(function(value){
		console.log("set Date and Times in storage:"+value); 
		}); //set lfValance


} //setLFresults

function dateTimeToString(){
	var dateTime = new Date().toLocaleString('en-GB');
    // need to add this to a variable!

	
}
function changeyourname(){
if (confirm("Are you sure you want to change name?")) {
			window.window.location.href = 'entername.html';	
			} 
		else 
			window.window.location.href = 'settings.html';	
}

function clearAllData(){
	
	
	
	//used LocalForage documetnation for this bit of code:
//	https://localforage.github.io/localForage/#data-api-clear
//accessed 20/3/19
	
	 if (confirm("Are you sure you want to clear all data?")) {
			localforage.clear().then(function() {
			// Run this code once the database has been entirely deleted.
			console.log('Database is now empty.');
			alert("All data has been deleted.");
			window.window.location.href = 'index.html';	
			
			
			}).catch(function(err) {
				// This code runs if there were any errors
			console.log(err); });
			
			} 
		else 
			window.window.location.href = 'settings.html';	
  
	
	
}//clearalldata()
			
	function getParamaters(theParamater){
		
			    //reference for function getParamaters
				//http://www.technicaloverload.com/get-value-url-parameters-using-javascript/
				//"Nathan" - Technical Overload - 8/8/2014 - Accessed 11/3/19
				
					for (var i = 0; i< param.length; i++){
					
					var p=param[i].split('=');
					if (p[0] == theParamater){
						return decodeURIComponent(p[1]);
					}//if
					}//for
					return false;
				
				}//func
			
			
function resultsPgeLoad() {
	//this was my first go at this function.. it was just a test that wrote to document
	//. v2 below is what is used in final version (plots chart), but i've kept it in to demonstrate my process
					//function runs when pages opens
			var ar = getParamaters('xArousal');
			var va = getParamaters('yValance');
			var dt = getParamaters('dateTime');
			
		document.write(dt + "  --- " + ar + " --- " + va);
				
				//create function to retrieve data and add new valuies!!
				
				
		localforage.getItem('lfArousal', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
	      arrArousal = value;
		  if (arrArousal==null)  
			  arrArousal = [ar];
		  else
			arrArousal.push(ar);
		  localforage.setItem('lfArousal', arrArousal).then(function(value){
			console.log("set Arousal in storage:"+value); 
				}); //set lfArousal
		});//getItem		
				
		localforage.getItem('lfValance', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
			arrValance = value;
			if (arrValance==null)
				arrValance=[va];
			else
			arrValance.push(va);
		  localforage.setItem('lfValance', arrValance).then(function(value){
			console.log("set valance in storage:"+value); 
				}); //set lfvalance
		});//getItem

		localforage.getItem('lfDateTime', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
	      arrDateTime=value;
		  if (arrDateTime==null)
			  arrDateTime = [dt];
		  else
			arrDateTime.push(dt);
		  localforage.setItem('lfDateTime', arrDateTime).then(function(value){
			console.log("set date time in storage:"+value); 
				}); //set lfDateTime
		});//getItem	
				
				
				
}
	
function resultsPageLoadV2(){
		
			var ar = getParamaters('xArousal');
			var va = getParamaters('yValance');
			var dt = getParamaters('dateTime');

var pVal = ((va/20)*90); //for dot location
var pAr = ((ar/20)*90); //for dot location

var resultString='<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"><link rel="stylesheet" href="css/bootstrap.css"><link rel="stylesheet" href="css/gm.css"><title>Giúmar Maith</title></head><body"><script type="text/javascript" src="js/menuJS.js"></script> <script type="text/javascript" src="js/localforage.js"></script> <div class="jumbotron"><h1>Giúmar Maith</h1><h2>/gu-mer-moy/</h2></div>';

resultString=resultString + '<style type="text/css">img{max-height: 100%; max-width: 100%;}.parent {position: relative;top: 0;left: 0;}.chart {position: relative;top: 0;left: 0;}.reddot {position: absolute;top:'+pAr+'%;left:'+pVal+'%;padding:10px;}</style>';

resultString = resultString + '<h4>Your Results:</h4>Valence Score:'+(va*5)+'</br >Arousal Score:'+(ar*5)+'<div class="parent"><div class="chart"><img src="images/russell_chart_blank.jpg"></div><div class="reddot"><img src="images/RedDot.png" width="25px" height="25px">	</div></div><br /> <h6>How do you feel?</h6>';
resultString = resultString + '<form><input type="checkbox" id="emotions1" name="emotions1" value="Alert">Alert<input type="checkbox" id="emotions2" name="emotions2" value="Excited"> Excited<input type="checkbox" id="emotions3" name="emotions3" value="Elated"> Elated<input type="checkbox" id="emotions4" name="emotions4" value="Happy"> Happy<br><input type="checkbox" id="emotions5" name="emotions5" value="Content"> Content<input type="checkbox" id="emotions6" name="emotions6" value="Relaxed"> Relaxed<input type="checkbox" name="emotions7" id="emotions7" value="Stressed"> Stressed<input type="checkbox" id="emotions8" name="emotions8" value="Tense"> Tense<br><input type="checkbox" id="emotions9" name="emotions9" value="Sad"> Sad<input type="checkbox" id="emotions10" name="emotions10" value="Upset"> Upset<input type="checkbox" id="emotions11" name="emotions11" value="Bored"> Bored<input type="checkbox"  id="emotions12" name="emotions12" value="Tired"> Tired<br><br/><h6>Additional information:</h6><textarea name="additional" id="additional" rows="5" cols="35"></textarea><br/><p><a class="btn btn-primary btn-lg" href="javascript:afterResults();" role="button">Submit</a></p></form></body></html>';

//write check boxes and text box and return button!

document.write(resultString);
  
		localforage.getItem('lfArousal', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
	      arrArousal = value;
		  if (arrArousal==null)  
			  arrArousal = [ar];
		  else
			arrArousal.push(ar);
		  localforage.setItem('lfArousal', arrArousal).then(function(value){
			console.log("set Arousal in storage:"+value); 
				}); //set lfArousal
		});//getItem		
				
		localforage.getItem('lfValance', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
			arrValance = value;
			if (arrValance==null)
				arrValance=[va];
			else
			arrValance.push(va);
		  localforage.setItem('lfValance', arrValance).then(function(value){
			console.log("set valance in storage:"+value); 
				}); //set lfvalance
		});//getItem

		localforage.getItem('lfDateTime', function(err, value) {
      console.log("retrieve name:" + value); //consolevalue
	      arrDateTime=value;
		  if (arrDateTime==null)
			  arrDateTime = [dt];
		  else
			arrDateTime.push(dt);
		  localforage.setItem('lfDateTime', arrDateTime).then(function(value){
			console.log("set date time in storage:"+value); 
				}); //set lfDateTime
		});//getItem	

	}
	
	
	
function afterResults(){
	
var add= document.getElementById('additional').value;
var emot = " ";	
//var addLength = add.length;	
	
	if (add=="")
		add="Nothing Entered";
	
	add = add.replace(/[|&;$%@"<>()+,#={}?+-]/g, " ");
	//inspired from stack overflow https://stackoverflow.com/questions/3780696/javascript-string-replace-with-regex-to-strip-off-illegal-characters
	//accessed 20/3/19
	//same again, prevents sql/script/html injection
	
	/*this didn't work for some reason, hence the solution above!!
	for (var i=0;i<addLength;i++){
		if ((add[i]=="<")||(add[i]==">") || (add[i]=="?") || (add[i]=="$") || (add[i]=="+") 
			|| (add[i]=="-")|| (add[i]=="[")|| (add[i]=="]")|| (add[i]=="}")|| (add[i]=="{")
			|| (add[i]=="\\"))
			{
				add[i]=".";
			}//if		
	}*/
	
	for (var i=1;i<=12;i++){
		var emotTest = document.getElementById('emotions'+i).value;
		if (document.getElementById('emotions'+i).checked == true)
			emot = emot + " - " + emotTest;
	}
	
	if (emot == " ")
		emot = "No emotions selected";
	
	saveAddInfo(emot, add);

	//window.location.href = "menu.html";
	
}

function saveAddInfo(emot, add){

		localforage.getItem('lfDateTime', function(err, value) {
			console.log("retrieve name:" + value); //consolevalue
	    
			arrDateTime = value;
		    var dtLength=arrDateTime.length;
		  
				localforage.getItem('additional', function(err, value){
					console.log("retrieve additional :" +value);
					arrAdditional = value;
					 if (arrAdditional==null){
						arrAdditional = ["Nothing Entered"];
						arrAdditional[dtLength-1] = add;
					 }
					else
						arrAdditional[dtLength-1]=add;
					
					localforage.getItem('emotions', function(err, value){
					console.log("retrieve emotions:" +value);
					arrEmotoions = value;
					 if (arrEmotoions==null){
						arrEmotoions = ["None Selected"];
						arrEmotoions[dtLength-1] = emot;
						
					 }
					else
						arrEmotoions[dtLength-1]=emot;
					
					localforage.setItem('emotions', arrEmotoions).then(function(value){
					console.log("set emotions to storage:"+value); 
					});//setemot
						localforage.setItem('additional', arrAdditional).then(function(value){
						console.log("set addition free text  in storage:"+value); 
						
						window.location.href = "menu.html";
						}); //set additional
				
					});//getEmotions
				});//getadditional
		});//getdatetime	
		
}


function indivResults(){
	
	var dt	= getParamaters('dt');
	var va = getParamaters('va');
	var ar = getParamaters('ar');
	var em = getParamaters('em');
	var ad = getParamaters('ad');
	//document.write(resID);
	
	if (ad=="undefined")
		ad="No additional Comments";
	if (em=="undefined")
		em="No emotions selected";
	
	var pVal = ((va/20)*90); //for dot location
    var pAr = ((ar/20)*90); //for dot location

var resultString='<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"><link rel="stylesheet" href="css/bootstrap.css"><link rel="stylesheet" href="css/gm.css"><title>Giúmar Maith</title></head><body"><script type="text/javascript" src="js/menuJS.js"></script> <script type="text/javascript" src="js/localforage.js"></script> <div class="jumbotron"><h1>Giúmar Maith</h1><h2>/gu-mer-moy/</h2></div>';

resultString=resultString + '<style type="text/css">img{max-height: 100%; max-width: 100%;}.parent {position: relative;top: 0;left: 0;}.chart {position: relative;top: 0;left: 0;}.reddot {position: absolute;top:'+pAr+'%;left:'+pVal+'%;padding:10px;}</style>';
	
resultString = resultString + '<h4>'+dt+'<div class="parent"><div class="chart"><img src="images/russell_chart_blank.jpg"></div><div class="reddot"><img src="images/RedDot.png" width="25px" height="25px">	</div></div>';
resultString = resultString + '</h4>Valence Score:'+(va*5)+'</br >Arousal Score:'+(ar*5)+'<h4>Emotions Checked: </h4>'+em+'<h4>Additional Comments: </h4>'+ad;
	
resultString = resultString + '<p><p><a class="btn btn-primary btn-lg" href="history.html" role="button">Back to History</a></p><a class="btn btn-primary btn-lg" href="menu.html" role="button">Main Menu</a></p></body></html>';

document.write(resultString);
	
}
