<?php
    require 'static/php/system/database.php';
    require 'static/php/system/config.php';
  mysql_connect('localhost', 'root','')or die();	//Conecta com o MySQL
  mysql_select_db('nekohappy');						//Seleciona banco de dados
  
  $login=$_POST['remail'];	//Pegando dados passados por AJAX
  $senha=$_POST['senha'];
  $ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
  
  //Consulta no banco de dados
  $sql="select * from neko_user where email='".$login."'"; 
  $resultados = mysql_query($sql)or die (mysql_error());
  $res=mysql_fetch_array($resultados); //
	if (@mysql_num_rows($resultados) == 0){
		echo 0;	//Se a consulta não retornar nada é porque as credenciais estão erradas
  }
  else{
  $user = DBRead('user', "WHERE email = '{$login}' LIMIT 1 ");
  $user = $user[0];
  
        echo 1;	//Responde sucesso
        $inisession = date('Y-m-d H:i:s');
        $busca  = "SELECT id FROM neko_user WHERE email = '".$login."'";
        $identificacao = mysql_query($busca);
        $retorno = mysql_fetch_array($identificacao);
        $busca2  = "SELECT idcry FROM neko_user WHERE email = '".$login."'";
        $identificacao2 = mysql_query($busca2);
        $retorno2 = mysql_fetch_array($identificacao2);
        $iduser = $retorno['id'];
        $idcry = $retorno2['idcry'];
        $userUP['lastlogin'] = date('Y-m-d H:i:s');
        setcookie("iduser", $iduser);
        setcookie("idcry", $idcry, time()+3600 * 24 * 365);
        exit;
    }
?>