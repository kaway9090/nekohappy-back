<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){
    $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
    $user = $user[0];
    if($user['lastlogin'] <> $_COOKIE['inisession']){
        setcookie("iduser" , "");
        setcookie("inisession" , "");
        setcookie("perfil" , "");
        header("location: login.php?sessaonova");
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
?>
<head>
<title>NekoHappy</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
<link rel="stylesheet" type="text/css" href="/assets/css/all.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<style>
.profile{
	background: #f2f2f2;
}
.scroll{
	width: 962px;
}
.tudo{
	box-shadow: 0 2px 2px rgba(0,0,0,.25);
    -moz-box-shadow: 0 2px 2px rgba(0,0,0,.25);
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.25);
    padding-bottom: 10px;
	background: #fff;
	height: auto;
	z-index: 1000;
	margin-top: 190px;
	width: 100%;
	display: flex;
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
    color: #000;
    font-family: Verdana,Arial;
    font-size: 18px;
    font-weight: 700;
    margin: 0;
	text-align: left;
	width: 100%;
	padding: 0px 10px;
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
	background: #fff;
	margin-top: 20px;
	box-shadow: 1px 1px 1px 1px rgba(1,0,0,.30);
}
.statics p{
	padding: 5px;
}
.statics li{
	padding: 5px;
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
    max-width: 90vw;
	height: 100%;
	position: relative;
	background: rgba(121, 20, 20, 0.6);
}
.ativo{
	background: #f5e1e1;
	color: #000;
}
.header-scroll{
    height: 39px !important;
}
</style>

<html>
<body style="background: #151515;">
<div class="header-scroll2 center">
<div class="hal-index"></div>
<div class="hallowen"></div>
<img src="/static/img/logo.png" class="logost"/>
<a href="profile.php?id=<?php echo $user['id']; ?>">
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="avatar header-av"/>
</a>
<div class="div-tag" id="taginfo">
<a class="user-photo-tag-header"><?php echo $user['user'];?></a>
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
<?php
if($people5['tipo'] = 1){?>
<img src="/static/img/avatar/<?php echo $people['photo'];?>" class="avatar" style="margin-top: 10px;margin-left: 10px; height: 30px;width:30px;"/>
<p style="position: relative;top: -23px;margin-left: 45px;">
<?Php } ?>
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
<a href="profile.php?id=<?php echo $user['id'];?>"class="tags-a-menu"><li>Perfil</li></a>
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
<a href="#" class="links-header-a ativo">Página inicial</a>
<a href="profile.php?id=<?php echo $user['id'];?>" class="links-header-a">Perfil</a>
<a href="series.php" class="links-header-a">Assistir animes</a>
<div class="search">
<div id="searchinput">
<input type="text" placeholder="Busque amigos" class="nome"/>
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


<div class="home-ata center">
<?php if(empty($user['background'])){
	echo '';
}
	else{?>
<div class="tab"><eooq style="width: 90vw; height: 50px; position: absolute;"></eooq></div>
<style>
.tab{
	background-size: cover;
	width: 100%;
	height: 50px;
	background-image: url(/static/img/background/<?Php echo $user['background'] ?>);
}
</style>
<?php } ?>

<div class="right-content-friend">
<p style="font-size: 18px;margin-left: 10px;padding: 10px;color: #fff;">Pessoas para você seguir</p>
<?php
$estadoeu = $user['estado'];
$peoples = DBRead( 'user', "WHERE id <> '".$user['id']."'  and estado = '".$user['estado']."' ORDER BY id DESC LIMIT 10" );
if (!$peoples){
?>

<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id <> '".$user['id']."'  ORDER BY id DESC LIMIT 10" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>

<a href="profile.php?id=<?php echo $people['id'];?>">
	<li class="amigos-seguir">
	<img src="/static/img/avatar/<?php echo $people['photo'] ?>" class="avatar"/>
	<p><?php
	$str2 = nl2br( $people['user'] ); 
	$len2 = strlen( $str2 );
	$max2 = 50;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p>
	</li>
	<border-t2 style="position: relative;top:-30px;float:right; right: 10px;z-index: 2000;"><?php 
if($people['xppor'] <= 50){
 echo "1";
}
   else if($people['xppor'] <= 150){
	echo "2";
   }
   else if($people['xppor'] <= 500){
	echo "3";
   }
   else if($people['xppor'] <= 850){
	echo "4";
   }
   else if($people['xppor'] <= 1000){
	echo "5";
   }
   else if($people['xppor'] <= 1750){
	echo "6";
   }
   else if($people['xppor'] <= 2900){
	echo "7";
   }
   else if($people['xppor'] <= 3050){
	echo "8";
   }
   else if($people['xppor'] <= 4150){
	echo "9";
   }
   else if($people['xppor'] <= 5250){
	echo "10";
   }
   else if($people['xppor'] <= 6150){
 echo "10";
}
   else if($people['xppor'] <= 7150){
	echo "11";
   }
   else if($people['xppor'] <= 8500){
	echo "12";
   }
   else if($people['xppor'] <= 9850){
	echo "13";
   }
   else if($people['xppor'] <= 10000){
	echo "14";
   }
   else if($people['xppor'] <= 11750){
	echo "15";
   }
   else if($people['xppor'] <= 12900){
	echo "16";
   }
   else if($people['xppor'] <= 1360){
	echo "17";
   }
   else if($people['xppor'] <= 14150){
	echo "18";
   }
   else if($people['xppor'] <= 15250){
	echo "19";
   }
   else if($people['xppor'] <= 16250){
	echo "20";
   }
    else if($people['xppor'] <= 17250){
	echo "21";
   }
   else if($people['xppor'] <= 18500){
	echo "22";
   }
   else if($people['xppor'] <= 19850){
	echo "23";
   }
   else if($people['xppor'] <= 20000){
	echo "24";
   }
   else if($people['xppor'] <= 21750){
	echo "25";
   }
   else if($people['xppor'] <= 22900){
	echo "26";
   }
   else if($people['xppor'] <= 23050){
	echo "27";
   }
   else if($people['xppor'] <= 24050){
	echo "28";
   }
   else if($people['xppor'] <= 25250){
	echo "29";
   }
   else if($people['xppor'] <= 26250){
	echo "30";
   }
    else if($people['xppor'] <= 27350){
	echo "31";
   }
   else if($people['xppor'] <= 28500){
	echo "33";
   }
   else if($people['xppor'] <= 29850){
	echo "33";
   }
   else if($people['xppor'] <= 30000){
	echo "34";
   }
   else if($people['xppor'] <= 31750){
	echo "35";
   }
   else if($people['xppor'] <= 33900){
	echo "36";
   }
   else if($people['xppor'] <= 33050){
	echo "37";
   }
   else if($people['xppor'] <= 34050){
	echo "38";
   }
   else if($people['xppor'] <= 35350){
	echo "39";
   }
   else if($people['xppor'] <= 36350){
	echo "40";
   }
   else if($people['xppor'] <= 28450){
	echo "41";
   }
   else if($people['xppor'] <= 29500){
	echo "42";
   }
   else if($people['xppor'] <= 30850){
	echo "44";
   }
   else if($people['xppor'] <= 40000){
	echo "44";
   }
   else if($people['xppor'] <= 41750){
	echo "45";
   }
   else if($people['xppor'] <= 44900){
	echo "46";
   }
   else if($people['xppor'] <= 44050){
	echo "47";
   }
   else if($people['xppor'] <= 44050){
	echo "48";
   }
   else if($people['xppor'] <= 45450){
	echo "49";
   }
   else if($people['xppor'] <= 46450){
	echo "50";
   }
    else if($people['xppor'] <= 48550){
	echo "51";
   }
   else if($people['xppor'] <= 49500){
	echo "52";
   }
   else if($people['xppor'] <= 5000){
	echo "53";
   }
   else if($people['xppor'] <= 50500){
	echo "55";
   }
   else if($people['xppor'] <= 51750){
	echo "55";
   }
   else if($people['xppor'] <= 55900){
	echo "56";
   }
   else if($people['xppor'] <= 55050){
	echo "57";
   }
   else if($people['xppor'] <= 55050){
	echo "58";
   }
   else if($people['xppor'] <= 55550){
	echo "59";
   }
   else if($people['xppor'] <= 56550){
	echo "60";
   }
   else if($people['xppor'] >= 56560){
	echo "61";
   }
?></border-t2>
	</a>

	<?php endforeach; ?>


<?php } else{
	foreach ($peoples as $people): ?>
	<a href="profile.php?id=<?php echo $people['id'];?>">
	<li class="amigos-seguir">
	<img src="/static/img/avatar/<?php echo $people['photo'] ?>" class="avatar"/>
	<p><?php
	$str2 = nl2br( $people['user'] ); 
	$len2 = strlen( $str2 );
	$max2 = 50;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p>
	</li>
	<border-t2 style="position: relative;top:-30px;float:right; right: 10px;z-index: 2000;"><?php 
if($people['xppor'] <= 50){
 echo "1";
}
   else if($people['xppor'] <= 150){
	echo "2";
   }
   else if($people['xppor'] <= 500){
	echo "3";
   }
   else if($people['xppor'] <= 850){
	echo "4";
   }
   else if($people['xppor'] <= 1000){
	echo "5";
   }
   else if($people['xppor'] <= 1750){
	echo "6";
   }
   else if($people['xppor'] <= 2900){
	echo "7";
   }
   else if($people['xppor'] <= 3050){
	echo "8";
   }
   else if($people['xppor'] <= 4150){
	echo "9";
   }
   else if($people['xppor'] <= 5250){
	echo "10";
   }
   else if($people['xppor'] <= 6150){
 echo "10";
}
   else if($people['xppor'] <= 7150){
	echo "11";
   }
   else if($people['xppor'] <= 8500){
	echo "12";
   }
   else if($people['xppor'] <= 9850){
	echo "13";
   }
   else if($people['xppor'] <= 10000){
	echo "14";
   }
   else if($people['xppor'] <= 11750){
	echo "15";
   }
   else if($people['xppor'] <= 12900){
	echo "16";
   }
   else if($people['xppor'] <= 1360){
	echo "17";
   }
   else if($people['xppor'] <= 14150){
	echo "18";
   }
   else if($people['xppor'] <= 15250){
	echo "19";
   }
   else if($people['xppor'] <= 16250){
	echo "20";
   }
    else if($people['xppor'] <= 17250){
	echo "21";
   }
   else if($people['xppor'] <= 18500){
	echo "22";
   }
   else if($people['xppor'] <= 19850){
	echo "23";
   }
   else if($people['xppor'] <= 20000){
	echo "24";
   }
   else if($people['xppor'] <= 21750){
	echo "25";
   }
   else if($people['xppor'] <= 22900){
	echo "26";
   }
   else if($people['xppor'] <= 23050){
	echo "27";
   }
   else if($people['xppor'] <= 24050){
	echo "28";
   }
   else if($people['xppor'] <= 25250){
	echo "29";
   }
   else if($people['xppor'] <= 26250){
	echo "30";
   }
    else if($people['xppor'] <= 27350){
	echo "31";
   }
   else if($people['xppor'] <= 28500){
	echo "33";
   }
   else if($people['xppor'] <= 29850){
	echo "33";
   }
   else if($people['xppor'] <= 30000){
	echo "34";
   }
   else if($people['xppor'] <= 31750){
	echo "35";
   }
   else if($people['xppor'] <= 33900){
	echo "36";
   }
   else if($people['xppor'] <= 33050){
	echo "37";
   }
   else if($people['xppor'] <= 34050){
	echo "38";
   }
   else if($people['xppor'] <= 35350){
	echo "39";
   }
   else if($people['xppor'] <= 36350){
	echo "40";
   }
   else if($people['xppor'] <= 28450){
	echo "41";
   }
   else if($people['xppor'] <= 29500){
	echo "42";
   }
   else if($people['xppor'] <= 30850){
	echo "44";
   }
   else if($people['xppor'] <= 40000){
	echo "44";
   }
   else if($people['xppor'] <= 41750){
	echo "45";
   }
   else if($people['xppor'] <= 44900){
	echo "46";
   }
   else if($people['xppor'] <= 44050){
	echo "47";
   }
   else if($people['xppor'] <= 44050){
	echo "48";
   }
   else if($people['xppor'] <= 45450){
	echo "49";
   }
   else if($people['xppor'] <= 46450){
	echo "50";
   }
    else if($people['xppor'] <= 48550){
	echo "51";
   }
   else if($people['xppor'] <= 49500){
	echo "52";
   }
   else if($people['xppor'] <= 5000){
	echo "53";
   }
   else if($people['xppor'] <= 50500){
	echo "55";
   }
   else if($people['xppor'] <= 51750){
	echo "55";
   }
   else if($people['xppor'] <= 55900){
	echo "56";
   }
   else if($people['xppor'] <= 55050){
	echo "57";
   }
   else if($people['xppor'] <= 55050){
	echo "58";
   }
   else if($people['xppor'] <= 55550){
	echo "59";
   }
   else if($people['xppor'] <= 56550){
	echo "60";
   }
   else if($people['xppor'] >= 56560){
	echo "61";
   }
?></border-t2>
	</a>
	<?php endforeach;}?>
	

</div>


<div class="right-content-rank">
<p style="font-size: 18px;margin-left: 10px;padding: 10px;color: #fff;">Usuarios vip's</p>

<?php
$peoplet = $coment['id'];
$peoples = DBRead( 'user', "WHERE id and vip = 1 ORDER BY id DESC LIMIT 2" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>  

<a href="profile.php?id=<?php echo $people['id'];?>">
	<li class="amigos-seguir2">
	<img src="/static/img/avatar/<?php echo $people['photo'] ?>" class="avatar"/>
	<p><?php
	$str2 = nl2br( $people['user'] ); 
	$len2 = strlen( $str2 );
	$max2 = 50;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p>
	</li>
	<border-t2 style="position: relative;top:-50px;float:right; right: 10px;"><?php 
if($people['xppor'] <= 50){
 echo "1";
}
   else if($people['xppor'] <= 150){
	echo "2";
   }
   else if($people['xppor'] <= 500){
	echo "3";
   }
   else if($people['xppor'] <= 850){
	echo "4";
   }
   else if($people['xppor'] <= 1000){
	echo "5";
   }
   else if($people['xppor'] <= 1750){
	echo "6";
   }
   else if($people['xppor'] <= 2900){
	echo "7";
   }
   else if($people['xppor'] <= 3050){
	echo "8";
   }
   else if($people['xppor'] <= 4150){
	echo "9";
   }
   else if($people['xppor'] <= 5250){
	echo "10";
   }
   else if($people['xppor'] <= 6150){
 echo "10";
}
   else if($people['xppor'] <= 7150){
	echo "11";
   }
   else if($people['xppor'] <= 8500){
	echo "12";
   }
   else if($people['xppor'] <= 9850){
	echo "13";
   }
   else if($people['xppor'] <= 10000){
	echo "14";
   }
   else if($people['xppor'] <= 11750){
	echo "15";
   }
   else if($people['xppor'] <= 12900){
	echo "16";
   }
   else if($people['xppor'] <= 1360){
	echo "17";
   }
   else if($people['xppor'] <= 14150){
	echo "18";
   }
   else if($people['xppor'] <= 15250){
	echo "19";
   }
   else if($people['xppor'] <= 16250){
	echo "20";
   }
    else if($people['xppor'] <= 17250){
	echo "21";
   }
   else if($people['xppor'] <= 18500){
	echo "22";
   }
   else if($people['xppor'] <= 19850){
	echo "23";
   }
   else if($people['xppor'] <= 20000){
	echo "24";
   }
   else if($people['xppor'] <= 21750){
	echo "25";
   }
   else if($people['xppor'] <= 22900){
	echo "26";
   }
   else if($people['xppor'] <= 23050){
	echo "27";
   }
   else if($people['xppor'] <= 24050){
	echo "28";
   }
   else if($people['xppor'] <= 25250){
	echo "29";
   }
   else if($people['xppor'] <= 26250){
	echo "30";
   }
    else if($people['xppor'] <= 27350){
	echo "31";
   }
   else if($people['xppor'] <= 28500){
	echo "33";
   }
   else if($people['xppor'] <= 29850){
	echo "33";
   }
   else if($people['xppor'] <= 30000){
	echo "34";
   }
   else if($people['xppor'] <= 31750){
	echo "35";
   }
   else if($people['xppor'] <= 33900){
	echo "36";
   }
   else if($people['xppor'] <= 33050){
	echo "37";
   }
   else if($people['xppor'] <= 34050){
	echo "38";
   }
   else if($people['xppor'] <= 35350){
	echo "39";
   }
   else if($people['xppor'] <= 36350){
	echo "40";
   }
   else if($people['xppor'] <= 28450){
	echo "41";
   }
   else if($people['xppor'] <= 29500){
	echo "42";
   }
   else if($people['xppor'] <= 30850){
	echo "44";
   }
   else if($people['xppor'] <= 40000){
	echo "44";
   }
   else if($people['xppor'] <= 41750){
	echo "45";
   }
   else if($people['xppor'] <= 44900){
	echo "46";
   }
   else if($people['xppor'] <= 44050){
	echo "47";
   }
   else if($people['xppor'] <= 44050){
	echo "48";
   }
   else if($people['xppor'] <= 45450){
	echo "49";
   }
   else if($people['xppor'] <= 46450){
	echo "50";
   }
    else if($people['xppor'] <= 48550){
	echo "51";
   }
   else if($people['xppor'] <= 49500){
	echo "52";
   }
   else if($people['xppor'] <= 5000){
	echo "53";
   }
   else if($people['xppor'] <= 50500){
	echo "55";
   }
   else if($people['xppor'] <= 51750){
	echo "55";
   }
   else if($people['xppor'] <= 55900){
	echo "56";
   }
   else if($people['xppor'] <= 55050){
	echo "57";
   }
   else if($people['xppor'] <= 55050){
	echo "58";
   }
   else if($people['xppor'] <= 55550){
	echo "59";
   }
   else if($people['xppor'] <= 56550){
	echo "60";
   }
   else if($people['xppor'] >= 56560){
	echo "61";
   }
?></border-t2>
	</a>
	
	<?php endforeach;?>
	

</div>


<div class="pensando">
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

<div class="postagens-perfil relative">
<div class="space"></div>
<div id="flash"></div>
<div id="show"></div>


<?php
$coments = DBRead( 'post', "WHERE id and tipo = 1 ORDER BY id DESC" );
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
$coments = DBRead( 'post', "WHERE id and tipo = 2 ORDER BY id DESC" );
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
$coments = DBRead( 'post', "WHERE id and tipo = 4 ORDER BY id DESC" );
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
$coments = DBRead( 'post', "WHERE id and tipo = 10 ORDER BY id DESC" );
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
                                                    Compartilhou o <a style="color:#cc4f54;" href="watch.php?id=<?php echo $people4['id']; ?>"><?php echo $people4['nome']; ?></a> de <?php echo $people3['nome']; ?>
                                                    <div class="player center content top border shadow">
	<video id="playerwatchpri<?php echo $coment['id']; ?>" preload="metadata" src="<?php echo $people4['link'];?>"> </video>
    <div id="player<?php echo $coment['id']; ?>">
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


<div id="current<?php echo $coment['id']; ?>" class="progress<?php echo $coment['id']; ?> border">
<div id="defaultBar<?php echo $coment['id']; ?>">
</div>
<div id="progressBar<?php echo $coment['id']; ?>" class="progressatual">
<div id="button" class="button-progress border-tat">
    </div>
</div>
</div>
</div>


</div>
    </div>
</div>
<style>
#playerwatchpri<?php echo $coment['id']; ?>{
    width: 100%;
    height: 100%;
    top: 0;
    position: absolute;
    z-index: 0;
    background-color: #000;
    cursor: pointer;
}
.progress<?php echo $coment['id']; ?>{
    width: 2px;
    height: 90%;
    background: rgba(0,0,0,.50);
    position: relative;
    padding-left: 5px;
    left: 12px;
    top: 9px;
    cursor: pointer;
    -webkit-transition: all 0.4s; /* Safari */
    transition: all 0.4s;
}

.progressatual<?php echo $coment['id']; ?>{
    width: 2px;
    height: 100%;
    background: linear-gradient(to left, rgb(162, 46, 46), rgba(41, 128, 185,0));
    position: absolute;
    padding-left: 5px;
    left: 0px;
    top: 0px;
    cursor: pointer;
    -webkit-transition: all 0.4s; /* Safari */
    transition: all 0.4s;
}

</style>
													</p>
                                                    <script type="text/javascript">
document.getElementById("playerwatchpri<?php echo $coment['id']; ?>").onclick = function() {vidplay()};
document.getElementById("buttonpp").onclick = function() {vidplay()};
document.getElementById("buttonpmp").onclick = function() {vidplay()};
document.getElementById("playerwatchpri<?php echo $coment['id']; ?>").onclick = function() {vidplay()};
document.getElementById("player<?php echo $coment['id']; ?>").onmouseover = function() {showplayer()};
document.getElementById("current<?php echo $coment['id']; ?>").onmouseover = function() {showplayer()};
document.getElementById("defaultBar<?php echo $coment['id']; ?>").onmouseover = function() {showplayer()};
document.getElementById("progressBar<?php echo $coment['id']; ?>").onmouseover = function() {showplayer()};
document.getElementById("button").onmouseover = function() {showplayer()};
document.getElementById("buttonpp").onclick = function() {showplayer()};
document.getElementById("mute").onclick = function() {mute()};
document.getElementById("muted").onclick = function() {mute()}
document.getElementById("fullscreenico").onclick = function() {goFullscreen()};
document.getElementById("fullscreenedico").onclick = function() {goFullscreen()}
document.getElementById("fullscreenedico").onclick = function() {goFullscreen()};

var video<?php echo $coment['id']; ?> = document.getElementById("playerwatchpri<?php echo $coment['id']; ?>");
var bar<?php echo $coment['id']; ?> = document.getElementById("current<?php echo $coment['id']; ?>");
bar<?php echo $coment['id']; ?>.addEventListener("click", seek);
var progressBar<?php echo $coment['id']; ?> = document.getElementById("progressBar<?php echo $coment['id']; ?>");


function seek(e) {
var percent = e.offsetY / this.offsetHeight;
video<?php echo $coment['id']; ?>.currentTime = percent * video.duration;
progressBar<?php echo $coment['id']; ?>.value = percent / 100;
}

video<?php echo $coment['id']; ?>.addEventListener('progress', function() {
var bufferedEnd = video.buffered.end(video.buffered.length - 1);
var duration =  video.duration;
if (duration >= 0) {
      document.getElementById('defaultBar<?php echo $coment['id']; ?>').style.height = ((bufferedEnd / duration)*100) + "%";
}
});

video<?php echo $coment['id']; ?>.addEventListener('timeupdate', function() {
var duration =  video.duration;
if (duration > 0) {
	var bufferedEnd = video.buffered.end(video.buffered.length - 1);
document.getElementById('progressBar<?php echo $coment['id']; ?>').style.height = ((video.current<?php echo $coment['id']; ?>Time / duration)*100) + "%";

var videotimer = document.getElementById('defaultBar<?php echo $coment['id']; ?>').style.height = ((bufferedEnd / duration)*100) + "%";
video<?php echo $coment['id']; ?>.ontimeupdate = function() {myFunction()};

}
});	

function vidplay() {	
if (video<?php echo $coment['id']; ?>.paused) {
video<?php echo $coment['id']; ?>.play();
document.getElementById("buttonpmp").style.display = "block";
document.getElementById("buttonpp").style.display = "none";
} else {	
video<?php echo $coment['id']; ?>.pause();
document.getElementById("buttonpp").style.display = "block";
document.getElementById("buttonpmp").style.display = "none";
}
}

function skip(value) {
var video<?php echo $coment['id']; ?> = document.getElementById("playerwatchpri<?php echo $coment['id']; ?>");
video<?php echo $coment['id']; ?>.currentTime += value;
video<?php echo $coment['id']; ?>.play();
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
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current<?php echo $coment['id']; ?> working methods
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

document.getElementById("playerwatchpri<?php echo $coment['id']; ?>").addEventListener('timeupdate', function() {
var video = document.getElementById("playerwatchpri<?php echo $coment['id']; ?>");
	var nt = video.current<?php echo $coment['id']; ?>Time * (100 / video.duration);
	var curmins = Math.floor(video.current<?php echo $coment['id']; ?>Time / 60);
	var cursecs = Math.floor(video.current<?php echo $coment['id']; ?>Time - curmins * 60);
	var durmins = Math.floor(video.duration / 60);
	var dursecs = Math.floor(video.duration - durmins * 60);
	if(cursecs < 10){ cursecs = "0"+cursecs; }
	if(dursecs < 10){ dursecs = "0"+dursecs; }
	if(curmins < 10){ curmins = "0"+curmins; }
	if(durmins < 10){ durmins = "0"+durmins; }
});

var timeout;
document.getElementById("playerwatchpri<?php echo $coment['id']; ?><?php echo $coment['id']; ?>").onmousemove = function(){
  clearTimeout(timeout);
  timeout = setTimeout(function(){
document.getElementById("playerwatchpri<?php echo $coment['id']; ?>").style.cursor = "none";	
document.getElementById("player<?php echo $coment['id']; ?>").style.opacity = "0";
  }, 2000);
document.getElementById("playerwatchpri<?php echo $coment['id']; ?>").style.cursor = "auto";
document.getElementById("player<?php echo $coment['id']; ?>").style.opacity = "1";		
document.getElementById("current<?php echo $coment['id']; ?>").style.display = "block";
document.getElementById("currtime").style.display = "block";
}
function showplayer(){
document.getElementById("player<?php echo $coment['id']; ?>").style.opacity = "1";	 	
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