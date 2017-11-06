<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
  if($_COOKIE['iduser'] == $user['id']){
    setcookie("iduser" , "");
    setcookie("inisession" , "");
    setcookie("perfil" , "");
    header("location: /");
    echo '<script>location.href="login.php?error";</script>';
  }
?>
<?php
if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){
    $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
    $user = $user[0];
    
    if($user['configurado'] == 1){
        echo '<script>location.href="/";</script>';
    }
}
if(empty($_COOKIE['iduser']) and (empty($_COOKIE['inisession']))){
    echo '<script>location.href="login.php";</script>';
}
?>
<head>
<title>NekoHappy - Configurando perfil</title>
<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="shortcut icon" href="/static/img/app-icon.ico" />
</head>

<html>
<body class="a412">
<div class="flad"></div>
<div class="header-main">
<h1 class="conf1">Configurando o seu Perfil</h1>
</div>
<style>
.conf1{
    text-align: center;
    color: #fff;
    font-size: 28px;
}
.a412{
    background-image: url(static/img/darkness.png);
    background-size: cover;
    position: fixed;
    width: 100%;
    height: 100%;
}
</style>


<div class="flex center configurar">
    <div class="configurar flex center">

        <div class="flex left photop">
        <h1 class="atual">Foto de perfil atual</h1>
        <img src="static/img/avatar/<?php echo $user['photo'];?>" class="imgatual"/>
        </div>


        <div class="center formularios">
        <form id="formveri" method="post" method="POST" enctype="multipart/form-data">
            <input type="text" class="formconfig" id="nome" name="nome" placeholder="Nome"/>
            <input type="text" class="formconfig" id="sobname" name="sobname" placeholder="Sobrenome"/>
            <input type="text" class="formconfig" id="gostas" name="gostas" placeholder="Oque gostas de fazer na horas vagas?"/>
            <select class="formconfig" id="sexo" name="sexo"> 
            <option value="sexo">Selecion seu sexo</option> 
            <option value="masc">Masculino</option> 
            <option value="fem">Feminino</option> 
            <option value="not">Não quero definir</option>
        </select>
            <select class="formconfig" id="estado" name="estado"> 
            <option value="estado">Selecione o Estado</option> 
            <option value="ac">Acre</option> 
            <option value="al">Alagoas</option> 
            <option value="am">Amazonas</option> 
            <option value="ap">Amapá</option> 
            <option value="ba">Bahia</option> 
            <option value="ce">Ceará</option> 
            <option value="df">Distrito Federal</option> 
            <option value="es">Espírito Santo</option> 
            <option value="go">Goiás</option> 
            <option value="ma">Maranhão</option> 
            <option value="mt">Mato Grosso</option> 
            <option value="ms">Mato Grosso do Sul</option> 
            <option value="mg">Minas Gerais</option> 
            <option value="pa">Pará</option> 
            <option value="pb">Paraíba</option> 
            <option value="pr">Paraná</option> 
            <option value="pe">Pernambuco</option> 
            <option value="pi">Piauí</option> 
            <option value="rj">Rio de Janeiro</option> 
            <option value="rn">Rio Grande do Norte</option> 
            <option value="ro">Rondônia</option> 
            <option value="rs">Rio Grande do Sul</option> 
            <option value="rr">Roraima</option> 
            <option value="sc">Santa Catarina</option> 
            <option value="se">Sergipe</option> 
            <option value="sp">São Paulo</option> 
            <option value="to">Tocantins</option> 
            <option value="outro">Sou de outro país</option>
        </select>
        <input type="text" class="formconfig" id="myanime" name="myanime" placeholder="Perfil do MyAnimeList"/>
        <input type="text" class="formconfig" id="about" name="about" placeholder="Sobre você"/>
        <input type="text" class="formconfig" id="animefavorite" name="animefavorite" placeholder="Anime favorito"/>
    


        <button class="salvardados" id="salvar">Salvar</button>
    <div id="msg">

    </div>
        </div>

    </form>
    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready( function(){

    $("#salvar").click( function(){

        var dataString = $("form").serialize();

        $.ajax({
            url: 'salvar.php',
            type: 'POST',
            dataType: 'json',
            data: dataString,

            success: function (result){			//Sucesso no AJAX
                if(result==1){						
                    location.href='home.php'	//Redireciona
                }
                if(result == 2){
                    alert("Preencha todos os campos!");
                }
            },
        });
        return false;	//Evita que a página seja atualizada
    });
})
</script>

        </div>
    </div>
</div>

<script type="text/javascript" src="/assets/js/pace.min.js"></script>
</body>
</html>