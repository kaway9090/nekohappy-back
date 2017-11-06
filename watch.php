<?php
require 'proezas.php';
date_default_timezone_set("America/Sao_Paulo");
if(!isset($_GET['id']) || empty($_GET['id']))
echo '<script>location.href="/";</script>';
else{

if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){

    $iduser2 = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user2 = DBRead('user', "WHERE id = '{$iduser2}' LIMIT 1 ");
    $user2 = $user2[0];


    

		$idanime = DBEscape( strip_tags(trim($_GET['id']) ) );
        $video = DBRead('videos', "WHERE id and idanime = '{$idanime}' LIMIT 1 ");
        
        $idanime2 = DBEscape( strip_tags(trim($_GET['id']) ) );
        $video2 = DBRead('anime', "WHERE id LIMIT 1 ");
	
	if($video){
		$video = $video[0];
		}else{
		echo '<script>location.href="home.php";</script>';	
        }
        
        if($video2){
            $video2 = $video2[0];
            }else{
            echo '<script>location.href="home.php";</script>';	
            }
		
		if($user2['configurado'] == 0){
			echo '<script>location.href="/";</script>';
		}
		
}
}

?>

<head>
<title>NekoHappy | <?php echo $video2['nome']; ?> <?php echo $video['nome']; ?></title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/assets/css/all.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<style>
body{
    overflow-x: hidden;
}
.profile{
	background: #f2f2f2;
}
.scroll{
	width: 90vw;
}
.avatar5{
	max-width: 225px;
	height: 225px;
	width: 100%;
	top: 20px;
	z-index: 1000;
	position: relative;
	border: 2px solid #ccc;
}
.avatar-content{
	padding: 20px 40px;
}
.user-content-name{
	color: #fff;
    font-family: Verdana,Arial;
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    text-align: left;
    padding: 0px 10px;
    background: #000;
}
.buttons-content{
	margin-top: 40px;
	background: transparent;
	width: 230px;
	height: 40px;
	cursor: pointer;
	border: none;
	border-bottom: 1px solid #ccc;
	z-index: 1000;
}
.buttons-content:hover{
	background: #e5e5e5;
}
.buttons-content svg{
	position: relative;
	float: left;
	left: 10px;
	height: 20px;
}
.buttons-content span{
	position: relative;
	top: 5px;
	font-size: 18px;
}
.content-b{
	background-color: #f5e1e1;
    border-bottom-color: #a22e2e;
    border-left-color: #ebebeb;
    border-right-color: #ebebeb;
    border-style: solid;
    border-top-color: #f5e1e1;
	border-width: 0px;
	position: absolute;
	top: -48.5px;
	left: 0;
	width: 100%;
	height: 24px;
}
.header-av{
	float: right;
	border-radius: 0px;
	height: 30px;
	width: 30px;
	right: 10px;
	position: relative;
	margin-top: 20px;
}
.header-av:hover{
	opacity: .7;
}
.links-header-a{
	color: #fff;
	font-size: 17px;
	padding: 10px;
	top: 10px;
	left: 0;
	position: relative;
	cursor: pointer;
	margin-left: 5px;
}
.links-header-a:hover{
	background: #f5e1e1;
	color: #000;
}
.edit-profile{
	font-size: 15px;
	background: transparent;
	position: absolute;
	top: 4px;
	right: 0;
	color: #9b1d1d;
}
.edit-profile:hover{
	background: transparent;
	text-decoration: underline;
}
.coverino{
	background-image: url(/static/img/icones_info.png);
    background-size: auto;
    background-repeat: no-repeat;
    height: 17px;
    width: 10px;
    background-position: -17px -50px;
    z-index: 100;
    position: absolute;
    margin-top: 2px;
    float: right;
	right: 7px;
	display: none;
}
.tags-a-menu{
	color: #a22e2e;
	text-align: center;
	position: relative;
	left: 0px;
	font-size: 15px;
}
.menu-tag li{
	border-bottom: #a22e2e 1px solid;
	cursor: pointer;
	padding: 5px;
}
.menu-tag li:hover{
	background: #f5e1e1;
}
.menu-tag{
	width: 140px;
	background: #fff;
	height: auto;
	position: relative;
	border: #a22e2e 1px solid;
	float: right;
	right: -85px;
	z-index: 5020;
	top: 55px;
	display: none;
}
.logost{
	height: 60px;
	width: 60px;
	top: 10px;
}
.hint{
	position: absolute;
	display: flex;
    justify-content: space-between;
    align-items: center;
    max-height: 80px;
    padding: 12px;
    font-size: 12px;
    line-height: 1.3;
    background-color: #fffefa;
    border-left: 1px solid #faebcc;
    border-right: 1px solid #faebcc;
    border-bottom: 1px solid #faebcc;
    box-sizing: border-box;
    opacity: 1.0;
	transition: all 0.45s ease;
	top: 0;
	width: 100%;
	top: -24px;
	left: 0;
	border: 1px solid #fff;
}
.hint p{
	color: #8a6d3b;
	cursor: pointer;
}
.hint p:hover{
	color: #a22e2e;
}
.statics{
	position: relative;
	height: auto;
	width: 230px;
	background: rgba(0,0,0,.40);
	margin-top: 20px;
	border: 1px solid #fff;
}
.statics p{
	padding: 5px;
	color: #fff;
}
.statics li{
	padding: 5px;
	color: #fff;
}
.background-cl41{
	width: 100%;
	height: 100%;
	background-size: cover;
	background-image: url(/static/img/animes/<?php echo $video2['background']; ?>);
	position: fixed;
}
eooq{
	width: 100%;
	height: 100%;
	position: fixed;
	background: rgba(121, 20, 20, 0.6);
}
.ativo{
	background: #f5e1e1;
	color: #000;
}
.header-scroll{
    height: 39px !important;
    top: 79px !important;
}
</style>

