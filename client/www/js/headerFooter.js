//header footer

var head = "<ons-list-header style='height:auto;background-color:white;border-style: solid;'><img src='img/logo.gif' width=100% height='auto' /></ons-list-header>";



var foot = "<ons-bottom-toolbar style='position:fixed;height: 60px;display: flex; justify-content:space-evenly;  '><a href='home.html' ><img src='img/home64.png' height='50' width='50'></a><a href='search.html'><img  src='img/search64.png' height='50' width='50' ></a><a href='map.html'><img src='img/loc64.png' height='50' width='50'></a><a href='eventLoginCheck.html'><img  src='img/add64.png' height='50' width='50' ></a><a href='profile.html'><img  src='img/profile64.png' height='50' width='50'></a></ons-bottom-toolbar>";

document.getElementById("header").innerHTML = head;
document.getElementById("footer").innerHTML = foot;

