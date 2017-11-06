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
}
?>
<head>
<title>NekoHappy</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<html>
<body class="a412">
<div class="headers clean shadow">
<div class="flex">
    <div class="flex left tam2 center">
    <span class="a2 logos" style="bottom:-1vw;margin-top:5px;">NekoHappy</span>
    <input type="text" placeholder="Buscar no NekoHappy" class="buscar"/>
    </div>
<div class="flex right tam center">
    <img class="flex relative avatar" id="avatar" src="/static/img/avatar/<?php echo $user['photo'];?>"/>
    <div id="option">
    <div class="top-option borb">
    <span class="contas relative">Conta</span>
    <span class="contas sair"><a href="logout.php">Sair</a></span>
    </div>
    </div>
</div>
</div>
<script type="text/javascript" src="/assets/js/pace.min.js"></script>
<script>
var option = document.getElementById('option');
var avatar = document.getElementById('avatar');
		$('#avatar').click(function(){
        var x = document.getElementById("option");
        if (x.style.display === "none") {
        x.style.display = "block";
         } else {
            x.style.display = "none";
        }
    });
    $('#option').on('mouseleave', function(){
        option.style = "display:none;";
});
</script>
</div>


<div class="flex center main">
<div class="flex left menu2">
<div id="userNav" class="homeSideNav" data-testid="left_nav_section_">


    <ul class="_bui _3-96">
        <li class="clearfix sideNavItem stat_elem" data-nav-item-id="100014273951381" data-type="type_user" data-pinned="1" id="navItem_100014273951381">
            <div class="buttonWrap">
            </div>
            <a data-testid="left_nav_item_Alexandre Silva" class="_5afe" data-gt="{&quot;bmid&quot;:&quot;100014273951381&quot;,&quot;count&quot;:&quot;0&quot;,&quot;count_details&quot;:&quot;&quot;,&quot;post_name_icon&quot;:&quot;&quot;,&quot;bookmark_type&quot;:&quot;type_self_timeline&quot;,&quot;rank&quot;:&quot;1&quot;,&quot;nav_section&quot;:&quot;userNav&quot;,&quot;sec_position&quot;:&quot;1&quot;,&quot;total&quot;:&quot;pinned&quot;}" title="Alexandre Silva" href="https://www.facebook.com/imxandeco?ref=bookmarks" draggable="false">
            <span class="imgWrap" data-testid="bookmark_icon_left_nav"><img class="_2qgu _54rt img" src="/static/img/avatar/<?php echo $user['photo']; ?> " alt="" draggable="false">
        </span><div dir="ltr" class="linkWrap noCount">Alexandre Silva</div>
    </a>
</li
></ul>


<ul class="_bui _3-96">
        <li class="clearfix sideNavItem stat_elem" data-nav-item-id="100014273951381" data-type="type_user" data-pinned="1" id="navItem_100014273951381">
            <div class="buttonWrap">
            </div>
            <a data-testid="left_nav_item_Alexandre Silva" class="_5afe" data-gt="{&quot;bmid&quot;:&quot;100014273951381&quot;,&quot;count&quot;:&quot;0&quot;,&quot;count_details&quot;:&quot;&quot;,&quot;post_name_icon&quot;:&quot;&quot;,&quot;bookmark_type&quot;:&quot;type_self_timeline&quot;,&quot;rank&quot;:&quot;1&quot;,&quot;nav_section&quot;:&quot;userNav&quot;,&quot;sec_position&quot;:&quot;1&quot;,&quot;total&quot;:&quot;pinned&quot;}" title="Alexandre Silva" href="https://www.facebook.com/imxandeco?ref=bookmarks" draggable="false">
            <span class="imgWrap" data-testid="bookmark_icon_left_nav"><img class="_2qgu _54rt img" src="/static/img/avatar/<?php echo $user['photo']; ?> " alt="" draggable="false">
        </span><div dir="ltr" class="linkWrap noCount">Alexandre Silva</div>
    </a>
</li
></ul>

</div>
</div>
<script>
    var option2 = document.getElementById('hoverperfil');
document.getElementById("avatarpos").onmouseover = function() {animacaomenupos()};
function animacaomenupos(){
document.getElementById("hoverperfil").style.display = "block";
}
$('#hoverperfil').on('mouseleave', function(){
        option2.style = "display:none;";
});
</script>
<div class="flex center post">
<div class="toppost">
<span class="relative">Publique algo <?php echo $user['user'];?></span>
</div>
<form  method="post" name="form" action="">
<textarea name="" id="content" placeholder="No que você está pensando?"></textarea>
<div class="bottompost">
<input type="submit" value="Publicar" name="submit" class="submit_button"/></input>
</div>
</form>
</div>



    <div class="overflow">
<div class="divulgacao">

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
</div>

<?php
$coments = DBRead( 'post', "WHERE id ORDER BY id DESC " );
if (!$coments)
echo '<div class="eoq"><p>Nenhuma postagem infelizmente.</p></div>';	
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

    <div class="eoq">
		<div class="toppostagempeople">
		<span class="relative quem"><a class="quemlink"><?php echo $people['user'];?></a></span>
		<img src="static/img/avatar/<?php echo $people['photo']; ?>" class="avatar_post postagemfoto"/>
		</div>
		<div class="conteudo">
		<p class="falar"><?php echo $coment['texto']; ?></p>
		</div>
    </div>
    <?php endforeach;endforeach;?>


<div class="space"></div>
<div id="flash"></div>
<div id="show"></div>

</div>
<script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(function() {
$(".submit_button").click(function() {
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
</div>



</div>

</body>
</html>