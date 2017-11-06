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
<?php 

     if(isset($_GET['verificarsessao'])){
        if(isset($_COOKIE['iduser']) ){
            echo '';
        }
        else{
            echo '<script>location.href="login.php?verificarsessao";</script>';
        }
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php");
        }
    }
    if(isset($_GET['alterando'])){
        if(isset($_COOKIE['iduser']) ){
            echo '';
        }
        else{
            echo '<script>location.href="login.php";</script>';
        }
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php?alterando");
        }
    }
    if(isset($_GET['resetpass'])){
        $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
        $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
        $user = $user[0];
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php");
        }
        if($user['idcry'] <> $_COOKIE['idcry']){      
            setcookie("iduser" , "");
            setcookie("idcry" , "");
            echo '<script>location.href="login.php?error";</script>';
        }
    }
    if(isset($_GET['resetpass'])){
        if(isset($_COOKIE['iduser']) ){
            echo '';
        }
        else{
            echo '<script>location.href="login.php?resetpass";</script>';
        }
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php");
        }
    }

    if(isset($_GET['recoverypassword'])){
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php?recoverypassword");
        }
    }
    if(isset($_GET['sessaonova'])){
        if(empty($_COOKIE['iduser'])){
            echo '';
        }
        if(isset($_COOKIE['thecry']) ){
            setcookie("thecry" , "");
            header("location: login.php");
        }
        else{
            echo '<script>location.href="login.php?sessaonova";</script>';
        }
    }    
    if(isset($_COOKIE['thecry']) ){
        $iduser6 = DBEscape( strip_tags(trim($_COOKIE['thecry']) ) );
        $user6 = DBRead('user', "WHERE idcry = '{$iduser6}' LIMIT 1 ");
        $user6 = $user6[0];
        if($user6){
            echo '';
            }else{
                setcookie("thecry" , "");
                header("location: login.php?error");	
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
<body>
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
     background-size: cover;
     background-image: url(/static/img/background/<?php echo $resultsearch['img'];?>);
    }
	</style>
<?php endforeach;?>
    
    <div class="page login padding z100 border flex centers" <?php if(isset($_COOKIE['thecry'])){ ?> 
    style="height: 500px;"
    <?php } ?>
    >
    <div class="flex left white a25">
    <div class="app padding2">
    </div>
    </div>
    <div class="flex right black a26">
    <h1 class="a2 line top center" <?php 
    if(isset($_COOKIE['thecry'])){
        echo 'style="top: -20px;"';
    }
    ?>><?php
    if(isset($_GET['verificarsessao'])){
        echo 'Isso é para proteger sua conta! :3';
        if(isset($_COOKIE['thecry'])){
            setcookie("thecry" , "");
        }
    }
    else if(isset($_GET['sessaonova'])){
        echo 'Alguém logou na sua conta :/';
        if(isset($_COOKIE['thecry'])){
            setcookie("thecry" , "");
    
        }
    }
    else if(isset($_GET['error'])){
        echo 'Ocorreu um erro!';
        if(isset($_COOKIE['thecry'])){
            setcookie("thecry" , "");

        }
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'Recuperando senha.';
        if(isset($_COOKIE['thecry'])){
            setcookie("thecry" , "");

        }
    }
    else if(isset($_GET['alterando'])){
        echo 'Insira seu pin-code';
        if(isset($_COOKIE['thecry'])){
            setcookie("thecry" , "");
        }
    }
    else if(isset($_GET['resetpass'])){
        echo 'Insira sua nova senha!';

    }
    else if(isset($_COOKIE['thecry'])){
        echo 'Entre novamente!';
    }
    else{
        echo 'Seja bem vindo novamente!';
    }
    ?>
</h1>
    <div class="login2 flex">
    <form <?php
    if(isset($_GET['verificarsessao'])){
        echo 'id="formveri"';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'id="requestpass"';
    }
    else if(isset($_GET['alterando'])){
        echo 'id="alterando"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'id="newsenha"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'id="dlogin"';
    }
    else{
        echo 'id="formlogin"';
    }
    ?>
    >
    <?php 
    if(isset($_COOKIE['thecry'])){
        $iduser5 = DBEscape( strip_tags(trim($_COOKIE['thecry']) ) );
        $user5 = DBRead('user', "WHERE id and idcry = '{$iduser5}' LIMIT 1 ");
        $user5 = $user5[0];
        if(isset($_GET['verificarsessao'])){
            echo '';
        }
        else if(isset($_GET['alterando'])){
            echo '';
        }
        else if(isset($_GET['recoverypassword'])){
            echo '';
        }
        else if(isset($_GET['resetpass'])){
            echo '';
        }
        else if(isset($_GET['recoverypassword'])){
            echo '';
        }
        else{
    ?>
    <img src="/static/img/avatar/<?Php echo $user5['photo']; ?>" style="left: 150px;position: absolute; width: 80px; height: 80px; top: 70px;border-radius: 50%;" />
    <?php }  }?>
    <span class="text left"<?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="position: relative; top:120px;"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'style="position: relative;top: 160px;"';
    }
    else{
        echo 'style="display:block;"';
    }    
    ?>><?php
    if(isset($_GET['verificarsessao'])){
        echo 'PIN CODE';
    }
    else if(isset($_GET['alterando'])){
        echo 'PIN CODE';
    }
    else if(isset($_GET['resetpass'])){
        echo 'Nova senha';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'Senha';
    }
    else{
        echo 'Email';
    }
    ?></span>
    <input class="form" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'id="pincode"';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'id="remail"';
    }
    else if(isset($_GET['alterando'])){
        echo 'id="rpin"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'id="newsenha2"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'style="top: 185px;"';
        echo 'id="nsenha"';
    }
    else{
        echo 'id="email"';
    }
    ?> type="<?php
    if(isset($_GET['verificarsessao'])){
        echo 'password"';
    }
    else if(isset($_GET['alterando'])){
        echo 'password"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'password"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'password"';
    }
    else{
        echo 'text"';
    }
    ?>" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="position: relative; top:150px;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?>/>
    <span class="text5 left" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="display:none;"';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['alterando'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'style="display: none;"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'style="display: none;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?>>Senha</span>
    <input class="form2" id="senha" type="password" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="display:none;"';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['alterando'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'style="display: none;"';
    }
    else if(isset($_COOKIE['thecry'])){
        echo 'style="display: none;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?> />
    <a href="login.php?recoverypassword" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="display:none;"';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['alterando'])){
        echo 'style="display: none;"';
    }
    else if(isset($_GET['resetpass'])){
        echo 'style="display: none;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?> class="recovery">Esqueci minha senha.</a>
    <button <?php 
        if(isset($_GET['recoverypassword'])){
            echo 'style="top: 200px;"';
        }
        else if(isset($_GET['alterando'])){
            echo 'style="top: 200px;"';
        }
        else if(isset($_GET['resetpass'])){
            echo 'style="top: 200px;"';
        }
    ?>class="entrar" style="top: 280px;">

<?php
    if(isset($_GET['verificarsessao'])){
        echo 'Continuar';
    }
    else if(isset($_GET['alterando'])){
        echo 'Verificar';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'Continuar';
    }
    else if(isset($_GET['resetpass'])){
        echo 'Alterar senha';
    }
    else if(isset($_GET['recoverypassword'])){
        echo 'Continuar';
    }
    else{
        echo 'Entrar';
    }
    ?>
    </button>
</form>
<?php
if(isset($_COOKIE['thecry'])){
    if(isset($_GET['verificarsessao'])){
        echo '';
    }
    else if(isset($_GET['alterando'])){
        echo '';
    }
    else if(isset($_GET['recoverypassword'])){
        echo '';
    }
    else if(isset($_GET['resetpass'])){
        echo '';
    }
    else if(isset($_GET['recoverypassword'])){
        echo '';
    }
    else{
    ?>
<a href="sair.php"><button style="top: 350px;"class="entrar" style="top: 280px;">
   Entrar em outra conta!
    </button></a>
    <?php } } ?>
<div id="errolog">

</div>
    <p style="bottom: 40px;" class="bottom" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="display:none;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?>>Não tens uma conta, registra-se <a href="registrar.php">agora</a>.</p>
    <p class="bottom" <?php
    if(isset($_GET['verificarsessao'])){
        echo 'style="display:none;"';
    }
    else{
        echo 'style="display:block;"';
    }
    ?>>(Versão beta 0.1)</p>
    </div>
    </div>

    </div>

    <script type="text/javascript" src="/assets/js/pace.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>

    <script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#formveri').submit(function(){ 	//Ao submeter formulário
		var login=$('#pincode').val();	//Pega valor do campo email
		var senha=$('#pincode').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"verificando.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "pincode="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='home.php'	//Redireciona
                		}
                        if(result==2){
                            location.href='login.php?verificarsessao'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>



<script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#dlogin').submit(function(){ 	//Ao submeter formulário
		var senha=$('#nsenha').val();	//Pega valor do campo email
		var senha2=$('#pincode').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"logandono.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "nsenhat="+senha+"&senha="+senha2,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='home.php'	//Redireciona
                		}
                        if(result==2){
                            location.href='login.php?verificarsessao'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>

<script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#alterando').submit(function(){ 	//Ao submeter formulário
		var login=$('#rpin').val();	//Pega valor do campo email
		var senha=$('#remail').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"alterandopass.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "rpin="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='login.php?resetpass'	//Redireciona
                		}
                        if(result==2){
                            location.href='login.php?alterando'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>

<script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#newsenha').submit(function(){ 	//Ao submeter formulário
		var login=$('#newsenha2').val();	//Pega valor do campo email
		var senha=$('#remail').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"newpass.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "newsenha="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='home.php'	//Redireciona
                		}
                        if(result==2){
                            location.href='login.php?resetpass'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>

<script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#requestpass').submit(function(){ 	//Ao submeter formulário
		var login=$('#remail').val();	//Pega valor do campo email
		var senha=$('#remail').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"requestpass.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "remail="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='login.php?alterando'	//Redireciona
                		}
                        if(result==2){
                            location.href='login.php?verificarsessao'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>

    <script>
    $(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#formlogin').submit(function(){ 	//Ao submeter formulário
		var login=$('#email').val();	//Pega valor do campo email
		var senha=$('#senha').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"logando.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "login="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='home.php'	//Redireciona
                        }
                        if(result==2){
                            location.href='login.php?verificarsessao'	//Redireciona
                        }
                        else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})
    </script>
</body>
</html>