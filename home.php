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

<html>
<body class="homer">


<div class="idav-header flex">

<div class="idav-a center flex">


<div class="left-a-idav flex">
<a href="/"><button class="buttons-left-a-idav">
<svg enable-background="new 0 0 48 48" height="20px" fill="#fff" version="1.1" viewBox="0 0 48 48" width="20px" style="top: -2px; position: relative;" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Expanded"><g><g><path d="M42,48H28V35h-8v13H6V27c0-0.552,0.447-1,1-1s1,0.448,1,1v19h10V33h12v13h10V28c0-0.552,0.447-1,1-1s1,0.448,1,1V48z"/></g><g><path d="M47,27c-0.249,0-0.497-0.092-0.691-0.277L24,5.384L1.691,26.723c-0.399,0.381-1.032,0.368-1.414-0.031     c-0.382-0.399-0.367-1.032,0.031-1.414L24,2.616l23.691,22.661c0.398,0.382,0.413,1.015,0.031,1.414     C47.526,26.896,47.264,27,47,27z"/></g><g><path d="M39,15c-0.553,0-1-0.448-1-1V8h-6c-0.553,0-1-0.448-1-1s0.447-1,1-1h8v8C40,14.552,39.553,15,39,15z"/></g></g></g></svg>
</button>
</a>
<button class="buttons-left-a-idav">Animes</button>
</div>

<div class="right-a-idav flex">
<input type="text" class="search-idav" placeholder="Pesquisar usuários e animes"/>
<button class="btn-s-idav">
<svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#929292" id="icon-111-search"><path d="M19.4271164,21.4271164 C18.0372495,22.4174803 16.3366522,23 14.5,23 C9.80557939,23 6,19.1944206 6,14.5 C6,9.80557939 9.80557939,6 14.5,6 C19.1944206,6 23,9.80557939 23,14.5 C23,16.3366522 22.4174803,18.0372495 21.4271164,19.4271164 L27.0119176,25.0119176 C27.5621186,25.5621186 27.5575313,26.4424687 27.0117185,26.9882815 L26.9882815,27.0117185 C26.4438648,27.5561352 25.5576204,27.5576204 25.0119176,27.0119176 L19.4271164,21.4271164 L19.4271164,21.4271164 Z M14.5,21 C18.0898511,21 21,18.0898511 21,14.5 C21,10.9101489 18.0898511,8 14.5,8 C10.9101489,8 8,10.9101489 8,14.5 C8,18.0898511 10.9101489,21 14.5,21 L14.5,21 Z" id="search"/></g></g></svg>
</button>

<div id="box-s-h">
		    <ul class="src">
			</ul>
		  </div>
	  <script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/js-all.js" type="text/javascript"></script>
			<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/js-all.js" type="text/javascript"></script>

</div>

<div class="center-a-idav flex center">

<div class="avatar-idav">
<img src="static/img/avatar/<?php echo $user['photo'];?>">
</div>

