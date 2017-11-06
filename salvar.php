<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php

$userUP['nome'] = $_POST['nome'];
$userUP['sobname'] = $_POST['sobname'];
$userUP['gostas'] = $_POST['gostas'];
$userUP['sexo'] = $_POST['sexo'];
$userUP['estado'] = $_POST['estado'];
$userUP['myanimelist'] = $_POST['myanime'];
$userUP['about'] = $_POST['about'];
$userUP['anime_favorite'] = $_POST['animefavorite'];
$userUP['configurado'] = 1;
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );

if (!($userUP['nome']) || !($userUP['sobname']) || !($userUP['gostas']) || !($userUP['sexo']) || !($userUP['estado']) || !($userUP['myanimelist']) || !($userUP['about']) || !($userUP['anime_favorite']) ){
    print '2';
}
else{
if( DBUpdate( 'user', $userUP, "id = '{$iduser}'" ) ){
echo '1';
}
}

?>