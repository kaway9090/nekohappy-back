<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
$user = $user[0];
if($user['lastlogin'] <> $_COOKIE['inisession']){
    setcookie("iduser" , "");
    setcookie("inisession" , "");
    setcookie("perfil" , "");
    header("location: login.php?sessaonova");
}
?>

<span class="coins-text"><?php echo $user['coins'];?></span>