<button class="buttons-left-a-idav-32">
<svg id="Layer_1" style="enable-background:new 0 0 512 512;height: 22px; width: 22px; top: 0px; left: -1px; position: relative;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
.st0{fill:none;stroke:#fff;stroke-width:14;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
</style><path class="st0" d="M105,254c-9.9,6.4-33.8,21.4-43.7,27.8c-1.4,0.9-2.7,1.9-4.6,3.2c103.3,58.3,206.1,116.2,309.3,174.4  c0.4-6.1,0.8-11.4,1.1-16.7c1.7-28.2,3.3-56.3,5.2-84.5c0.2-3.2,1.3-6.6,2.9-9.3c20.3-34.6,40.8-69.2,61.2-103.7  c16.2-27.4,22.4-56.8,16.3-88.2c-4.6-23.8-12.8-41.3-27.9-58"/><path class="st0" d="M407.3,81.4c-0.3-0.2-0.5-0.4-0.8-0.6"/><path class="st0" d="M387,68.3c-34.9-18.6-71.6-20.6-109.3-6.6c-29.9,11.1-51.9,31.5-67.8,59c-2,3.5-4.1,7-6.1,10.5"/><path class="st0" d="M190.5,153.7c-13.5,22.9-27.1,45.7-40.7,68.5c-1.5,2.5-3.7,4.8-6.2,6.4c-11.6,7.5-23.2,15-34.7,22.5"/><path class="st0" d="M155.5,427.1c0.5,0.7,1.1,1.4,1.6,2.1"/><path class="st0" d="M176.4,443.6c21.8,8.8,48.5,0.7,60.8-20.2c-28.2-15.9-56.1-31.6-83.9-47.3c-6.1,9.3-7.9,20.5-6,31.2"/></svg></button>



<button class="buttons-left-a-idav-32">
<svg fill="#fff" style="height: 20px; width:20px; position: relative; top: -1px;" id="Layer_1" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M21.485,10.499l0.365-0.98l-1.042-2.515l-0.951-0.434l-1.101,0.367l-0.275-0.086c-0.358-0.44-0.763-0.844-1.206-1.204  L17.189,5.37l0.367-1.102l-0.434-0.951l-2.515-1.042l-0.979,0.366l-0.52,1.039l-0.256,0.134c-0.568-0.059-1.14-0.06-1.704-0.002  l-0.256-0.133l-0.519-1.037L9.394,2.275L6.878,3.317L6.444,4.268l0.367,1.1L6.724,5.644C6.284,6.002,5.879,6.407,5.52,6.85  L5.244,6.936L4.143,6.569L3.192,7.003L2.15,9.519l0.365,0.98l1.039,0.52l0.134,0.256c-0.059,0.567-0.059,1.139-0.002,1.704  l-0.133,0.256l-1.037,0.519l-0.365,0.98l1.042,2.515l0.951,0.434l1.1-0.366l0.275,0.086c0.358,0.44,0.763,0.844,1.206,1.204  l0.086,0.275l-0.367,1.102l0.435,0.951l2.515,1.042l0.98-0.366l0.519-1.038l0.256-0.134c0.568,0.059,1.14,0.059,1.705,0.001  l0.255,0.134l0.519,1.037l0.979,0.365l2.515-1.042l0.434-0.951l-0.366-1.1l0.086-0.275c0.441-0.359,0.845-0.764,1.204-1.206  l0.275-0.086l1.102,0.367l0.951-0.434l1.042-2.516l-0.365-0.98l-1.039-0.52l-0.134-0.255c0.059-0.567,0.059-1.139,0.002-1.705  l0.133-0.256L21.485,10.499z M19.766,10.324l-0.403,0.772l0.017,0.142c0.07,0.586,0.07,1.182-0.002,1.771l-0.017,0.143l0.404,0.773  l0.98,0.49l0.111,0.298l-0.764,1.843l-0.289,0.132l-1.04-0.346l-0.832,0.261l-0.089,0.113c-0.365,0.467-0.787,0.889-1.251,1.254  l-0.113,0.088l-0.261,0.832l0.346,1.039l-0.132,0.289l-1.843,0.764l-0.298-0.111l-0.49-0.979l-0.772-0.404l-0.142,0.017  c-0.585,0.07-1.181,0.07-1.772-0.002l-0.142-0.017l-0.773,0.404l-0.49,0.981l-0.298,0.111l-1.843-0.763L7.436,19.93l0.346-1.04  l-0.261-0.832l-0.113-0.089c-0.468-0.367-0.89-0.788-1.254-1.252l-0.088-0.113l-0.831-0.261L4.196,16.69l-0.289-0.132l-0.764-1.843  l0.111-0.298L4.1,13.993l0.151-0.101l0.386-0.738L4.62,13.012c-0.07-0.586-0.07-1.182,0.002-1.771l0.017-0.143l-0.404-0.773  l-0.98-0.49L3.143,9.537l0.764-1.843l0.289-0.132l1.04,0.346l0.832-0.261l0.089-0.113C6.523,7.066,6.944,6.645,7.408,6.28  l0.113-0.089l0.26-0.832L7.436,4.322l0.132-0.289l1.843-0.764L9.709,3.38l0.49,0.979l0.772,0.404l0.142-0.017  c0.586-0.07,1.182-0.07,1.771,0.002l0.143,0.017L13.8,4.36l0.491-0.981l0.298-0.111l1.843,0.764l0.132,0.289l-0.346,1.04l0.26,0.832  l0.113,0.089c0.467,0.366,0.889,0.787,1.254,1.252l0.088,0.113l0.832,0.261l1.039-0.346l0.289,0.132l0.764,1.843l-0.111,0.298  L19.766,10.324z"/><path d="M11.994,6.998c-2.804,0-5.085,2.277-5.085,5.077s2.281,5.077,5.085,5.077s5.085-2.277,5.085-5.077  S14.798,6.998,11.994,6.998z M11.994,16.228c-2.294,0-4.16-1.863-4.16-4.153s1.866-4.153,4.16-4.153s4.16,1.863,4.16,4.153  S14.288,16.228,11.994,16.228z"/></svg>    
<span style="position: relative; top: -5px; font-size: 15px;"></span></button>
</div>

</div>


<div class="logo2">
<img src="static/img/logo.gif" style="display: none;width: 120px; height: 120px; float: right; position: relative;"/>
</div>


</div>



<div class="main-idav center">

<div class="alright-xandeco">
<style>
.cover-xandeco{
    background-image: url(/static/img/cover/<?php echo $user['fotoback']; ?>);
    background-size: cover;
    width: 100%;
    height: 50%;
}
</style>
<div class="cover-xandeco"></div>
<div class="center">
<a href="profile.php?id=<?php echo $user['id']; ?>"><p style="text-align:center;"><img src="/static/img/avatar/<?php echo $user['photo'];?>" class="avatar" style="height: 50px; width: 50px; border: 2px solid #c1c2d1; position: relative; top: -30px;"/></p></a>
</div>
<a href="profile.php?id=<?php echo $user['id']; ?>"><p style="color: #fff; position: relative; top: -20px;text-align: center; font-size: 20px;"><?php echo $user['user']; ?></p></a>
</div>

<div class="xandeco-post center">

<div class="postagem01 flex">
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="avatar" style="height: 50px; width: 50px; margin-top: 10px; position: relative;"/>
<form name="form" class="formulario" action="" method="post" enctype="multipart/form-data">
<textarea id="content" style="box-shadow: 1px 1px 1px #7f829f;width: 30vw;resize: none; height: 70px; right: -20px;float: right:; top: 0px; position: relative; border: none;padding: 10px; border-radius: 2px;background: #fff;" placeholder="Compartilhe com seus seguidores">
</textarea>
<div class="post-bottom">
<button name="publish" class="publish">
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

<div class="other-post">

<style>

.other-post{
    top: 85px;
}

#post-id1{
    width: 100%;
    height: auto;
    position: relative;
    margin: 0px auto;
    margin-top: 35px;
}




