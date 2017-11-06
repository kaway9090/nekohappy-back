<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
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
		$user = $user[0];
		
		if($user['configurado'] == 0){
			echo '<script>location.href="/";</script>';
		}
		
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
<title>NekoHappy | <?php echo $user['user']; ?></title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<html>
<body>
<div class="profile">
</div>
<div class="flad"></div>
<div class="header-baixo flex">
<div class="header-top flex">
    <div class="background">
</div>
<div class="flex left center divbu">
<a href="/"><img src="/static/img/logo.png" class="logost"/></a>
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
<a href="profile.php?id=<?php echo $user2['id']?>">
<div class="avatar-and-name"><img src="static/img/avatar/<?php echo $user['photo'];?>" class="top-baixo-f"/>
<span class="a24"><?php echo $user2['nome'];?></span>
</div>
<a href="logout.php">
<svg height="30px" style="margin-top: 10px;position: relative;right: 10px;" version="1.1" viewBox="0 0 24 24" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="miu" stroke="none" stroke-width="1"><g id="Artboard-1" transform="translate(-359.000000, -407.000000)"><g id="slice" transform="translate(215.000000, 119.000000)"/><path d="M360,408 L360,430 L375,430 L375,423.5 L374,423.5 L374,429 L361,429 L361,409 L374,409 L374,414.5 L375,414.5 L375,408 L360,408 Z M377.050253,415.464466 L377.757359,414.757359 L382,419 L377.757359,423.242641 L377.050253,422.535534 L380.087349,419.498437 L367.00472,419.498437 L367.00472,418.5 L380.085786,418.5 L377.050253,415.464466 Z" fill="#000000" id="common-logout-signout-exit-outline-stroke"/></g></g></svg>
</a>
</a>
</div>
</div>

<div class="flex center ssa">
<div class="flex profile-t center">
<div class="flex center coverandimg">

<div class="covers img">

</div>

<style>
.profile{
    <?php
        if($user['sexo'] == 'masc'){
        echo 'background-image: url(static/img/explosion.png);';
          }
        else if($user['sexo'] == 'fem'){
      echo 'background-image: url(static/img/explosion.png);';
        }
        else if($user['sexo'] == 'not'){
      echo 'background-image: url(static/img/emo.jpg);';
        }
        else{
            echo 'background-image: url(static/img/explosion.png);';
        }
    ?>
    background-size: cover;
    width: 100%;
    height: 100%;
    background-repeat: none;
    position: fixed;
}
.img{
    background-image: url(static/img/cover/<?php echo $user['fotoback'];?>);
}
</style>
<div id="avatarp">
    <img src="static/img/avatar/<?php echo $user['photo'];?>" id="avatarimg"/>
</div>

<div class="bottomcoverandimg">
<span class="nome-people-a"><?php echo $user['nome'];?> <?php echo $user['sobname'];?> - <?php echo $user['user'];?></span>

<div class="flex main-profile center">
<div class="left-info">
<div class="top-info"></div>
<span class="infot">
Informações
</span>
<span class="city">
</span>
<span class="city2">
Vive em
<?php 
 if($user['estado'] == 'ac'){
      echo 'Acre';
  }
  if($user['estado'] == 'sc'){
    echo 'Santa Catarina';
    }
    if($user['estado'] == 'al'){
        echo 'Alagoas';
        }
        if($user['estado'] == 'am'){
            echo 'Amazonas';
            }
            if($user['estado'] == 'ap'){
                echo 'Amapá';
                }

                if($user['estado'] == 'ba'){
                    echo 'Bahia';
                }
                if($user['estado'] == 'ce'){
                  echo 'Ceará';
                  }
                  if($user['estado'] == 'df'){
                      echo 'Distrito Federal';
                      }
                      if($user['estado'] == 'es'){
                          echo 'Espírito Santo';
                          }
             if($user['estado'] == 'go'){
                 echo 'Goiás';
                   }          
                if($user['estado'] == 'ma'){
                    echo 'Maranhão';
                }
                if($user['estado'] == 'mt'){
                  echo 'Mato Grosso';
                  }
                  if($user['estado'] == 'ms'){
                      echo 'Mato Grosso do Sul';
                      }
                      if($user['estado'] == 'mg'){
                          echo 'Minas Gerais';
                          }
                          if($user['estado'] == 'pa'){
                              echo 'Pará';
                              }

                              if($user['estado'] == 'pb'){
                                echo 'Paraíba';
                                  }          
                               if($user['estado'] == 'pr'){
                                   echo 'Paraná';
                               }
                               if($user['estado'] == 'pe'){
                                 echo 'Pernambuco';
                                 }
                                 if($user['estado'] == 'pi'){
                                     echo 'Piauí';
                                     }
                                     if($user['estado'] == 'rj'){
                                         echo 'Rio de Janeiro';
                                         }
                                         if($user['estado'] == 'rn'){
                                             echo 'Rio Grande do Norte';
                                             }


                                             
                              if($user['estado'] == 'ro'){
                                echo 'Rondônia';
                                  }          
                               if($user['estado'] == 'rs'){
                                   echo 'Rio Grande do Sul';
                               }
                               if($user['estado'] == 'rr'){
                                 echo 'Roraima';
                                 }
                                 if($user['estado'] == 'se'){
                                     echo 'Sergipe';
                                     }
                                     if($user['estado'] == 'sp'){
                                         echo 'São Paulo';
                                         }
                                         if($user['estado'] == 'to'){
                                             echo 'Tocantins';
                                             }
                                             if($user['estado'] == 'outro'){
                                                echo 'Gringo';
                                                }
?>
</span>
<span class="animelist">Perfil no MyAnimeList : <?php echo $user['myanimelist'] ?></span>
<span class="sexo">Sexo : <?php
 if($user['sexo'] == 'masc'){
    echo 'Masculino';
    }
    if($user['sexo'] == 'fem'){
       echo 'Feminino';
       }
?>
</span>
<span class="pontuacao">Pontuação : <?php echo $user['coins'];?></span>
<span class="anime">Anime favorito : <?php echo $user['anime_favorite'];?></span>
</div>

<div class="right-postagem">
<?php if($user['id'] == $_COOKIE['iduser']){?>
<div class="postperfil flex">

<div class="postagem6 flex relative">
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
$coments = DBRead( 'post', "WHERE id and id_user = '".$user['id']."' ORDER BY id DESC" );
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

    
<div class="people-status-div-post">
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


</div>





</div>
</div>

</body>
</html>