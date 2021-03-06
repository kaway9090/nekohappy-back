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
<body class="homeback">
    <!-- Header -->
<div class="header-baixo flex">
<img src="/static/img/coins.png" class="coins"/>
<span class="coins-text"><?php echo $user['coins'];?></span>
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
</a>
</div>
</div>

<!-- End header -->

<!-- Feed -->

<div class="feed-not flex center">

<div class="cardperfil left">
<div class="cover"></div>
<a href="profile.php?id=<?php echo $user['id'];?>"><img src="/static/img/avatar/<?php echo $user['photo'];?>" class="photoavatar"/></a>
<a class="hovercat" href="profile.php?id=<?php echo $user['id'];?>"><span class="nomecard"><?php echo $user['nome'];?> <?php echo $user['sobname'];?></span></a>
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

<div class="postagens relative">
<div class="space"></div>
<div id="flash"></div>
<div id="show"></div>

<?php
$coments = DBRead( 'post', "WHERE id ORDER BY id DESC" );
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

    
<div class="people-status-div">
<li class="li-status">
									<ul class="img-name-ul">

										<li class="thumb-img">
										<a href="#"><img src="static/img/avatar/<?Php echo $people['photo'];?>" alt="<?php echo $people['nome']?> <?php echo $people['sobname']?>" width="40" height="40"></a>
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
													<p>
                                                    <?php echo $coment['texto']?>
													</p>
											</article>
									</div> <!-- End User Status -->
									
									<div class="people-reaction-activity">
											<ul class="r-activity-list">
												<li><span class="fb_icon like"></span><a href="#">Curtir</a></li>
												<li><span class="fb_icon share"></span><a href="#">Compartilhar</a></li>
											</ul>
									</div> <!-- End People reaction Activity -->
								</li>
					</div>


    <?php endforeach;endforeach;?>
    
</div>

</div>



</div>


</div>

<!-- End feed -->


</body>
</html>
