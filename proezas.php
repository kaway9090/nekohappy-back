<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
require 'db.php';
if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){
    $peopleatual = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
    $user = $user[0];

    $iduser2 = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user2 = DBRead('user', "WHERE id = '{$iduser2}' LIMIT 1 ");
    $user2 = $user2[0];

    $iduser2 = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $proezas = DBRead('proezas', "WHERE id = '{$iduser2}' LIMIT 1 ");
    $proezas = $proezas[0];


    $postagem = DBRead('post', "WHERE id_user = '{$iduser2}' LIMIT 1 ");


    if($user['lastlogin'] <> $_COOKIE['inisession']){
        setcookie("iduser" , "");
        setcookie("inisession" , "");
        setcookie("perfil" , "");
        header("location: login.php?sessaonova");
    }

}
?>
<?php if(isset($_COOKIE['iduser']) and (isset($_COOKIE['inisession']))){?>
<?php  if($user2['id'] == $user['id']){?>
<?php
$form['data'] = date("Y/m/d");
$form['tipo'] = "2";
$form['id_user'] = $user['id'];

$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($user['coins']>= 100){
    if( DBCreate( 'proezas', $form ) ){	
        echo '';
    }
}
}
?>

<?php
$totaldepost = mysql_query("SELECT * FROM neko_post WHERE id_user = $iduser2 ");
$totaldepost = mysql_num_rows($totaldepost);
?>

<?php
$form2['data'] = date("Y/m/d");
$form2['tipo'] = "1";
$form2['id_user'] = $user['id'];


$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form2['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($totaldepost >= 1){
    if( DBCreate( 'proezas', $form2 ) ){	
        echo '';
    }
}
}
?>



<?php
$totaldepost = mysql_query("SELECT * FROM neko_amizades WHERE de = $iduser2 ");
$totaldepost = mysql_num_rows($totaldepost);
?>

<?php
$form3['data'] = date("Y/m/d");
$form3['tipo'] = "3";
$form3['id_user'] = $user['id'];


$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form3['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($totaldepost >= 1){
    if( DBCreate( 'proezas', $form3 ) ){	
        echo '';
        $xpadd = array('xppor' => $user['xppor'] + 80);
        DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
    }
}
}
?>



<?php
$form4['data'] = date("Y/m/d");
$form4['tipo'] = "4";
$form4['id_user'] = $user['id'];


$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form4['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($user['photo'] <> 'default.png'){
    if( DBCreate( 'proezas', $form4 ) ){	
        echo '';
        $xpadd = array('xppor' => $user['xppor'] + 70);
        DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
    }
}
}
?>

<?php
$form5['data'] = date("Y/m/d");
$form5['tipo'] = "5";
$form5['id_user'] = $user['id'];

$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form5['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($user['visitas']>= 50){
    if( DBCreate( 'proezas', $form5 ) ){	
        echo '';
        $xpadd = array('xppor' => $user['xppor'] + 50);
        DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
    }
}
}
?>

<?php
$form6['data'] = date("Y/m/d");
$form6['tipo'] = "6";
$form6['id_user'] = $user['id'];

$dbCheck = DBRead( 'proezas', "WHERE id_user = '".$_COOKIE['iduser']."' and tipo = '". $form6['tipo'] ."' ORDER BY id DESC LIMIT 1" );
if( $dbCheck ){
echo "";
}
else{
if($user['vip'] == 1){
    if( DBCreate( 'proezas', $form6 ) ){	
        echo '';
        $xpadd = array('xppor' => $user['xppor'] + 150);
        DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
    }
}
}
?>

<?php } ?>
<?php } ?>