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


		$iduser = DBEscape( strip_tags(trim($_GET['id']) ) );
		$user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
	
	if($user){
		$user = $user[0];
		if($user2['id'] <> $user['id']){
		$visitas = array(
			'visitas' => $user['visitas'] + 1);
			DBUpDate( 'user', $visitas, "id = '{$user['id']}'" );
		}
		}else{
		echo '<script>location.href="home.php";</script>';	
		}
		
		if($user2['configurado'] == 0){
			echo '<script>location.href="/";</script>';
		}
		
}
}


if (isset($_POST['add'])) {
	if (!isset($login_cookie)) {
		header("Location: login.php");
	}
	$xpadd = array('xppor' => $user['xppor'] + 20);
	DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
	$id = $_GET['id'];
	$saberr = mysql_query("SELECT * FROM neko_user WHERE id='$id'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $user['id'];
	$data = date("Y/m/d");
	$login_cookie = $_COOKIE['iduser'];
	$tipo = "1";

	$ins = "INSERT INTO neko_amizades (`de`,`para`,`data`) VALUES ('$login_cookie','$email','$data')";
	$ins2 = "INSERT INTO neko_noti (`de`,`para`,`date`,`tipo`) VALUES ('$login_cookie','$email','$data','$tipo')";

	$conf = mysql_query($ins) or die(mysql_error());
	if ($conf) {
		header("Location: profile.php?id=".$id);
	}else{
		echo "<h3>Erro ao enviar pedido...</h3>";
	}

	$conf = mysql_query($ins2) or die(mysql_error());
	if ($conf) {
		header("Location: profile.php?id=".$id);
	}else{
		echo "<h3>Erro ao enviar pedido...</h3>";
	}
}
if (isset($_POST['remove'])) {
$login_cookie = $_COOKIE['iduser'];
if (!isset($login_cookie)) {
	header("Location: login.php");
}
$id = $_GET['id'];
$saberr = mysql_query("SELECT * FROM neko_user WHERE id='$id'");
$saber = mysql_fetch_assoc($saberr);
$email = $user['id'];

$xpadd = array('xppor' => $user['xppor'] - 20);
DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );

$ins = "DELETE FROM neko_amizades WHERE `de`='$login_cookie' AND para='$email'";
$conf = mysql_query($ins) or die(mysql_error());
if ($conf) {
	header("Location: profile.php?id=".$id);
}else{
	echo "<h3>Erro ao eliminar amizade...</h3>";
}
}

if(empty($_COOKIE['iduser']) and (empty($_COOKIE['inisession']))){
    echo '<script>location.href="login.php";</script>';
}
if(empty($_COOKIE['inisession'])){
    echo '<script>location.href="login.php";</script>';
}
if(empty($_COOKIE['iduser'])){
    echo '<script>location.href="login.php";</script>';
}if($user['configurado'] == 0){
    echo '<script>location.href="configure.php";</script>';
}

