<?php
    require 'static/php/system/database.php';
    require 'static/php/system/config.php';
  mysql_connect('localhost', 'root','')or die();	//Conecta com o MySQL
  mysql_select_db('nekohappy');						//Seleciona banco de dados
  
  $pincode=$_POST['pincode'];
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
      setcookie("iduser", $iduser, time()+3600 * 24 * 365);
      setcookie("inisession", $inisession, time()+3600 * 24 * 365);
      $busca2  = "SELECT idcry FROM neko_user WHERE email = '".$login."'";
      $identificacao2 = mysql_query($busca2);
      $retorno2 = mysql_fetch_array($identificacao2);
      $idcry = $retorno2['idcry'];
      setcookie("thecry", $idcry, time()+3600 * 24 * 365);
      if( DBUpdate( 'user', $userUP, "id = '{$iduser}'" ) ){
      echo '';
      }
      if( DBUpdate( 'user', $userUP, "id = '{$iduser}'" ) ){
          echo '';
         }
      exit;	
  }
	else{
        echo 2;	//Responde sucesso
       
  }
?>