#texto-people1{
    padding: 10px;
    top: 0px;
    position: relative;
}

#texto-people1 .imagem{
    width: 100%;
    max-height: 250px;
}



#user-people1{
    padding: 10px;
    border-bottom: 1px solid #7f829f;
    top: 0px;
    position: relative;
}

.batata{
    color: #7f829f
}

.batata:hover{
    text-decoration: underline;
}

#emoticon{
    height: 20px;
    position: relative;
    top: 3px;
}
</style>


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
<div id="post-id1">


<style>
.center-id{
    background: #fff;
    width: 30vw;
    height: auto;
    position: relative;
    margin: 0px auto;
    margin-top: 10px;
    box-shadow: 1px 1px 1px #7f829f;
}

#centerid<?php echo $coment['id']; ?>{
    display: block;
}

</style>

<div class="center-id" id="centerid<?php echo $coment['id']; ?>">
<div id="left-<?php echo $coment['id']; ?>">
<div class="div<?php echo $coment['id']; ?>">
<a><img id="img<?php echo $coment['id']; ?>" src="/static/img/avatar/<?php echo $people['photo']; ?>"/>
<div class="hover<?php echo $coment['id']; ?>">
<center><img src="/static/img/avatar/<?php echo $people['photo']; ?>" class="avatar" style="position: relative; top: 5px; height: 55px; width: 55px;"/>
<img src="/static/img/cover/<?php echo $people['fotoback']; ?>" style="width:100%; position: absolute; height: 100%;left: 0;"/>
</center>
</div></a>
</div>
<style>