if (isset($_POST['aceitar'])) {
	$login_cookie = $_COOKIE['login'];
	if (!isset($login_cookie)) {
		header("Location: login.php");
	}
	$id = $_GET['id'];
	$saberr = mysql_query("SELECT * FROM users WHERE id='$id'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $saber['email'];

	$ins = "UPDATE amizades SET `aceite`='sim' WHERE `de`='$email' AND para='$login_cookie'";
	$conf = mysql_query($ins) or die(mysql_error());
	if ($conf) {
		header("Location: profile.php?id=".$id);
	}else{
		echo "<h3>Erro ao eliminar amizade...</h3>";
	}
}	

?>

<head>
<title>NekoHappy | <?php echo $user['user']; ?></title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/all.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<style>
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
.cover-content{
	position: absolute;
	z-index: 0;
	top: 20px;
	width: 100%;
	left: 0;
	height: 260px;
	background-image: url(/static/img/cover/<?php echo $user['fotoback'];?>);
	background-size: cover;
	border-bottom: 2px solid #ccc;
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
	background-image: url(/static/img/background/<?php echo $user['background']; ?>);
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
</style>

<html>
<body class="profile">
<?php if(empty($user['background'])){
	echo '';
}
	else{?>
	<div class="background-cl41"></div>
<eooq></eooq>
<?php } ?>
<div class="header-scroll2 center">
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

<div class="header-scroll center">
<a href="home.php" class="links-header-a">Página inicial</a>
<a href="#" class="links-header-a ativo">Perfil</a>
<a href="series.php" class="links-header-a">Assistir animes</a>
<div class="search">
<div id="searchinput">
<input type="text" placeholder="Busque amigos" class="nome" value="<?php echo $user['user']; ?>"/>
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

<div class="scroll center">
<div class="center tudo  maintudo flex">
<div class="avatar-content">

<div class="content-b">
<h1 class="user-content-name">Perfil de <?php echo $user['user'];?></h1>
<?php  if($user2['id'] == $user['id']){?>
<a href="#"><h1 class="edit-profile">Editar perfil</h1></a>
<?php } ?>
</div>
<div class="hint">
<p>Você pode ganhar uma medalha se fazer uma publicação.</p>
</div>
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="avatar5"/>
<?php  if($user['vip'] == 1){?>
<img src="/static/img/vip.png" style="height: 40px; position: absolute;z-index: 2200;left: 220px;top: 40px;"/>
<?php } ?>

<div class="cover-content">
<eooqc></eooqc>
<div class="exp-and-lvl">
<baka>
<div class="lvlup">
<center><p>Nível</p><border-t>
<?php 
if($user['xppor'] <= 50){
 echo "1";
}
   else if($user['xppor'] <= 150){
	echo "2";
   }
   else if($user['xppor'] <= 500){
	echo "3";
   }
   else if($user['xppor'] <= 850){
	echo "4";
   }
   else if($user['xppor'] <= 1000){
	echo "5";
   }
   else if($user['xppor'] <= 1750){
	echo "6";
   }
   else if($user['xppor'] <= 2900){
	echo "7";
   }
   else if($user['xppor'] <= 3050){
	echo "8";
   }
   else if($user['xppor'] <= 4150){
	echo "9";
   }
   else if($user['xppor'] <= 5250){
	echo "10";
   }
   else if($user['xppor'] <= 6150){
 echo "10";
}
   else if($user['xppor'] <= 7150){
	echo "11";
   }
   else if($user['xppor'] <= 8500){
	echo "12";
   }
   else if($user['xppor'] <= 9850){
	echo "13";
   }
   else if($user['xppor'] <= 10000){
	echo "14";
   }
   else if($user['xppor'] <= 11750){
	echo "15";
   }
   else if($user['xppor'] <= 12900){
	echo "16";
   }
   else if($user['xppor'] <= 1360){
	echo "17";
   }
   else if($user['xppor'] <= 14150){
	echo "18";
   }
   else if($user['xppor'] <= 15250){
	echo "19";
   }
   else if($user['xppor'] <= 16250){
	echo "20";
   }
    else if($user['xppor'] <= 17250){
	echo "21";
   }
   else if($user['xppor'] <= 18500){
	echo "22";
   }
   else if($user['xppor'] <= 19850){
	echo "23";
   }
   else if($user['xppor'] <= 20000){
	echo "24";
   }
   else if($user['xppor'] <= 21750){
	echo "25";
   }
   else if($user['xppor'] <= 22900){
	echo "26";
   }
   else if($user['xppor'] <= 23050){
	echo "27";
   }
   else if($user['xppor'] <= 24050){
	echo "28";
   }
   else if($user['xppor'] <= 25250){
	echo "29";
   }
   else if($user['xppor'] <= 26250){
	echo "30";
   }
    else if($user['xppor'] <= 27350){
	echo "31";
   }
   else if($user['xppor'] <= 28500){
	echo "33";
   }
   else if($user['xppor'] <= 29850){
	echo "33";
   }
   else if($user['xppor'] <= 30000){
	echo "34";
   }
   else if($user['xppor'] <= 31750){
	echo "35";
   }
   else if($user['xppor'] <= 33900){
	echo "36";
   }
   else if($user['xppor'] <= 33050){
	echo "37";
   }
   else if($user['xppor'] <= 34050){
	echo "38";
   }
   else if($user['xppor'] <= 35350){
	echo "39";
   }
   else if($user['xppor'] <= 36350){
	echo "40";
   }
   else if($user['xppor'] <= 28450){
	echo "41";
   }
   else if($user['xppor'] <= 29500){
	echo "42";
   }
   else if($user['xppor'] <= 30850){
	echo "44";
   }
   else if($user['xppor'] <= 40000){
	echo "44";
   }
   else if($user['xppor'] <= 41750){
	echo "45";
   }
   else if($user['xppor'] <= 44900){
	echo "46";
   }
   else if($user['xppor'] <= 44050){
	echo "47";
   }
   else if($user['xppor'] <= 44050){
	echo "48";
   }
   else if($user['xppor'] <= 45450){
	echo "49";
   }
   else if($user['xppor'] <= 46450){
	echo "50";
   }
    else if($user['xppor'] <= 48550){
	echo "51";
   }
   else if($user['xppor'] <= 49500){
	echo "52";
   }
   else if($user['xppor'] <= 5000){
	echo "53";
   }
   else if($user['xppor'] <= 50500){
	echo "55";
   }
   else if($user['xppor'] <= 51750){
	echo "55";
   }
   else if($user['xppor'] <= 55900){
	echo "56";
   }
   else if($user['xppor'] <= 55050){
	echo "57";
   }
   else if($user['xppor'] <= 55050){
	echo "58";
   }
   else if($user['xppor'] <= 55550){
	echo "59";
   }
   else if($user['xppor'] <= 56550){
	echo "60";
   }
   else if($user['xppor'] >= 56560){
	echo "61";
   }
?>
</border-t>
</div>
<?php if($user['xppor'] > 1500){ echo '';} else{ ?>
<?php if($user['xppor'] >= 200){ ?>
<div class="medal">
<img src="/static/img/conquistas/embaixador.png" class="small-img"/>
<a class="white-a">Embaixador da Comunidade</a>
<p style="font-size: 12px;position: relative; left: 75px;bottom: 18px; color:#898989;">200 XP</p>
</div>
<?php }?>
<?php } ?>

<?php if($user['xppor'] > 1500){ ?>
<div class="medal">
<img src="/static/img/conquistas/leader.png" class="small-img"/>
<a class="white-a">Líder da Comunidade</a>
<p style="font-size: 12px;position: absolute; left: 75px;bottom: 25px; color:#898989;">1550 XP</p>
</div>
<?php }?>

<br>
</center>
</baka>
</div></div>



<div class="buttons-friend">

<?php  if($user2['id'] <> $user['id']){?>
<form method="POST">
		<?php
		$email = $user['id'];
		$login_cookie = $_COOKIE['iduser'];
			$amigos = mysql_query("SELECT * FROM neko_amizades WHERE de='$login_cookie' AND para='$email'");
			$amigoss = mysql_fetch_assoc($amigos);
			if (mysql_num_rows($amigos)>=1 AND $amigoss["aceite"]=="sim") {
				echo '<button class="buttons-content">
				<span>Você já tá seguindo</span>
				</button>';
			}elseif (mysql_num_rows($amigos)>=1 AND $amigoss["aceite"]=="nao" AND $amigoss["de"]==$login_cookie){
				echo '<button class="buttons-content" name="remove">
				<span>Parar de seguir</span>
				</button>';
			}else{
				echo '<button class="buttons-content" name="add">
				<svg height="30px" id="svg2" version="1.1" viewBox="0 0 99.999995 99.999995" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs4"><filter id="filter4510" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(0,0,0)" flood-opacity="0.470588" id="feFlood4512" result="flood"/><feComposite id="feComposite4514" in="flood" in2="SourceGraphic" operator="in" result="composite1"/><feGaussianBlur id="feGaussianBlur4516" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="4.7" id="feOffset4518" result="offset"/><feComposite id="feComposite4520" in="SourceGraphic" in2="offset" operator="over" result="composite2"/></filter><filter id="filter5064" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(206,242,245)" flood-opacity="0.835294" id="feFlood5066" result="flood"/><feComposite id="feComposite5068" in="flood" in2="SourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur5070" in="composite1" result="blur" stdDeviation="5.9"/><feOffset dx="0" dy="-8.1" id="feOffset5072" result="offset"/><feComposite id="feComposite5074" in="offset" in2="SourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter5364" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(0,0,0)" flood-opacity="0.835294" id="feFlood5366" result="flood"/><feComposite id="feComposite5368" in="flood" in2="SourceGraphic" operator="in" result="composite1"/><feGaussianBlur id="feGaussianBlur5370" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="4.2" id="feOffset5372" result="offset"/><feComposite id="feComposite5374" in="SourceGraphic" in2="offset" operator="over" result="fbSourceGraphic"/><feColorMatrix id="feColorMatrix5592" in="fbSourceGraphic" result="fbSourceGraphicAlpha" values="0 0 0 -1 0 0 0 0 -1 0 0 0 0 -1 0 0 0 0 1 0"/><feFlood flood-color="rgb(254,255,189)" flood-opacity="1" id="feFlood5594" in="fbSourceGraphic" result="flood"/><feComposite id="feComposite5596" in="flood" in2="fbSourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur5598" in="composite1" result="blur" stdDeviation="7.6"/><feOffset dx="0" dy="-8.1" id="feOffset5600" result="offset"/><feComposite id="feComposite5602" in="offset" in2="fbSourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter4400" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(0,0,0)" flood-opacity="0.470588" id="feFlood4402" result="flood"/><feComposite id="feComposite4404" in="flood" in2="SourceGraphic" operator="in" result="composite1"/><feGaussianBlur id="feGaussianBlur4406" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="5" id="feOffset4408" result="offset"/><feComposite id="feComposite4410" in="SourceGraphic" in2="offset" operator="over" result="fbSourceGraphic"/><feColorMatrix id="feColorMatrix4640" in="fbSourceGraphic" result="fbSourceGraphicAlpha" values="0 0 0 -1 0 0 0 0 -1 0 0 0 0 -1 0 0 0 0 1 0"/><feFlood flood-color="rgb(255,253,180)" flood-opacity="1" id="feFlood4642" in="fbSourceGraphic" result="flood"/><feComposite id="feComposite4644" in="flood" in2="fbSourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur4646" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="-5" id="feOffset4648" result="offset"/><feComposite id="feComposite4650" in="offset" in2="fbSourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter4678" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(255,253,180)" flood-opacity="1" id="feFlood4680" result="flood"/><feComposite id="feComposite4682" in="flood" in2="SourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur4684" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="-7" id="feOffset4686" result="offset"/><feComposite id="feComposite4688" in="offset" in2="SourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter5045" style="color-interpolation-filters:sRGB"><feFlood flood-color="rgb(255,250,175)" flood-opacity="1" id="feFlood5047" result="flood"/><feComposite id="feComposite5049" in="flood" in2="SourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur5051" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="-6" id="feOffset5053" result="offset"/><feComposite id="feComposite5055" in="offset" in2="SourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter4607" style="color-interpolation-filters:sRGB;"><feFlood flood-color="rgb(255,247,180)" flood-opacity="1" id="feFlood4609" result="flood"/><feComposite id="feComposite4611" in="flood" in2="SourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur4613" in="composite1" result="blur" stdDeviation="5"/><feOffset dx="0" dy="-6" id="feOffset4615" result="offset"/><feComposite id="feComposite4617" in="offset" in2="SourceGraphic" operator="atop" result="composite2"/></filter><filter id="filter4507" style="color-interpolation-filters:sRGB;"><feFlood flood-color="rgb(255,249,199)" flood-opacity="1" id="feFlood4509" result="flood"/><feComposite id="feComposite4511" in="flood" in2="SourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur4513" in="composite1" result="blur" stdDeviation="3"/><feOffset dx="0" dy="-2.60417" id="feOffset4515" result="offset"/><feComposite id="feComposite4517" in="offset" in2="SourceGraphic" operator="atop" result="fbSourceGraphic"/><feColorMatrix id="feColorMatrix4687" in="fbSourceGraphic" result="fbSourceGraphicAlpha" values="0 0 0 -1 0 0 0 0 -1 0 0 0 0 -1 0 0 0 0 1 0"/><feFlood flood-color="rgb(255,244,153)" flood-opacity="1" id="feFlood4689" in="fbSourceGraphic" result="flood"/><feComposite id="feComposite4691" in="flood" in2="fbSourceGraphic" operator="out" result="composite1"/><feGaussianBlur id="feGaussianBlur4693" in="composite1" result="blur" stdDeviation="3.4"/><feOffset dx="0" dy="-3.9" id="feOffset4695" result="offset"/><feComposite id="feComposite4697" in="offset" in2="fbSourceGraphic" operator="atop" result="composite2"/></filter></defs><g id="layer3" style="display:inline" transform="translate(0,-99.999988)"><path d="M 20 0 C 8.9199896 0 0 8.9199896 0 20 L 0 80 C 0 91.080008 8.9199896 100 20 100 L 80 100 C 91.080008 100 100 91.080008 100 80 L 100 20 C 100 8.9199896 91.080008 0 80 0 L 20 0 z M 43.558594 13.634766 A 16.125004 16.125004 0 0 1 59.683594 29.759766 A 16.125004 16.125004 0 0 1 43.558594 45.884766 A 16.125004 16.125004 0 0 1 27.433594 29.759766 A 16.125004 16.125004 0 0 1 43.558594 13.634766 z M 75.707031 29.251953 A 3.5003503 3.5003503 0 0 1 79.259766 32.800781 L 79.259766 39.300781 L 85.761719 39.300781 A 3.5003503 3.5003503 0 0 1 89.310547 42.748047 A 3.5003503 3.5003503 0 0 1 85.761719 46.300781 L 79.259766 46.300781 L 79.259766 52.800781 A 3.5003503 3.5003503 0 1 1 72.259766 52.800781 L 72.259766 46.300781 L 65.761719 46.300781 A 3.5003503 3.5003503 0 1 1 65.761719 39.300781 L 72.259766 39.300781 L 72.259766 32.800781 A 3.5003503 3.5003503 0 0 1 75.707031 29.251953 z M 55.328125 47.066406 C 64.37326 54.286619 71.480469 58.739345 71.480469 86.365234 L 15.638672 86.365234 C 15.638672 59.247955 22.741861 54.292422 31.783203 47.068359 C 35.475503 48.610172 39.49272 49.412875 43.560547 49.421875 C 47.62501 49.411025 51.63919 48.607556 55.328125 47.066406 z " id="rect4208" style="opacity:1;fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:3.79999995;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1" transform="translate(0,99.999988)"/></g></svg>
				<span>Seguir</span>
				</button>';
			}
		?>
		</form>
		<?Php } else{?>
		
			<button class="buttons-content" name="editprofile">
			<a href="editprofile.php?fotoperfil" style="color: #a22e2e;"><span>Editar layout do meu perfil</span></a>
				</button>


		<?php } ?>

<div class="statics">
<p>Sobre <?php echo $user['user'];?></p>
<li>Mora em : <?php 
 if($user['estado'] == 'ac'){
      echo 'Acre';
  }
  else if($user['estado'] == 'sc'){
    echo 'Santa Catarina';
    }
    else if($user['estado'] == 'al'){
        echo 'Alagoas';
        }
		else if($user['estado'] == 'am'){
            echo 'Amazonas';
            }
            else if($user['estado'] == 'ap'){
                echo 'Amapá';
                }

                else if($user['estado'] == 'ba'){
                    echo 'Bahia';
                }
                else if($user['estado'] == 'ce'){
                  echo 'Ceará';
                  }
                  else if($user['estado'] == 'df'){
                      echo 'Distrito Federal';
                      }
                      else if($user['estado'] == 'es'){
                          echo 'Espírito Santo';
                          }
            else if($user['estado'] == 'go'){
                 echo 'Goiás';
                   }          
				   else if($user['estado'] == 'ma'){
                    echo 'Maranhão';
                }
                else if($user['estado'] == 'mt'){
                  echo 'Mato Grosso';
                  }
                  else if($user['estado'] == 'ms'){
                      echo 'Mato Grosso do Sul';
                      }
                      else if($user['estado'] == 'mg'){
                          echo 'Minas Gerais';
                          }
                          else if($user['estado'] == 'pa'){
                              echo 'Pará';
                              }

                              else if($user['estado'] == 'pb'){
                                echo 'Paraíba';
                                  }          
								  else if($user['estado'] == 'pr'){
                                   echo 'Paraná';
                               }
                               else if($user['estado'] == 'pe'){
                                 echo 'Pernambuco';
                                 }
                                 else if($user['estado'] == 'pi'){
                                     echo 'Piauí';
                                     }
                                     else if($user['estado'] == 'rj'){
                                         echo 'Rio de Janeiro';
                                         }
                                         else if($user['estado'] == 'rn'){
                                             echo 'Rio Grande do Norte';
                                             }


                                             
											 else if($user['estado'] == 'ro'){
                                echo 'Rondônia';
                                  }          
								  else if($user['estado'] == 'rs'){
                                   echo 'Rio Grande do Sul';
                               }
                               else if($user['estado'] == 'rr'){
                                 echo 'Roraima';
                                 }
                                 else if($user['estado'] == 'se'){
                                     echo 'Sergipe';
                                     }
                                     else if($user['estado'] == 'sp'){
                                         echo 'São Paulo';
                                         }
                                         else if($user['estado'] == 'to'){
                                             echo 'Tocantins';
                                             }
                                             else if($user['estado'] == 'outro'){
                                                echo 'De outro país';
												}
												else{
													echo 'Undefined';
												}
?> </li>
<li>Gosta de ver: <?Php echo $user['anime_favorite'];?> </li>
<li>Pontos: <?Php echo $user['coins'];?> </li>
<li>Visitas: <?Php echo $user['visitas'];?> </li>
<li>Sexo: <?Php if($user['sexo'] == 'masc'){
                                         echo 'Masculino';
                                         }
                                         else if($user['sexo'] == 'fem'){
                                             echo 'Feminino';
                                             }
                                             else if($user['sexo'] == 'not'){
                                                echo 'Não quero definir';
                                                }else{
													echo 'Undefined';
												} ?> </li>
												<li>MyAnimeList: <?Php echo $user['myanimelist'];?> </li>
												<hr>
												<li style="font-size: 18px;">Proezas</li>
												<?php
$coments = DBRead( 'proezas', "WHERE id and id_user = '". $user['id'] ."' ORDER BY id DESC LIMIT 10" );
if (!$coments)
echo '<p>Nenhuma proezas</p>';	
else  
	foreach ($coments as $coment):	 
?>
	<?php  if($coment['tipo'] == 2){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/proeza1.jpg" class="proezasimg"/>
	<p style="font-size: 14px; float: left;margin-top: 10px;">+100 pontos</p>
	</li>
	</div>
	<?php } ?>

	<?php if($coment['tipo'] == 1){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/escrito.jpg" class="proezasimg"/>
	<p style="font-size: 14px; float: left;margin-top: 10px;">Primeira postagem</p>
	</li>
	</div>
	<?php } ?>

	<?php if($coment['tipo'] == 3){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/completa.jpg" class="proezasimg"/>
	<p style="font-size: 14px; float: left;margin-top: 10px;">Você me completa</p>
	</li>
	</div>
	<?php } ?>

	<?php if($coment['tipo'] == 4){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/fotofirst.jpg" class="proezasimg"/>
	<p style="font-size: 14px; float: left;margin-top: 10px;">Primeira foto</p>
	</li>
	</div>
	<?php } ?>

	<?php if($coment['tipo'] == 5){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/vis.jpg" class="proezasimg"/>
	<p style="font-size: 14px;float: left;margin-top: 10px;">+50 de visitas</p>
	</li>
	</div>
	<?php } ?>

	<?php if($coment['tipo'] == 6){?>
	<div class="proezas-div-ul">
	<li>
	<img src="/static/img/proezas/vip.jpg" class="proezasimg"/>
	<p style="font-size: 14px; float: left;margin-top: 10px;">Tornou-se VIP</p>
	</li>
	</div>
	<?php } ?>
	<?php endforeach;?>
</div>



</div>



</div>


<div class="animes_favorito">
<?php
$totaldepost = mysql_query("SELECT * FROM neko_amizades WHERE id and de = '".$user['id']."' ");
$totaldepost = mysql_num_rows($totaldepost);
?>
<h2 class="seguindo2 <?php echo $user['id'] ?>">Seguidores de <?php echo $user['user'];?> (<?php echo $totaldepost; ?>)</h2>
<?php
$coments = DBRead( 'amizades', "WHERE id and de = '".$user['id']."' ORDER BY id DESC LIMIT 7" );
if (!$coments)
echo '<p style="position: relative; color:#fff;top: 40px; left: 50px; font-size: 18px;">Nenhum seguidor</p>';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['para'];
$peoples = DBRead( 'user', "WHERE id = '".$comentiduser."' ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>	
	<a href="profile.php?id=<?php echo $people['id'];?>" style="color: #a22e2e;" ><li class="seguidores">
	<center><img src="/static/img/avatar/<?php echo $people['photo']?>" class="seguindoimg center"/>
	<p style="position: relative; top:5px;"><?php
	$str2 = nl2br( $people['user'] ); 
	$len2 = strlen( $str2 );
	$max2 = 11;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p></center>
	</li></a>
	<?php endforeach;endforeach;?>
	<hr style="margin-top:50px;">
	<?php
$totaldepost2 = mysql_query("SELECT * FROM neko_list WHERE id and iduser = '".$user['id']."' ");
$totaldepost = mysql_num_rows($totaldepost2);
?>
<h2 style="padding:5px;" class="seguindo2 <?php echo $user['id'] ?>">Lista de animes de <?php echo $user['user'];?> (<?php echo $totaldepost; ?>)</h2>
<?php
$coments = DBRead( 'list', "WHERE id and iduser = '".$user['id']."' ORDER BY id DESC LIMIT 7" );
if (!$coments)
echo '<p style="position: relative; color:#fff;top: 40px; left: 50px; font-size: 18px;">Nenhum anime adicionado!</p>';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['iduser'];
$peoples = DBRead( 'user', "WHERE id = '".$comentiduser."' ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>	
<?php
$comentiduser2 = $coment['idanime'];
$peoples3 = DBRead( 'anime', "WHERE id = $comentiduser2 ORDER BY id DESC LIMIT 1" );
if (!$peoples3)
echo '';	
else  
	foreach ($peoples3 as $people3):	 
?>
	<a style="color: #a22e2e;" >
	<li class="seguidores">
	<center><img src="/static/img/animes/<?php echo $people3['foto']?>" class="seguindoimg center"/>
	<p style="position: relative; top:5px;"><?php
	$str2 = nl2br( $people3['nome'] ); 
	$len2 = strlen( $str2 );
	$max2 = 11;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p></center>
	</li></a>
	<?php endforeach;endforeach;endforeach;?>
</div>

</div>

<div class="center teste">
<?php if($user['id'] == $_COOKIE['iduser']){?>
<div class="postperfil flex">

<div class="postagem6 flex relative">
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="photoavatar2 relative"/>
<form style="width:100%;" name="form" action="" method="post" enctype="multipart/form-data">
<textarea type="text" id="content" placeholder="Em que estás a pensar?" class="postagem">
</textarea>
<div class="bottom-postagem">

<button class="publish">
Publicar
</button>
</div>
</form>
<script type="text/javascript">
$(function() {
$(".publish").click(function() {
var textcontent = $("#content").val();
var dataString = 'content='+ textcontent;
if(textcontent=='')
{
alert("Digite alguma coisa..");
$("#content").focus();
}
else
{
$.ajax({
type: "POST",
url: "action2.php",
data: dataString,
cache: true,
success: function(html){
$("#show").after(html);
document.getElementById('content').value='';
$("#flash").hide();
$("#content").focus();
}  
});
}
return false;
});
});
</script>
</div>
    </div>
<?php } ?>

<div class="postagens-perfil relative">
<div class="space"></div>
<div id="flash"></div>
<div id="show"></div>

<?php
$coments = DBRead( 'post', "WHERE id and id_user = '".$user['id']."' and tipo = 1 ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>

    
<div class="people-status-div-post center">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40" style="border-radius:50%;"></a>
										</li>

										<li class="name"><a href="profile.php?id=<?php echo $people['id']?>"><span class="bold"> <?php echo $people['nome']?> <?php echo $people['sobname']?> - <?php echo $people['user']?> </span></a>

														<ul class="scope-time-ul">
															<li><a href="#" class="su-time"><?php echo $coment['tim']?></a></li>
															<li><a href="#"><span class="fa fa-globe globe-icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Shared with: Public"></span></a></li>
														</ul>
										</li>
									</ul>

									<div class="user-status">
											<article>
													<p class="eooq">
                                                    <?php 
                                                    $emotions = array(':)', ':@', '8)', ':D', ':3', ':(', ';)', ':O', ':o', ':P', ':p', '<3');
                                                    $imgs = array(
                                                        '<img id="emoticon" src="/static/img/emotions/nice.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/angry.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/cool.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/happy.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/sad.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/right.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                        '<img id="emoticon" src="/static/img/emotions/heart.png"/>'
                                                    );
                                                    $msg = str_replace($emotions, $imgs, $coment['texto']);
                                                    echo $msg;
                                                    ?>
													</p>
											</article>
									</div> 
									
									<div class="people-reaction-activity">
											<ul class="r-activity-list">
												<li><span class="fb_icon like"></span><a href="#">Curtir</a></li>
												<li><span class="fb_icon share"></span><a href="#">Compartilhar</a></li>
											</ul>
									</div> 
								</li>
					</div>


    <?php endforeach;endforeach;?>

	<?php
$coments = DBRead( 'post', "WHERE id and tipo = 4 and id_user = '".$user['id']."' ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>
<?php
$comentiduser = $coment['anime'];
$peoples3 = DBRead( 'anime', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples3)
echo '';	
else  
	foreach ($peoples3 as $people3):	 
?>
    
<div class="people-status-div-post center">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40" style="border-radius:50%;"></a>
										</li>

										<li class="name"><a href="profile.php?id=<?php echo $people['id']?>"><span class="bold"> <?php echo $people['nome']?> <?php echo $people['sobname']?> - <?php echo $people['user']?> </span></a>

														<ul class="scope-time-ul">
															<li><a href="#" class="su-time"><?php echo $coment['tim']?> - Adicionou o anime na sua lista.</a></li>
															<li><a href="#"><span class="fa fa-globe globe-icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Shared with: Public"></span></a></li>
														</ul>
										</li>
									</ul>

									<div class="user-status">
											<article>
													<p class="eooq">
                                                    Adicionou o anime <?php echo $people3['nome']; ?> na sua lista.
                                                    <img style="width: 100%; height: 400px;" src="/static/img/animes/<?php echo $people3['foto'];?>"/>
													</p>
											</article>
									</div> 
									
									<div class="people-reaction-activity">
											<ul class="r-activity-list">
												<li><span class="fb_icon like"></span><a href="#">Curtir</a></li>
												<li><span class="fb_icon share"></span><a href="#">Compartilhar</a></li>
											</ul>
									</div> 
								</li>
					</div>


    <?php endforeach;endforeach;endforeach;?>

	<?php
$coments = DBRead( 'post', "WHERE id and id_user = '".$user['id']."' and tipo = 2 ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>
<?php
$comentiduser = $coment['anime'];
$peoples3 = DBRead( 'anime', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples3)
echo '';	
else  
	foreach ($peoples3 as $people3):	 
?>
    
<div class="people-status-div-post center">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40" style="border-radius:50%;"></a>
										</li>

										<li class="name"><a href="profile.php?id=<?php echo $people['id']?>"><span class="bold"> <?php echo $people['nome']?> <?php echo $people['sobname']?> - <?php echo $people['user']?> </span></a>

														<ul class="scope-time-ul">
															<li><a href="#" class="su-time"><?php echo $coment['tim']?> - Compartilhou um anime</a></li>
															<li><a href="#"><span class="fa fa-globe globe-icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Shared with: Public"></span></a></li>
														</ul>
										</li>
									</ul>

									<div class="user-status">
											<article>
													<p class="eooq">
                                                    <img style="width: 100%; height: 500px;" src="/static/img/animes/<?php echo $people3['foto'];?>"/>
													</p>
											</article>
									</div> 
									
									<div class="people-reaction-activity">
											<ul class="r-activity-list">
												<li><span class="fb_icon like"></span><a href="#">Curtir</a></li>
												<li><span class="fb_icon share"></span><a href="#">Compartilhar</a></li>
											</ul>
									</div> 
								</li>
					</div>


    <?php endforeach;endforeach;endforeach;?>

	<?php
	$user = $user['id'];
$coments = DBRead( 'post', "WHERE id and id_user = $user and tipo = 5 ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>
<?php
$comentiduser = $coment['anime'];
$peoples3 = DBRead( 'anime', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples3)
echo '';	
else  
	foreach ($peoples3 as $people3):	 
?>

<?php
$anime2 = $people3['id'];
$peoples4 = DBRead( 'videos', "WHERE id = $anime2 ORDER BY id DESC LIMIT 1" );
if (!$peoples4)
echo '';	
else  
	foreach ($peoples4 as $people4):	 
?>
    
<div class="people-status-div-post center">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40" style="border-radius:50%;"></a>
										</li>

										<li class="name"><a href="profile.php?id=<?php echo $people['id']?>"><span class="bold"> <?php echo $people['nome']?> <?php echo $people['sobname']?> - <?php echo $people['user']?> </span></a>

														<ul class="scope-time-ul">
															<li><a href="#" class="su-time"><?php echo $coment['tim']?> - Compartilhou um episodio</a></li>
															<li><a href="#"><span class="fa fa-globe globe-icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Shared with: Public"></span></a></li>
														</ul>
										</li>
									</ul>
                                    
									<div class="user-status">
											<article>
                                            <style>
                                            .content{
                                                width: 100%;
                                                height: 40vw;
                                                position: relative;
                                                top: 0;
                                            }
                                            body{
                                                overflow-x: hidden;
                                            }
                                            </style>
													<p class="eooq">
                                                    <div class="player center content top border shadow">
    <video id="playerwatchpri" preload="metadata" src="<?php echo $people4['link'];?>"> </video>
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
													</p>
                                                    <script type="text/javascript">
document.getElementById("playerwatchpri").onclick = function() {vidplay()};
document.getElementById("buttonpp").onclick = function() {vidplay()};
document.getElementById("buttonpmp").onclick = function() {vidplay()};
document.getElementById("playerwatchpri").onclick = function() {vidplay()};
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
											</article>
									</div> 
									
								
								</li>
					</div>


    <?php endforeach;endforeach;endforeach;endforeach;?>

</div>

</div>
</div>

</body>
</html>
