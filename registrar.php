<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){
    $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
    $user = $user[0];
    
    if($user['configurado'] == 1){
        echo '<script>location.href="/";</script>';
    }

    if($user['configurado'] == 0){
        echo '<script>location.href="/configure.php";</script>';
    }
}
?>
<head>
<title>NekoHappy sua diversão em apenas 1 click</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<html>
<body class="registro">
    <div class="cl one">
    </div>
<?php
$resultsearchs = DBRead( 'back', "WHERE id ORDER BY rand() DESC LIMIT 1" );
 if (!$resultsearchs)
 echo '';
else
foreach ($resultsearchs as $resultsearch):
?>
    <style>
    .cl{
     background: #7289da;
     background-image: url(/static/img/background/<?php echo $resultsearch['img'];?>);
    }
	</style>
<?php endforeach;?>
    
    <div class="page2 login padding3 z100 border flex centers">
    <div class="flex left white a25">
    <div class="app2 padding2">
    </div>
    </div>
    <div class="flex right black a27">
    <h1 class="a2 line top center">CRIAR UMA CONTA.</h1>
    <div class="login3 flex">
    <form action="#" method="post">
    <span class="text left">E-MAIL</span>
    <input class="form" name="email" name="email" id="email" type="text" />
    <span class="text2 left">NOME DE USUARIO</span>
    <input class="form2" name="senha" id="senha" type="password"/>
    <span class="text3 left">SENHA</span>
    <input class="form3" name="user" id="user" type="text"/>
    <span class="text4 left">PIN CODE</span>
    <input class="form4" name="pin" id="pin" type="text"/>
    <button class="entrar" name="cadastrar" id="cadastrar">Continuar</button>
</form>
<div id="resposta">
    

</div>
    <p class="bottom">Já tens uma conta? Logar-se <a href="login.php">agora</a>.</p>
    </div>
    </div>

    </div>

    <script type="text/javascript" src="/assets/js/pace.min.js"></script>

<script>
$(document).ready(function() {
    $("#cadastrar").click(function() {
        var email = $("#email");
        var emailPost = email.val();
        var senha = $("#senha");
        var senhaPost = senha.val();
        var user = $("#user");
        var userPost = user.val();   
        var pin = $("#pin");
        var pinPost = pin.val();  
        $.post("register.php", {email: emailPost, senha: senhaPost, user: userPost, pin: pinPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");
         return false;
    });
});
</script>
</body>
</html>