<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
include('db.php');
$check = mysql_query("SELECT * FROM neko_post order by id desc");
if(isset($_POST['content2']))
{
$content=mysql_real_escape_string($_POST['content2']);
$ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$num1 = rand(15, 50);
$num2 = rand(121235321, 20);
$antispam5 = $num1 * $num2;
$antispam = DBEscape(strip_tags(trim(sha1($antispam5))));
$time = date('Y-m-d H:i:s');
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
$user = $user[0];
$tipo = DBEscape( strip_tags(trim($_GET['idpost']) ) );
$coinsadd = array('coins' => $user['coins'] + 10);
	DBUpDate( 'user', $coinsadd, "id = '{$user['id']}'" );
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query("insert into neko_comment(texto,iduser,time,idpost) values ('$content','$iduser','$time','$tipo')");
$fetch= mysql_query("SELECT texto,id,time FROM neko_comment order by id desc");
$row=mysql_fetch_array($fetch);
 $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
	$user = $user[0];
}
?>

<div class="comentariosidav">
        <img src="/static/img/avatar/<?php echo $user['photo']; ?>" class="avatar" style="padding:5px;margin-left: 10px;"/>
        <a href="profile.php?id=<?php echo $user['id']; ?>"><p style="top:-35px; position: relative; left: 60px; padding: 1px;">
        <?php echo $user['user']; ?> - Respondeu isto..
        </p></a>
        <hr/>
        <p style="word-wrap: break-word;top:0px; position: relative; left: 5px; padding: 10px;">
        <?php echo $row['texto']; ?>
        </p>
    </div>