.div<?php echo $coment['id']; ?>{
    opacity: 1;
}

#left-<?php echo $coment['id']; ?>{
    float: left;
}

.hover<?php echo $coment['id']; ?>{
    width: 200px;
    height: 90px;
    background: #fff;
    position: absolute;
    margin-top: 20px;
    top: -90px;
    left: -70px;
    z-index: 20000000;
    box-shadow: 1px 1px 1px #7f829f;
    opacity: 0;
    -webkit-transition: opacity .15s ease-in-out;
        -moz-transition: opacity .15s ease-in-out;
        -ms-transition: opacity .15s ease-in-out;
        -o-transition: opacity .15s ease-in-out;
        transition: opacity .15s ease-in-out;
    border-radius: 5px;
}

#img<?php echo $coment['id']; ?>{
    display: block;
    width: 50px;
    height: 50px;
    top: 20px;
    float: left;
    left: -60px;
    position: absolute;
    cursor: pointer;
    z-index: 30000000;
    border-radius: 50%;
}



#img<?php echo $coment['id']; ?>:hover + .hover<?php echo $coment['id']; ?>{
    opacity: 1;
    z-index: 100000000000000000;
}
</style>


</div>
<p id="user-people1">
<a href="profile.php?id=<?php echo $people['id'];?>" class="batata"><?php echo $people['user'];?><a> publicou uma postagem.
<?php if($user['id'] == $people['id']){ ?>
<button id="button2<?php echo $coment['id']; ?>" style="cursor: pointer; float: right; right: 5px; position: relative; border: none; background: none;">
<svg enable-background="new 0 0 48 48" height="20px" version="1.1" viewBox="0 0 48 48" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Expanded"><g><g><path d="M41,48H7V7h34V48z M9,46h30V9H9V46z"/></g><g><path d="M35,9H13V1h22V9z M15,7h18V3H15V7z"/></g><g><path d="M16,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C17,40.553,16.553,41,16,41z"/></g><g><path d="M24,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C25,40.553,24.553,41,24,41z"/></g><g><path d="M32,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C33,40.553,32.553,41,32,41z"/></g><g><rect height="2" width="48" y="7"/></g></g></g></svg>
</button>

<script>
  $('#button2<?php echo $coment['id']; ?>').click(function(){
	  $("#centerid<?php echo $coment['id']; ?>").fadeOut(600);
				var i = setInterval(function () {
				clearInterval(i);
				// O código desejado é apenas isto:
				}, 1300);
				$.post('request.php?delete=<?php echo $coment['id'];?>', function (html) {
				$('#info').html(html);
				});
    });
</script>

<?php } ?>
</p>

<p id="texto-people1" style="word-wrap: break-word;">
<?php 
                                                $emotions = array(':)', ':@', '8)', ':3', ':(', ';)', ':O', ':o', ':P', ':p', '<3', 'fuck', 'Fuck', 'FUCK');
                                                $imgs = array(
                                                    '<img id="emoticon" src="/static/img/emotions/nice.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/angry.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/cool.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/sad.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/right.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/heart.png"/>',
                                                    '***',
                                                    '***',
                                                    '***'
                                                );
                                                $msg = str_replace($emotions, $imgs, $coment['texto']);
                                                echo $msg;
                                                ?>
</p>

