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
<script type="text/javascript" src="/assets/js/pace.min.js"></script>
<title>NekoHappy</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/assets/css/animate.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>
<html>

<body id="bood">
<div class="header-baixo flex">
<div class="header-top flex">
    <div class="background">
</div>
<div class="flex left center divbu">
    <img src="/static/img/logo.png" class="logost"/>
<input type="text" placeholder="Pesquise amigos ou página" class="buscart flex"/>
<button class="buscas">
    <span></span>
</button>
</div>
</div>

<div class="flex right center he">

    <div class="flex optionsnoti">
    <span class="world"></span>
    <span class="msg"></span>
    </div>
<a href="profile.php?id=<?php echo $user['id']?>">
<div class="avatar-and-name"><img src="static/img/avatar/<?php echo $user['photo'];?>" class="top-baixo-f"/>
<span class="a24"><?php echo $user['nome'];?></span>
</div>
<a href="logout.php">
<svg height="30px" style="margin-top: 10px;position: relative;right: 10px;" version="1.1" viewBox="0 0 24 24" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="miu" stroke="none" stroke-width="1"><g id="Artboard-1" transform="translate(-359.000000, -407.000000)"><g id="slice" transform="translate(215.000000, 119.000000)"/><path d="M360,408 L360,430 L375,430 L375,423.5 L374,423.5 L374,429 L361,429 L361,409 L374,409 L374,414.5 L375,414.5 L375,408 L360,408 Z M377.050253,415.464466 L377.757359,414.757359 L382,419 L377.757359,423.242641 L377.050253,422.535534 L380.087349,419.498437 L367.00472,419.498437 L367.00472,418.5 L380.085786,418.5 L377.050253,415.464466 Z" fill="#000000" id="common-logout-signout-exit-outline-stroke"/></g></g></svg>
</a>
</a>
</div>
</div>

<div class="main center flex">

<div class="cardperfil left">
<div class="cover"></div>
<a href="profile.php?id=<?php echo $user['id'];?>"><img src="/static/img/avatar/<?php echo $user['photo'];?>" class="photoavatar"/></a>
<a class="hovercat" href="profile.php?id=<?php echo $user['id'];?>"><span class="nomecard"><?php echo $user['user'];?></span></a>
<style>
    .nomecard{
        color: rgb(20, 23, 26);
        font-size: 20px;
        position: relative;
        top: -55px;
        left: 24px;
        height: 20px;
        cursor: pointer;
    }
    .hovercat{
        color: rgb(20, 23, 26);
        height: 20px;
    }
    .hovercat:hover{
        text-decoration: underline;
    }
    .photoavatar{
        height: 70px;
        width: 70px;
        border-radius: 50%;
        position: relative;
        top: -50px;
        left: 20px;
        border: 2px solid #fff;
    }
.cover{
    background-image: url(/static/img/cover/<?php echo $user['fotoback'];?>);
    height: 120px;
    background-size: cover;
}
</style>

</div>



<div class="container">
<div class="post flex">


<div class="postagem5 flex relative">
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="photoavatar2 relative"/>
<form style="width:100%;" name="form" action="" method="post" enctype="multipart/form-data">
<textarea type="text" id="content" placeholder="Em que estás a pensar?" class="postagem">
</textarea>
<div class="bottom-postagem">
<input name="arquivo" type="file" id="imga" style="display:none"/>
<label class="foto" for='imga'>
<div class="photo01"></div>
</label>
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
url: "action.php",
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

<div class="postagens relative" id="postagemm">
<div class="space"></div>
<div id="flash"></div>
<div id="show"></div>
    
<div class="saudacao">
    <p>
<?php
$hr = date(" H ");
if($hr >= 12 && $hr<18) {
$resp = "Boa tarde";}
else if ($hr >= 0 && $hr <12 ){
$resp = "Bom dia";}
else {
$resp = "Boa noite";}
echo "$resp";
echo ' ';
echo $user['user'];
echo '.';
?>
</p>
<?php
$hr = date(" H ");
if($hr >= 12 && $hr<18) {
$resp = "<img src='/static/img/tarde.png' class='saudaig'/>";}
else if ($hr >= 0 && $hr <12 ){
$resp = "<img src='/static/img/dia.png' class='saudaig'/>";}
else {
$resp = "<img src='/static/img/npoite.png' class='saudaig'/>";}
echo "$resp";
echo ' ';
echo '.';
?>
</div> 
<div id="postaerers">

</div>
    
</div>

</div>



</div>


<?php
$coments = DBRead( 'user', "WHERE id  <> '".$user['id']."' and estado = '".$user['estado']."' ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<div class="quemadicionar">
    <h1 class="h1quems">Amigos que estão perto de você</h1>
<?php
$coments = DBRead( 'user', "WHERE id  <> '".$user['id']."' and estado = '".$user['estado']."' ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$peoplet = $coment['id'];
$peoples = DBRead( 'user', "WHERE id = '".$peoplet."' ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>  
    <a href="profile.php?id=<?php echo $people['id']; ?>">
    <div class="pretos">
    <li class="borutomylove">
    <img src="/static/img/avatar/<?php echo $people['photo']; ?>" class="quemaddfoto"/>
    <p class="nombredelcabre"><?php echo $people['nome']; ?> - <?php echo $people['user']; ?></p>
    </li>
    </div>
    </a>
    <?php endforeach;endforeach;endforeach;?>
 </div>


</div>
<script type="text/javascript" src="assets/js/mod_xhr.js"></script>
<script type="text/javascript">
total_not 	 = document.getElementById('postaerers');
window.setInterval(function(){
    xhr.get('requestpost.php', function(total){
        total_not.innerHTML = total;
    });
    }, 100);
		</script>

</body>

</html>