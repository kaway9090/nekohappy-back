<?php
    require 'static/php/system/database.php';
    require 'static/php/system/config.php';
  mysql_connect('localhost', 'root','')or die();	//Conecta com o MySQL
  mysql_select_db('nekohappy');						//Seleciona banco de dados
  
  $pincode=$_POST['rpin'];
  $ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
  $login = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
  
  $user = DBRead('user', "WHERE id = '{$login}' LIMIT 1 ");
  $user = $user[0];
  
  if($user['pin'] == $pincode){
      echo 1;
      $inisession = date('Y-m-d H:i:s');
      $iduser = $login;
      $userUP['lastlogin'] = date('Y-m-d H:i:s');	
      $userUP['ip'] = $ip;
      $idcry = $retorno2['idcry'];
      $busca2  = "SELECT idcry FROM neko_user WHERE id = '".$user['id']."'";
      $identificacao2 = mysql_query($busca2);
      $retorno2 = mysql_fetch_array($identificacao2);
      exit;	
  }
	else{
        echo 2;	//Responde sucesso
       
  }
?>