<html>
<body class="profile">
<div class="background-cl41"></div>
<eooq></eooq>
<div class="header-scroll2 center" id="header1">
<div class="hal-index"></div>
<div class="hallowen"></div>
<img src="/static/img/logo.png" class="logost"/>
<a href="profile.php?id=<?php echo $user2['id']; ?>">
<img src="/static/img/avatar/<?php echo $user2['photo'];?>" class="avatar header-av"/>
</a>
<div class="div-tag" id="taginfo">
<a class="user-photo-tag-header"><?php echo $user2['user'];?></a>
<i class="coverino"></i>
</div>

<button id="infonot" class="notifications" ><svg <?php
$peoples5 = DBRead( 'noti', "WHERE id and para = '".$user['id']."'  ORDER BY id DESC LIMIT 1" );
if (!$peoples5)
echo 'fill="#000"';	
else  
	foreach ($peoples5 as $people5):	 
?> 
 <?php  echo 'fill="#a22e2e"' ?>

	<?php endforeach; ?>version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="25px" height="25px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
<g>
	<g id="notifications">
		<path d="M255,510c28.05,0,51-22.95,51-51H204C204,487.05,226.95,510,255,510z M420.75,357V216.75
			c0-79.05-53.55-142.8-127.5-160.65V38.25C293.25,17.85,275.4,0,255,0c-20.4,0-38.25,17.85-38.25,38.25V56.1
			c-73.95,17.85-127.5,81.6-127.5,160.65V357l-51,51v25.5h433.5V408L420.75,357z"/>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
</button>

<div class="notifications-div" id="news">
<?php
$peoples5 = DBRead( 'noti', "WHERE id and para = '".$user['id']."'  ORDER BY id DESC LIMIT 10" );
if (!$peoples5)
echo '<p style="padding: 10px;width: 100%; position :relative; left: 0px;">Não tens nenhuma notificação</p>';	
else  
	foreach ($peoples5 as $people5):	 
?>
<?php
$people56 = $people5['de'];
$peoples = DBRead( 'user', "WHERE id = $people56  ORDER BY id DESC LIMIT 10" );
if (!$peoples)
echo '<p>Não tens nenhuma notificação</p>';	
else  
	foreach ($peoples as $people):	 
?>
<li class="news-li">
<img src="/static/img/avatar/<?php echo $people['photo'];?>" class="avatar" style="margin-top: 10px;margin-left: 10px; height: 30px;width:30px;"/>
<p style="position: relative;top: -23px;margin-left: 45px;">
	<?php
	if($people5['tipo'] = 1){
		echo 'Começou a te seguir';
	}
	?>
</p>
</li>
	<?php endforeach;endforeach;?>
</div>

<div class="menu-tag" id="menu-e">
<a href="profile.php?id=<?php echo $user2['id'];?>"class="tags-a-menu"><li>Perfil</li></a>
<a class="tags-a-menu"><li>Seguidores</li></a>
<a class="tags-a-menu"><li>Clubes</li></a>
<a class="tags-a-menu"><li>Configuração</li></a>
<a href="logout.php" class="tags-a-menu"><li>Sair</li></a>
</div>

<script>
var menu = document.getElementById('menu-e');
var news = document.getElementById('news');
var icon_not = document.getElementById('taginfo');
var news_not = document.getElementById('infonot');
	icon_not.addEventListener('click', function(e){
	e.stopPropagation();
	menu.style.display = 'block';
});
news_not.addEventListener('click', function(e){
	e.stopPropagation();
	news.style.display = 'block';
});
	menu.addEventListener('click', function(e){
	e.stopPropagation();
	menu.style.display = 'block';
});
document.addEventListener('click', function(){
 				menu.style.display = 'none';
				news.style.display = 'none';
 			});
</script>
</div>

<div class="header-scroll center" id="header2">
<a href="home.php" class="links-header-a">Página inicial</a>
<a href="profile.php?id=<?php echo $user['id']; ?>" class="links-header-a">Perfil</a>
<a href="series.php" class="links-header-a ativo">Assistir animes</a>
<div class="search">
<div id="searchinput">
<input type="text" placeholder="Busque amigos" class="nomeanime" value="<?php echo $video2['nome']; ?>"/>
		  <div id="box-s-h">
		    <ul class="src">
			</ul>
		  </div>
	  <script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/js-all.js" type="text/javascript"></script>
			<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/js-all.js" type="text/javascript"></script>
