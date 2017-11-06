<?php
require 'proezas.php';
$id = $_COOKIE['iduser'];
$login_cookie = $_COOKIE['iduser'];
	if (isset($_POST['save'])) {
		if ($_FILES["file"]["error"]>0) {
			echo "<script language='javascript' type='text/javascript'>alert('Tens de escolher uma foto...');</script>";
		}else{
            $n = rand (0, 10000000);
            $img = preg_replace('/[^\w\._]+/', '', $_FILES["file"]["name"]);

            move_uploaded_file($_FILES['file']['tmp_name'], "static/img/avatar/".$img);
			echo '';
			$xpadd = array('xppor' => $user['xppor'] + 150);
			DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );

			$query = "UPDATE neko_user SET `photo`='$img' WHERE `id`='$login_cookie'";
			$data = mysql_query($query);
			if ($data) {
				header("Location: profile.php?id=".$id);
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar a tua foto...');</script>";
			}
		}
    }
    if (isset($_POST['capa'])) {
		if ($_FILES["file"]["error"]>0) {
			echo "<script language='javascript' type='text/javascript'>alert('Tens de escolher uma foto...');</script>";
		}else{
			$n = rand (0, 10000000);
			$img = preg_replace('/[^\w\._]+/', '', $_FILES["file"]["name"]);

            move_uploaded_file($_FILES['file']['tmp_name'], "static/img/cover/".$img);
            echo '';
			$xpadd = array('xppor' => $user['xppor'] + 150);
			DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );

			$query = "UPDATE neko_user SET `fotoback`='$img' WHERE `id`='$login_cookie'";
			$data = mysql_query($query);
			if ($data) {
				header("Location: profile.php?id=".$id);
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar a tua foto...');</script>";
			}
		}
    }

    if (isset($_POST['background'])) {
		if ($_FILES["file"]["error"]>0) {
			echo "<script language='javascript' type='text/javascript'>alert('Tens de escolher uma foto...');</script>";
		}else{
			$n = rand (0, 10000000);
			$img = preg_replace('/[^\w\._]+/', '', $_FILES["file"]["name"]);

            move_uploaded_file($_FILES['file']['tmp_name'], "static/img/background/".$img);
            echo '';

			$query = "UPDATE neko_user SET `background`='$img' WHERE `id`='$login_cookie'";
			$data = mysql_query($query);
			if ($data) {
				header("Location: profile.php?id=".$id);
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar a tua foto...');</script>";
			}
		}
    }

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
?>
<html>
	<header>
    <title>NekoHappy - Configuração de perfil</title>
    <meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="static/img/app-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
		<style type="text/css">
			body{background-color: #fff;}
			h2{margin-top: 50px; text-align: center; color: #000; font-size: 28px;}
			form#perfil{display: block; margin: auto; text-align: center; width: 350px; margin-top: 20px; background-color: #FFF; box-shadow: 0 0 10px #666; border-radius: 5px;}
			input[type="submit"]{width: 100px; height: 25px; border: none; border-radius: 3px; background-color: #a22e2e; cursor: pointer; color: #FFF;}
			.kopy{color: #FFF; text-align: center; margin-top: 90px;}
            .altere{
                background: #fff;
                padding: 5px;
                position: relative;
                top: 50px;
                border-radius: 3px;
            }
		</style>
	</header>
	<body>

    <?php if(empty($user['background'])){
	echo '';
}
	else{?>
	<div class="background-cl41"></div>
<eooq></eooq>
<?php } ?>

<div class="header-scroll2 center">
<img src="/static/img/logo.png" class="logost"/>
<a href="profile.php?id=<?php echo $user['id']; ?>">
<img src="/static/img/avatar/<?php echo $user['photo'];?>" class="avatar header-av"/>
</a>
<div class="div-tag" id="taginfo">
<a class="user-photo-tag-header"><?php echo $user['user'];?></a>
<i class="coverino"></i>
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
var icon_not = document.getElementById('taginfo');
	icon_not.addEventListener('click', function(e){
	e.stopPropagation();
	menu.style.display = 'block';
});
	menu.addEventListener('click', function(e){
	e.stopPropagation();
	menu.style.display = 'block';
});
document.addEventListener('click', function(){
 				menu.style.display = 'none';
 			});
</script>
</div>

<div class="header-scroll center">
<a href="home.php" class="links-header-a">Página inicial</a>
<a href="profile.php?id=<?php echo $user['id'];?>" class="links-header-a  ativo">Perfil</a>
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
	margin-top: 90px;
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
.header-scroll{
	background-color: #a22e2e;
    height: 39px;
	width: 962px;
	position: relative;
	top: 41px;
}
.header-scroll2{
	background-color: #fff;
    height: 70px;
	width: 962px;
	position: relative;
	top: 20px;
	padding: 2px;
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
.user-photo-tag-header{
	color: #323232;
	font-size: 18px;
	left: 0px;
	top: 5px;
	position: relative;
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
.div-tag{
    width: auto;
    padding-left: 20px;
    padding-right: 10px;
    height: 30px;
    float: right;
    top: 20px;
    right: 10px;
    position: relative;
    cursor: pointer;
}
.div-tag:hover{
	background: #f5e1e1;
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
	height: 100%;
	position: fixed;
	background: rgba(121, 20, 20, 0.6);
}
.ativo{
	background: #f5e1e1;
	color: #000;
}
</style>    
        
             <style>
                .tabs{
                    width: 100%;
                    height: 39px;
                    background: #a22e2e;
                    border-radius: 0px;
                }
                .tabs a{
                    color: #fff;
                    font-size: 17px;
                    padding: 10px;
                    top: 10px;
                    left: 0;
                    position: relative;
                    cursor: pointer;
                    margin-left: 5px;
                }
                .tabs a:hover{
                    background: #f5e1e1;
                    color: #000;
                }
                .ativo{
                    background: #f5e1e1;
                    color: #000;
                }
                .tudoconfig{
                    margin-top: 20px;
                }
             </style>

        <div class="altere">
        <div class="tabs">
            <a <?php
            if(isset($_GET['fotoperfil'])){
                echo 'class="ativo" style="color:#000;';
            }
            else{
                echo 'style="color:#fff;background: transparent;"';
            }
            ?>href="editprofile.php?fotoperfil">Foto de perfil</a>
            <a <?php
            if(isset($_GET['fotodecapa'])){
                echo 'class="ativo" style="color:#000;';
            }
            else{
                echo 'style="color:#fff;background: transparent;"';
            }
            ?> href="editprofile.php?fotodecapa">Foto de capa</a>
            <a <?php
            if(isset($_GET['fotobackground'])){
                echo 'class="ativo" style="color:#000;';
            }
            else{
                echo 'style="color:#fff;background: transparent;"';
            }
            ?> href="editprofile.php?fotobackground">Foto de background</a>
		</div>
        <div class="tudoconfig">
        <?php
    if(isset($_GET['fotoperfil'])){ ?>
        <center>
        <p style="color: #151515;font-size: 22px;">Foto de perfil atual.</p>
        <img src="/static/img/avatar/<?php echo $user['photo']; ?>" style="width:140px;margin-top: 20px;" class="center"/>
        </center>

		<h2>Altere sua foto de perfil</h2>
		<form method="POST" enctype="multipart/form-data" id="perfil">
			<br />
			<h3>Mostra ao mundo quem és</h3><br />
			<h3>adicionado uma foto de rosto...</h3><br /><br />
			<input type="file" name="file" /><br /><br /><br />
			<input type="submit" value="Guardar" name="save" />
			<br /><br />
		</form>
		<br /><br /><br />
	<?php }
	
    else if(isset($_GET['fotodecapa'])){ ?>
        <center>
        <p style="color: #151515;font-size: 22px;">Foto de Capa atual.</p>
        <div class="background" style="background-size:cover; width: 100%;height: 240px;background-image:url(/static/img/cover/<?php echo $user['fotoback']; ?>);"></div>
        </center>

		<h2>Altere sua foto de capa</h2>
		<form method="POST" enctype="multipart/form-data" id="perfil">
			<br />
			<h3>Seja style, escolha com sabedoria.</h3><br />
			<h3>adicionado uma foto de capa...</h3><br /><br />
			<input type="file" name="file" /><br /><br /><br />
			<input type="submit" value="Guardar" name="capa" />
			<br /><br />
		</form>
		<br /><br /><br />
    <?php }
    else if(isset($_GET['fotobackground'])){ ?>
        <center>
        <p style="color: #151515;font-size: 22px;">Foto de background atual.</p>
        <div class="background" style="background-size:cover; width: 100%;height: 240px;background-image:url(/static/img/background/<?php echo $user['background']; ?>);"></div>
        </center>

		<h2>Altere sua foto de background</h2>
		<form method="POST" enctype="multipart/form-data" id="perfil">
			<br />
			<h3>Seja style, escolha com sabedoria.</h3><br />
			<h3>adicionado uma foto de background...</h3><br /><br />
			<input type="file" name="file" /><br /><br /><br />
			<input type="submit" value="Guardar" name="background" />
			<br /><br />
		</form>
		<br /><br /><br />
	<?php } else {?>
	
		<div class="center">
			<center>
				<h1 style="font-size: 25px;position: relative; top: -10px;">Configuração não encontrada.</h1>
				<h1 style="font-size: 23px;position: relative; top: -10px;">Navegue nas configurações usando os botãoes acima.</h1>
			<svg viewBox="0 0 130 188" height="250px" style="position: relative;">
  <g id="XMLID_53_">
    <path id="XMLID_84_" fill="#E8E8E8" d="M37.8,146.5c0-0.8-0.1-1.5-0.2-2.2c-0.8-4.8-6.5-8.6-11.3-7.6c-6.6,1.4-5.6,11-5,15.9
      c0.5,3.7,1.2,7.4,2.3,11c1.8,5.9,3.1,11.8,6.9,16.7c1.3,1.7,5.9,2.6,7.5,0.8c1.4-1.7,0-4.4-0.2-6.4c-0.4-7.6-0.2-15.1-0.2-22.8
      C37.6,150.2,37.8,148.3,37.8,146.5z"></path>
    <path id="XMLID_83_" fill="#E8E8E8" d="M92.8,146.5c0-0.8,0.1-1.5,0.2-2.2c0.8-4.8,6.5-8.6,11.3-7.6c6.6,1.4,5.6,11,5,15.9
      c-0.5,3.7-1.2,7.4-2.3,11c-1.8,5.9-3.1,11.8-6.9,16.7c-1.3,1.7-5.9,2.6-7.5,0.8c-1.4-1.7,0-4.4,0.2-6.4c0.4-7.6,0.2-15.1,0.2-22.8
      C93,150.2,92.8,148.3,92.8,146.5z"></path>
    <path id="XMLID_82_" fill="#E8E8E8" d="M63.3,163.2c-0.8,0.5-1.6,1-2.6,1.3c-1.9,0.6-3.9,1.2-6,1.3c-3,0.1-5.9-0.4-8.8-1.3
      c-7.4-2.4-14.5-6.5-19.9-12.2c-10.5-11.1-13.4-27.8-9.9-42.3c1.6-6.5-8.7-7.9-10.3-1.5c-4.7,19,0.9,39.9,15.2,53.3
      c8.9,8.3,21.9,14.5,34.3,13.4c3.3-0.3,6.5-1.4,9.3-3.2c1.8-1.1,3.7-2.6,4.5-4.6c1-2.7-1.3-5.6-4.2-5
      C64.5,162.6,63.9,162.9,63.3,163.2z"></path>
    <path id="XMLID_81_" fill="#FFFFFF" d="M92.5,95.1c-1.7-3.1-3.6-1.5-7-3.4c-5.2-2.9-11.6-3.4-17.5-3.1c-1.2,0.1-2,0.1-2.7,0.2
      c-0.6-0.1-1.5-0.2-2.7-0.2c-5.9-0.3-12.4,0.3-17.5,3.1c-3.4,1.9-5.4,0.3-7,3.4c-3.8,7-32,62.8-9,76.8c6.4,3.9,19.7,5.7,32.9,6v0
      c0.3,0,0.5,0,0.8,0c0,0,0.1,0,0.1,0c0.4,0,0.7,0,1.1,0c0.2,0,0.3,0,0.5,0c0.3,0,0.5,0,0.8,0c0.3,0,0.5,0,0.8,0c0.2,0,0.3,0,0.5,0
      c0.4,0,0.7,0,1.1,0c0,0,0.1,0,0.1,0c0.3,0,0.5,0,0.8,0v0c13.3-0.3,26.6-2.1,32.9-6C124.5,157.9,96.3,102.1,92.5,95.1z"></path>
    <path id="XMLID_80_" fill="#E8E8E8" d="M88.2,148.8c-0.4-0.5-0.8-1-1.2-1.5c0,0.1,0,0.2,0,0.3c-0.4,4.4-0.6,8.8-2.3,13
      c-3.1,7.5-11.3,11.1-19,11.1c-7.4,0.1-16.1-2.3-20-9.2c-1.4-2.4-2.7-5.4-3.5-8.5c-0.2,5.6,1.3,11.5,2.8,16.7c0.6,2.1,1.3,4.1,2,6.2
      c4.8,0.6,9.9,0.9,15.1,1v0c0.3,0,0.5,0,0.8,0c0,0,0.1,0,0.1,0c0.4,0,0.7,0,1.1,0c0.2,0,0.3,0,0.5,0c0.3,0,0.5,0,0.8,0
      c0.3,0,0.5,0,0.8,0c0.2,0,0.3,0,0.5,0c0.4,0,0.7,0,1.1,0c0,0,0.1,0,0.1,0c0.3,0,0.5,0,0.8,0v0c5.7-0.1,11.3-0.5,16.5-1.2
      C88.4,167.8,93.9,156.7,88.2,148.8z"></path>
    <path id="XMLID_79_" fill="#FFFFFF" d="M46.6,146.5c0-0.8-0.1-1.5-0.2-2.2c-0.8-4.8-6.5-8.6-11.3-7.6c-6.6,1.4-5.6,11-5,15.9
      c0.5,3.7,1.2,7.4,2.3,11c1.8,5.9,3.1,11.8,6.9,16.7c1.3,1.7,5.9,2.6,7.5,0.8c1.4-1.7,0-4.4-0.2-6.4c-0.4-7.6-0.2-15.1-0.2-22.8
      C46.4,150.2,46.6,148.3,46.6,146.5z"></path>
    <path id="XMLID_78_" fill="#FFFFFF" d="M83.9,146.5c0-0.8,0.1-1.5,0.2-2.2c0.8-4.8,6.5-8.6,11.3-7.6c6.6,1.4,5.6,11,5,15.9
      c-0.5,3.7-1.2,7.4-2.3,11c-1.8,5.9-3.1,11.8-6.9,16.7c-1.3,1.7-5.9,2.6-7.5,0.8c-1.4-1.7,0-4.4,0.2-6.4c0.4-7.6,0.2-15.1,0.2-22.8
      C84.1,150.2,83.9,148.3,83.9,146.5z"></path>
    <path id="XMLID_77_" fill="#79C900" d="M66.3,149.7c28.7-0.4,28.4-29.8,28.7-30.9c-0.4-1-0.9,0.2-1.3-0.7
      c-2.2-4.7-4.1-10.3-8.9-12.8c-3-1.6-5.8-2.5-9.2-3.1c-11.3-1.9-23.7-3.5-32.1,6.3c-3.9,4.5-5.6,4.9-8,10.1
      C35.5,125.8,40.8,150,66.3,149.7z"></path>
    <path id="XMLID_76_" fill="#E75125" d="M97.1,108.8c-2.6,0.1-7.1,2-9,2.3c-6.5,1.2-13.2,1.6-19.9,1.6c-8.5,0-17.1-0.6-25.5-1.8
      c-2.4-0.3-4.9-0.9-7.3-1.1c-3.9-0.4-4,2.4-3.3,5.9c1.1,5.7,7.7,8.1,12.5,9.2c11.7,2.6,24.2,2.6,36,0.9c5.8-0.8,14.3-2.9,17.1-9
      c0.4-0.9,2.1-7.3,0.6-7.8C98,108.9,97.6,108.8,97.1,108.8z"></path>
    <g id="XMLID_32_">
      <path id="XMLID_75_" fill="#E5A007" d="M83.2,117.6c-2.1-2.1-5-3.3-8-3.3s-5.9,1.2-8,3.3c-2.1,2.1-3.3,5-3.3,8c0,3,1.2,5.9,3.3,8
        c2.1,2.1,5,3.3,8,3.3s5.9-1.2,8-3.3c2.1-2.1,3.3-5,3.3-8C86.5,122.6,85.3,119.7,83.2,117.6z"></path>
      <path id="XMLID_74_" fill="#070707" d="M66.3,132.4c0.3,0.4,0.6,0.8,1,1.1c1.4,1.4,3.2,2.4,5.1,2.9
        C74.8,134.1,67.8,130,66.3,132.4z"></path>
      <path id="XMLID_73_" fill="#070707" d="M81.7,132c-1.1,1-1.3,2.1-0.4,3c0.7-0.4,1.3-0.9,1.8-1.5c0.8-0.8,1.5-1.7,2-2.7
        C83.9,130.7,82.6,131.2,81.7,132z"></path>
      <path id="XMLID_72_" fill="#FCB915" d="M86.3,122.4c-7.2-1.3-14.6-0.6-21.9,0.1c-2.2,0.2-2.3,3.4,0,3.5c7,0.1,13.9-1.2,20.8,0.1
        C87.7,126.6,88.7,122.9,86.3,122.4z"></path>
    </g>
    <g id="XMLID_8_">
      <g id="XMLID_3_">
        <path id="XMLID_71_" fill="#E8E8E8" d="M42.7,31c-0.8-7.2-2.4-17.3-8-22.5c-9.2-8.4-19.6,1-23.5,10c-4.7,11-7.1,28.4,0.4,38.6
          c0.1,0.2,0.3,0.3,0.6,0.2c2.2-0.8,2.4-3.3,2.2-5.5c0.8-0.1,1.5-0.5,2-1.3c3.9,1.3,7.1-2.3,9.7-6.1c0.6,0,1.2-0.2,1.8-0.6
          c0.2-0.1,0.4-0.3,0.7-0.6l0,0c0.2-0.2,0.3-0.4,0.5-0.5c0.7-0.7,1.5-1.4,1.9-1.4c1.9,0.1,3-1,3.5-2.3c1.6,1,4.1,0.4,5.1-1.4
          c0.9,0.5,2.1,0.4,2.6-0.6C42.9,35.6,42.9,33.4,42.7,31z"></path>
        <path id="XMLID_70_" fill="#FFFFFF" d="M39.6,16.4c-3.4-5.5-9.2-7.7-15.2-4.8c-5.9,2.9-10.4,8.8-12.7,14.9
          C9.8,31.7,7.3,37.3,7,42.8C6.8,47.7,8.6,53,11.7,57.2c0.1,0.2,0.3,0.3,0.6,0.2c2.2-0.8,2.4-3.3,2.2-5.5c0.8-0.1,1.5-0.5,2-1.3
          c3.9,1.3,7.1-2.3,9.7-6.1c0.6,0,1.2-0.2,1.8-0.6c0.2-0.1,0.4-0.3,0.7-0.6l0,0c0.2-0.2,0.3-0.4,0.5-0.5c0.7-0.7,1.5-1.4,1.9-1.4
          c1.9,0.1,3-1,3.5-2.3c1.6,1,4.1,0.4,5.1-1.4c0.9,0.5,2.1,0.4,2.6-0.6c0.7-1.5,0.7-3.7,0.4-6.1c-0.4-3.8-1.1-8.5-2.4-12.7
          C40.1,17.7,39.8,17.1,39.6,16.4z"></path>
        <path id="XMLID_69_" fill="#E75125" d="M28.9,49.7c3.9-1.9,9.1-4.1,11.7-7.9c0.3-4.9,0.2-9.5-1.7-14.3
          c-2.4-6.1-9.7-10.2-15.5-6.3c-6.4,4.4-8.4,13.6-9.1,21.1c-0.3,2.7-0.8,7.9-0.1,12.2C19.2,53.5,24,52.1,28.9,49.7z"></path>
      </g>
      <g id="XMLID_4_">
        <path id="XMLID_68_" fill="#E8E8E8" d="M88.5,31c0.8-7.2,2.4-17.3,8-22.5c9.2-8.4,19.6,1,23.5,10c4.7,11,7.1,28.4-0.4,38.6
          c-0.1,0.2-0.3,0.3-0.6,0.2c-2.2-0.8-2.4-3.3-2.2-5.5c-0.8-0.1-1.5-0.5-2-1.3c-3.9,1.3-7.1-2.3-9.7-6.1c-0.6,0-1.2-0.2-1.8-0.6
          c-0.2-0.1-0.4-0.3-0.7-0.6l0,0c-0.2-0.2-0.3-0.4-0.5-0.5c-0.7-0.7-1.5-1.4-1.9-1.4c-1.9,0.1-3-1-3.5-2.3c-1.6,1-4.1,0.4-5.1-1.4
          c-0.9,0.5-2.1,0.4-2.6-0.6C88.2,35.6,88.2,33.4,88.5,31z"></path>
        <path id="XMLID_67_" fill="#FFFFFF" d="M91.5,16.4c3.4-5.5,9.2-7.7,15.2-4.8c5.9,2.9,10.4,8.8,12.7,14.9
          c1.9,5.2,2.3,10.8,2.6,16.2c0.2,4.9,0.6,10.2-2.5,14.4c-0.1,0.2-0.3,0.3-0.6,0.2c-2.2-0.8-2.4-3.3-2.2-5.5
          c-0.8-0.1-1.5-0.5-2-1.3c-3.9,1.3-7.1-2.3-9.7-6.1c-0.6,0-1.2-0.2-1.8-0.6c-0.2-0.1-0.4-0.3-0.7-0.6l0,0
          c-0.2-0.2-0.3-0.4-0.5-0.5c-0.7-0.7-1.5-1.4-1.9-1.4c-1.9,0.1-3-1-3.5-2.3c-1.6,1-4.1,0.4-5.1-1.4c-0.9,0.5-2.1,0.4-2.6-0.6
          c-0.7-1.5-0.7-3.7-0.4-6.1c0.4-3.8,1.1-8.5,2.4-12.7C91.1,17.7,91.3,17.1,91.5,16.4z"></path>
        <path id="XMLID_66_" fill="#E75125" d="M102.2,49.7c-3.9-1.9-9.1-4.1-11.7-7.9c-0.3-4.9-0.2-9.5,1.7-14.3
          c2.4-6.1,9.7-10.2,15.5-6.3c6.4,4.4,8.4,13.6,9.1,21.1c0.3,2.7,0.8,7.9,0.1,12.2C111.9,53.5,107.1,52.1,102.2,49.7z"></path>
      </g>
      <path id="XMLID_65_" fill="#FFFFFF" d="M117.5,47.3c-4.1-7-10-13.1-17.4-17.2c-16.6-9.3-37.8-11-55.9-5.5
        c-2.3,0.7-4.6,1.6-6.8,2.6c-14,6.3-25.9,19.3-29.8,34.3c-2,7.6-1.6,16,0.7,23.5c2.1,6.8,6.3,12.3,11.6,17.2
        c14.1,13.2,34.1,17.2,53,15.1c18.3-2,38.7-10.4,46-28.3C124.5,75.1,125.1,60.6,117.5,47.3z"></path>
      <path id="XMLID_64_" fill="#FCB915" d="M72.9,72.3c-1.4-1.8-4-1.7-6.1-1.8c-2.3,0-5,0-7.3,0.7c-1.6,0.5-2,2.4-1,3.6
        c1.4,1.5,3.7,2.5,5.9,3.1c0,0,0.1,0,0.1,0C67,79.1,75.7,76,72.9,72.3z"></path>
      <path id="XMLID_5_" fill="#070707" d="M76.1,101.7c-0.3-0.2-0.7-0.3-1.1-0.5c-4.1-1.1-10.1-1.1-14.2,0.3c-3.1,1.1-1.4,3.2,1.2,3.4
        c2.5,0.2,4.9-0.5,7.3-0.6c2.1-0.1,4.2,0,6.2-0.7C77.1,103,77,102.2,76.1,101.7z"></path>
      <path id="XMLID_62_" fill="#E8E8E8" d="M97.1,55.9c-0.1-0.3-0.2-0.7-0.3-1c-0.2-0.3-0.6-0.5-1-0.4c-0.4,0.1-0.6,0.5-0.7,0.9
        c0,0.3,0,0.5,0,0.8c0,0,0,0.4,0,0.3c-0.1,0.3,0,0.5,0,0.9c0.1,0.5,0.6,0.8,1.1,0.8c0.6,0,1-0.5,1.1-1.1
        C97.3,56.6,97.2,56.3,97.1,55.9z"></path>
      <path id="XMLID_61_" fill="#E8E8E8" d="M102.8,55.7c0,0.1,0-0.3,0-0.4l-0.1-0.7c-0.1-1.1-1.6-1.1-1.7,0l-0.1,0.7
        c0,0.1-0.1,0.4,0,0.4c-0.4,0.7,0.1,1.7,1,1.7S103.2,56.5,102.8,55.7z"></path>
      <path id="XMLID_60_" fill="#E8E8E8" d="M36.3,55.3c-0.2-0.4-0.3-0.9-0.4-1.4c-0.1-0.7-1.1-0.9-1.3-0.2c-0.1,0.4-0.2,0.8-0.2,1.2
        c0,0.2,0,0.3,0,0.5c0-0.3-0.1,0.5,0,0.2c0,0.1,0,0.1,0,0.2c0,0.7,0.6,1.2,1.3,1C36.3,56.7,36.6,55.9,36.3,55.3z"></path>
      <g id="XMLID_6_">
        <path id="XMLID_59_" fill="#E8E8E8" d="M41.7,43.7c0-0.1,0-0.1,0-0.2l0,0C41.7,43.5,41.7,43.6,41.7,43.7z"></path>
      </g>
      <path id="XMLID_58_" fill="#C1DBF4" d="M43.5,74.1c-1.9,0.1-3.7,0.2-5.4,0.3c-6.6,0.6-13.3,1.2-19.9,1.9c-0.7,0.1-1.2-0.2-1.4-0.6
        c-0.2,2.6-0.4,5.3-0.6,7.8c-0.3,4.6-0.8,9.1-1.1,13.7c1.4,1.7,3,3.3,4.7,4.9c7.4,6.9,16.3,11.2,25.9,13.6
        c-0.1-8.2-0.8-16.4-1.3-24.5C44.2,85.5,44.1,79.8,43.5,74.1z"></path>
      <path id="XMLID_57_" fill="#070707" d="M46.3,73.2c0-0.4-0.4-0.6-0.7-0.6c0,0,0,0-0.1,0c-0.1-0.2-11.1,0.4-16.1,0.9
        c-2.9,0.3-5.8,0.5-8.7,0.8c-2.2,0.2-4.8,0.1-7,0.7c-0.6,0.2-1,0.7-1,1.3c0,1,0,2.2,0.9,2.7c0.1,0.2,0.3,0.3,0.5,0.3
        c0.2,0,0.3,0,0.5-0.1c0,0,0.1,0,0.1,0c3-0.3,6-0.5,9.1-0.8c7.1-0.3,21.7-1.7,21.9-1.7c0.4,0,0.9-0.5,0.8-0.9
        c0-0.3-0.1-0.6-0.1-0.9C46.4,74.4,46.3,73.8,46.3,73.2z"></path>
      <g id="XMLID_7_">
        <path id="XMLID_56_" fill="#C1DBF4" d="M112.6,75.8c-2.4-0.2-4.7-0.4-7.1-0.7C99.3,75,93,74.7,86.8,73.9c-0.4,0-0.7-0.2-0.9-0.4
          c-0.6,5.8-0.7,11.6-1,17.3c-0.5,8.1-1.2,16.4-1.3,24.5c9.6-2.3,18.5-6.7,25.9-13.6c1.7-1.6,3.3-3.2,4.7-4.9
          c-0.3-4.6-0.7-9.2-1.1-13.7C113,80.8,112.8,78.3,112.6,75.8z"></path>
      </g>
      <path id="XMLID_55_" fill="#070707" d="M82.8,73.1c0-0.4,0.4-0.6,0.7-0.6c0,0,0,0,0.1,0c0.1-0.2,11.1,0.4,16.1,0.9
        c2.9,0.3,5.8,0.5,8.7,0.8c2.2,0.2,4.8,0.1,7,0.7c0.6,0.2,1,0.7,1,1.3c0,1,0,2.2-0.9,2.7c-0.1,0.2-0.3,0.3-0.5,0.3
        c-0.2,0-0.3,0-0.5-0.1c0,0-0.1,0-0.1,0c-3-0.3-6-0.5-9.1-0.8c-7.1-0.3-21.7-1.7-21.9-1.7c-0.4,0-0.9-0.5-0.8-0.9
        c0-0.3,0.1-0.6,0.1-0.9C82.8,74.3,82.8,73.7,82.8,73.1z"></path>
      <path id="XMLID_54_" fill="#E8E8E8" d="M28.2,55.9c-0.2-0.4-0.3-0.9-0.4-1.4c-0.1-0.7-1.1-0.9-1.3-0.2c-0.1,0.4-0.2,0.8-0.2,1.2
        c0,0.2,0,0.3,0,0.5c0-0.3-0.1,0.5,0,0.2c0,0.1,0,0.1,0,0.2c0,0.7,0.6,1.2,1.3,1C28.2,57.3,28.5,56.5,28.2,55.9z"></path>
    </g>
  </g>
</svg>
		
		</center>
	</div>

	<?php } ?>
    </div>
        </div>
		<p class="kopy">&copy; NekoHappy, 2017 - Todos os direitos reservados</p>
	</body>
    
</html>