<hr/>
<style>
.bottom-class-idav{
    width: 100%;
    position: relative;
    height: 40px;
    background: #eee;
}
</style>
<div class="bottom-class-idav flex">
<button id="button<?php echo $coment['id']; ?>" class="flex" style="z-index: 100000000;top: 0px;margin-left: 10px; cursor: pointer; position: relative; border: none; background: transparent;">
<svg id="Layer_1" style="height: 20px; width: 20px; position: relative; top: 0px; left: 2px;" style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M24,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S26.2,16,24,16z M24,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S25.1,22,24,22z"/><path d="M13,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S15.2,16,13,16z M13,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S14.1,22,13,22z"/><path d="M35,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S37.2,16,35,16z M35,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S36.1,22,35,22z"/><path d="M43,6H5C3.3,6,2,7.3,2,9v22c0,1.7,1.3,3,3,3h11.5l7.5,8.5l7.5-8.5H43c1.7,0,3-1.3,3-3V9C46,7.3,44.7,6,43,6z M44,31   c0,0.6-0.4,1-1,1H30.5L24,39.5L17.5,32H5c-0.6,0-1-0.4-1-1V9c0-0.6,0.4-1,1-1h38c0.6,0,1,0.4,1,1V31z"/></g></svg>
</button>





</div>



</div>

</div>



<style>
#info{
    width: 100%;
    height: 100%;
    position: fixed;
    background: rgba(0,0,0,.50);
    top: 0;
    left: 0;
    z-index: 30000000000;
    display: none;
}
#closeinfo{
    position: relative;
    top: 0vw;
    background: transparent;
    border: none;
    float: right;
    right: 1vw;
}
</style>

<div id="info">

</div>

<script>
  $('#button<?php echo $coment['id']; ?>').click(function(){
	  $("#info").fadeIn(600);
				var i = setInterval(function () {
				clearInterval(i);
                
				// O código desejado é apenas isto:
			    $("#info").fadeIn(200);
				}, 1300);
				$.post('request.php?info=<?php echo $coment['id'];?>', function (html) {
				$('#info').html(html);
				});
    });
</script>

    <?php endforeach;endforeach;?>





<div class="xandeco-sugeridos">

    <p style="top: 0; position: relative; left: 0; color: #fff; top: 7px;left: 5px;font-size: 18px; margin-left: 5px;">Suguestões<p>

    <?php
$estadoeu = $user['estado'];
$peoples = DBRead( 'user', "WHERE id <> '".$user['id']."'  and estado = '".$user['estado']."'  ORDER BY rand() LIMIT 10" );
if (!$peoples){
?>

<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id <> '".$user['id']."'  ORDER BY rand() LIMIT 10" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>

<a href="profile.php?id=<?php echo $people['id'];?>">
<li>
<img src="/static/img/avatar/<?php echo $people['photo'];?>" class="avatar" style="margin-left: 10px; height: 30px; width: 30px; top: 5px;border: 2px solid #c1c2d1; position: relative;"/>
<p><?php echo $people['user'];?></p>
</li>
	<border-t3 style="position: relative;top:-30px;float:right; right: 10px;z-index: 2000;"><?php 
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
?></border-t3>
	</a>

	<?php endforeach; ?>


<?php } else{
	foreach ($peoples as $people): ?>
	<a href="profile.php?id=<?php echo $people['id'];?>">
    <li>
    <img src="/static/img/avatar/<?php echo $people['photo'];?>" class="avatar" style="margin-left: 10px; height: 30px; width: 30px; top: 5px;border: 2px solid #c1c2d1; position: relative;"/>
    <p><?php
	$str2 = nl2br( $people['user'] ); 
	$len2 = strlen( $str2 );
	$max2 = 7;
   if( $len2 <= $max2 )
   echo $str2;
	else    
   echo substr( $str2, 0, $max2 ) . '...'?></p>
   <border-t3 style="position: relative;top:-46px;float:right; right: 10px;z-index: 2000;"><?php 
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
?></border-t3>
    </li>
	
	</a>
    <?php endforeach;}?>
    


</div>

</div>

<img src="lay.png" width= "1200px" style="display: none ;top: 50px; position: relative;";/>
</body>
</html>