</div>
</div>
</div>

<style>
.assistindoa<?php echo $video2['id']; ?>{
    width: 953px;
    height: 40px;
    background: #fff;
    position: relative;
	top: 90px;
	box-shadow: 3px 2px 3px rgba(0,0,0,0.80);
}

.assistindoa2<?php echo $video2['id']; ?>{
    width: 953px;
    height: 40px;
    background: #fff;
    position: relative;
	top: 30px;
	box-shadow: 3px 2px 3px rgba(0,0,0,0.80);
}

.assistindoa2<?php echo $video2['id']; ?> p{
    font-size: 1.2em;
    padding: 0.6vw;
    color: #fff;
}

.assistindoa<?php echo $video2['id']; ?> p{
    font-size: 22px;
    padding: 10px;
}
</style>

<div class="assistindoa<?php echo $video2['id']; ?> center" id="ass1">
<p>Assistindo à <?php echo $video2['nome'];?> - <?php echo $video['nome']; ?></p>
</div>

<div class="player center content top border shadow" id="player2">
    <video id="playerwatchpri" preload="metadata" src="<?php echo $video['link'];?>"> </video>
    <div id="player">
    <div class="right top2 border2 shadow">
        <button id="buttonpp">
    <svg id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="35px" fill="#fff"; xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M128,96v320l256-160L128,96L128,96z"/></g></svg>
</button>
<button id="mute" style="border: none; background: transparent;display:none;">
</button>
<button id="muted" style="border: none; background: transparent;display:none;">
</button>
<button id="fullscreenico" style="border: none; background: transparent;display:none;">
</button>
<button id="buttonpmp" style="display:none;">
<svg enable-background="new 0 0 32 32" style="position: relative; left: 2px;" height="26px" id="svg2" version="1.1" viewBox="0 0 32 32" width="26px" fill="#fff" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><g id="background"><rect fill="none" height="32" width="32"/></g><g id="pause"><g><rect height="24" width="8" x="20" y="4"/><rect height="24" width="8" x="4" y="4"/></g></g></svg>
</button>

<button id="fullscreenedico" style="border: none; background: transparent;display:none;">
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

<div class="assistindoa2<?php echo $video2['id']; ?> center" id="ass2">
<p>
<form method="post">
<button name="sharefriends" style="border:none; padding: 0.5vw; background: #a22e2e; color: #fff; cursor: pointer;top: -0.3vw; position: relative;">
Compartilhar vídeo na linha do tempo</button>

<button name="addlist" style="border:none; padding: 0.5vw; background: #a22e2e; color: #fff; cursor: pointer;top: -0.3vw; position: relative;">
Adicionar à minha lista</button>
</form>
</p>
<?php
include('db.php');
if(isset($_POST['sharefriends'])){
$time = date('Y-m-d H:i:s');
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$tipo = "3";
$anime = $video2['id'];
$video = $video['link'];
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query("insert into neko_post(anime,id_user,tipo,tim,video) values ('$anime','$iduser','$tipo','$time','$video')");
$fetch= mysql_query("SELECT texto,id,tim FROM neko_post order by id desc");
$row=mysql_fetch_array($fetch);
echo '<script>location.href="home.php";</script>';
}
?>
<?php
if(isset($_POST['addlist'])){
	$time = date('Y-m-d H:i:s');
	$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
	$tipo = "4";
	$anime = $video2['id'];
	$video = $video['link'];
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query("insert into neko_list(idanime,iduser,time) values ('$anime','$iduser','$time')");
$fetch= mysql_query("SELECT idanime,id,time FROM neko_list order by id desc");
mysql_query("insert into neko_post(anime,id_user,tipo,tim,video) values ('$anime','$iduser','$tipo','$time','$video')");
$row=mysql_fetch_array($fetch);
echo '<script>location.href="home.php";</script>';
}
?>
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
document.getElementById("button").onmouseover = function() {showplayer()};
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
document.getElementById("header1").style.display = "none";
document.getElementById("header2").style.display = "none";
document.getElementById("player2").style = "width: 100%; height: 100%;top: -40px; position: fixed;";
document.getElementById("fullscreenedico").style.display = "block";
document.getElementById("fullscreenico").style.display = "none";
document.getElementById("ass1").style.display = "none";
document.getElementById("ass2").style.display = "none";
document.getElementById("").style.display = "none";
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
document.getElementById("header1").style.display = "block";
document.getElementById("header2").style.display = "block";
document.getElementById("player2").style = "width: 953px;height: 580px;";
document.getElementById("ass1").style.display = "block";
document.getElementById("ass2").style.display = "block";
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
});

var timeout;
document.getElementById("playerwatchpri").onmousemove = function(){
  clearTimeout(timeout);
  timeout = setTimeout(function(){
document.getElementById("playerwatchpri").style.cursor = "pointer";	
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



</html>

</body>