<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
include('db.php');
$check = mysql_query("SELECT * FROM neko_post order by id desc");
if(isset($_POST['content']))
{
$content=mysql_real_escape_string($_POST['content']);
$ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$num1 = rand(15, 50);
$num2 = rand(121235321, 20);
$antispam5 = $num1 * $num2;
$antispam = DBEscape(strip_tags(trim(sha1($antispam5))));
$time = date('Y-m-d H:i:s');
$tipo = 1;
$iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
$user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
$user = $user[0];
$coinsadd = array(
	'coins' => $user['coins'] + 10);
    DBUpDate( 'user', $coinsadd, "id = '{$user['id']}'" );
    $xpadd = array('xppor' => $user['xppor'] + 50);
        DBUpDate( 'user', $xpadd, "id = '{$user['id']}'" );
$dbCheck = DBRead( 'post', "WHERE spam = '". $antispam ."'" );
if( $dbCheck ){
	print "Postagem duplicada"; exit();
}
else{
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query("insert into neko_post(texto,id_user,spam,tim,tipo) values ('$content','$iduser','$antispam','$time','$tipo')");
$fetch= mysql_query("SELECT texto,id,tim FROM neko_post order by id desc");
$row=mysql_fetch_array($fetch);
}
 $iduser = DBEscape( strip_tags(trim($_COOKIE['iduser']) ) );
    $user = DBRead('user', "WHERE id = '{$iduser}' LIMIT 1 ");
	$user = $user[0];
}
?>

<div id="post-id1">


<div class="center-id" id="centerid<?php echo $row['id']; ?>">
<div class="left-id">
<a href="profile.php?id=<?php echo $user['id'];?>"><img src="/static/img/avatar/<?php echo $user['photo']; ?>" class="avatar" style="width: 50px; height: 50px; top: 20px; float: left; left: -60px; position: absolute;"/></a>
</div>
<p id="user-people1">
<a href="#" class="batata"><?php echo $user['user']; ?><a> publicou uma postagem.
<button id="button6<?php echo $row['id']; ?>" style="cursor: pointer; float: right; right: 5px; position: relative; border: none; background: none;">
<svg enable-background="new 0 0 48 48" height="20px" version="1.1" viewBox="0 0 48 48" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Expanded"><g><g><path d="M41,48H7V7h34V48z M9,46h30V9H9V46z"/></g><g><path d="M35,9H13V1h22V9z M15,7h18V3H15V7z"/></g><g><path d="M16,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C17,40.553,16.553,41,16,41z"/></g><g><path d="M24,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C25,40.553,24.553,41,24,41z"/></g><g><path d="M32,41c-0.553,0-1-0.447-1-1V15c0-0.553,0.447-1,1-1s1,0.447,1,1v25C33,40.553,32.553,41,32,41z"/></g><g><rect height="2" width="48" y="7"/></g></g></g></svg>
</button>

<script>
  $('#button6<?php echo $row['id']; ?>').click(function(){
	  $("#centerid<?php echo $row['id']; ?>").fadeOut(600);
				var i = setInterval(function () {
				clearInterval(i);
				// O código desejado é apenas isto:
				}, 1300);
				$.post('request.php?delete=<?php echo $row['id'];?>', function (html) {
				$('#info').html(html);
				});
    });
</script>

</p>

<p id="texto-people1">
<?php 
                                                $emotions = array(':)', ':@', '8)', ':D', ':3', ':(', ';)', ':O', ':o', ':P', ':p', '<3');
                                                $imgs = array(
                                                    '<img id="emoticon" src="/static/img/emotions/nice.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/angry.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/cool.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/happy.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/sad.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/right.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/ooooh.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/pi.png"/>',
                                                    '<img id="emoticon" src="/static/img/emotions/heart.png"/>'
                                                );
                                                $msg = str_replace($emotions, $imgs, $row['texto']);
                                                echo $msg;
                                                ?>
</p>
<hr/>
<style>

.postagem<?php echo $row['id']; ?>{
        background: #fff;
        width: 100%;
        height: 100%;
        position: fixed;
        margin: 0px auto;
        top: 0vw;
        z-index: 100;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.59);
    }

.bottom-class-idav{
    width: 100%;
    position: relative;
    height: 40px;
    background: #eee;
}
</style>
<div class="bottom-class-idav flex">
<button id="button<?php echo $row['id']; ?>" class="flex" style="z-index: 100000000;top: 0px;margin-left: 10px; cursor: pointer; position: relative; border: none; background: transparent;">
<svg id="Layer_1" style="height: 20px; width: 20px; position: relative; top: 0px; left: 2px;" style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M24,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S26.2,16,24,16z M24,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S25.1,22,24,22z"/><path d="M13,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S15.2,16,13,16z M13,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S14.1,22,13,22z"/><path d="M35,16c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S37.2,16,35,16z M35,22c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S36.1,22,35,22z"/><path d="M43,6H5C3.3,6,2,7.3,2,9v22c0,1.7,1.3,3,3,3h11.5l7.5,8.5l7.5-8.5H43c1.7,0,3-1.3,3-3V9C46,7.3,44.7,6,43,6z M44,31   c0,0.6-0.4,1-1,1H30.5L24,39.5L17.5,32H5c-0.6,0-1-0.4-1-1V9c0-0.6,0.4-1,1-1h38c0.6,0,1,0.4,1,1V31z"/></g></svg>
</button>
</div>

<script>
  $('#button<?php echo $row['id']; ?>').click(function(){
	  $("#info").fadeIn(600);
				var i = setInterval(function () {
				clearInterval(i);
                
				// O código desejado é apenas isto:
			    $("#info").fadeIn(200);
				}, 1300);
				$.post('request.php?info=<?php echo $row['id'];?>', function (html) {
				$('#info').html(html);
				});
    });
</script>

</div>



</div>