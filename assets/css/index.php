<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<head>
<title>NekoAnime</title>
<link rel="stylesheet" type="text/css" href="http://netflix0002.ddns.net:5151/branitube/assets/css/all.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<html>
<body>
<div class="player center content top border shadow">
    <video id="playerwatchpri" preload="metadata" src="http://branitube.org/embed/66/jikan-no-shihaisha/Jikan-no-Shihaisha-04.mp4" autoplay> </video>
    <div id="player">
    <div class="right top2 border2 shadow">
        <button id="buttonpp">
    <svg id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="35px" fill="#fff"; xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M128,96v320l256-160L128,96L128,96z"/></g></svg>
</button>
<button id="mute" style="display:none;">
</button>
<button id="muted" style="display:none;">
</button>
<button id="fullscreenico" style="display:none;">
</button>
<button id="buttonpmp" style="display:none;">
</button>

<button id="fullscreenedico" style="display:none;">
</button>


<div id="current" class="progress border">
<div id="defaultBar">
</div>
<div id="progressBar" class="progressatual">
<div id="button" class="button-progress border-tat">
    </div>
</div>
</div>
</div>


</div>
    </div>
</div>

<script type="text/javascript">
document.getElementById("playerwatchpri").onclick = function() {vidplay()};
document.getElementById("buttonpp").onclick = function() {vidplay()};
document.getElementById("buttonpmp").onclick = function() {vidplay()};
document.getElementById("playerwatchpri").onclick = function() {vidplay()};
document.getElementById("playerwatchpri").ondblclick = function() {goFullscreen()};
document.getElementById("player").onmouseover = function() {showplayer()};
document.getElementById("current").onmouseover = function() {showplayer()};
document.getElementById("defaultBar").onmouseover = function() {showplayer()};
document.getElementById("progressBar").onmouseover = function() {showplayer()};
]document.getElementById("button").onmouseover = function() {showplayer()};
document.getElementById("buttonpp").onclick = function() {showplayer()};
document.getElementById("mute").onclick = function() {mute()};
document.getElementById("muted").onclick = function() {mute()}
document.getElementById("fullscreenico").onclick = function() {goFullscreen()};
document.getElementById("fullscreenedico").onclick = function() {goFullscreen()}
document.getElementById("fullscreenedico").onclick = function() {goFullscreen()};

var video = document.getElementById("playerwatchpri");
var bar = document.getElementById("current");
bar.addEventListener("click", seek);
var progressBar = document.getElementById("progressBar");


function seek(e) {
var percent = e.offsetY / this.offsetHeight;
video.currentTime = percent * video.duration;
progressBar.value = percent / 100;
}

video.addEventListener('progress', function() {
var bufferedEnd = video.buffered.end(video.buffered.length - 1);
var duration =  video.duration;
if (duration >= 0) {
      document.getElementById('defaultBar').style.height = ((bufferedEnd / duration)*100) + "%";
}
});

video.addEventListener('timeupdate', function() {
var duration =  video.duration;
if (duration > 0) {
	var bufferedEnd = video.buffered.end(video.buffered.length - 1);
document.getElementById('progressBar').style.height = ((video.currentTime / duration)*100) + "%";

var videotimer = document.getElementById('defaultBar').style.height = ((bufferedEnd / duration)*100) + "%";
video.ontimeupdate = function() {myFunction()};

}
});	

function vidplay() {	
if (video.paused) {
video.play();
document.getElementById("buttonpmp").style.display = "block";
document.getElementById("buttonpp").style.display = "none";
} else {	
video.pause();
document.getElementById("buttonpp").style.display = "block";
document.getElementById("buttonpmp").style.display = "none";
}
}

function skip(value) {
var video = document.getElementById("playerwatchpri");
video.currentTime += value;
video.play();
}

function mute(){
if (video.muted) {
video.muted = false;
document.getElementById("mute").style.display = "block";
document.getElementById("muted").style.display = "none";
}else{
video.muted = true;
document.getElementById("muted").style.display = "block";
document.getElementById("mute").style.display = "none";	
}
}
	
function goFullscreen() {
if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
document.getElementById("normal").setAttribute("id","full");
document.getElementById("header").style.display = "none";
document.getElementById("inikopy").setAttribute("id","fullscreen");
document.getElementById("fullscreenedico").style.display = "block";
document.getElementById("fullscreenico").style.display = "none";
	} else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
document.getElementById("fullscreenico").style.display = "block";
document.getElementById("fullscreenedico").style.display = "none";	
}
}

document.onkeyup = function(evt) {
evt = evt || window.event;
if (evt.keyCode == 27 || evt.keyCode == 122) {
if (document.exitFullscreen) {
document.exitFullscreen();
} else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
document.getElementById("full").setAttribute("id","normal");
document.getElementById("header").style.display = "block";
document.getElementById("fullscreen").setAttribute("id","inikopy");
document.getElementById("fullscreenico").style.display = "block";
document.getElementById("fullscreenedico").style.display = "none";	
}
}

document.getElementById("playerwatchpri").addEventListener('timeupdate', function() {
var video = document.getElementById("playerwatchpri");
	var nt = video.currentTime * (100 / video.duration);
	var curmins = Math.floor(video.currentTime / 60);
	var cursecs = Math.floor(video.currentTime - curmins * 60);
	var durmins = Math.floor(video.duration / 60);
	var dursecs = Math.floor(video.duration - durmins * 60);
	if(cursecs < 10){ cursecs = "0"+cursecs; }
	if(dursecs < 10){ dursecs = "0"+dursecs; }
	if(curmins < 10){ curmins = "0"+curmins; }
	if(durmins < 10){ durmins = "0"+durmins; }
	document.getElementById("currtime").innerHTML = curmins+":"+cursecs;
});

var timeout;
document.getElementById("playerwatchpri").onmousemove = function(){
  clearTimeout(timeout);
  timeout = setTimeout(function(){
document.getElementById("playerwatchpri").style.cursor = "none";	
document.getElementById("player").style.opacity = "0";
  }, 2000);
document.getElementById("playerwatchpri").style.cursor = "auto";
document.getElementById("player").style.opacity = "1";		
document.getElementById("helphover").style.display = "none";
document.getElementById("hoverep").style.display = "none";
document.getElementById("current").style.display = "block";
document.getElementById("currtime").style.display = "block";
}
function showplayer(){
document.getElementById("player").style.opacity = "1";	 	
}
</script>

</body>
</html>