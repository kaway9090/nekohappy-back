<?php
require 'static/php/system/database.php';
require 'static/php/system/config.php';
?>
<?php
if(isset($_GET['info'])){
?>

<?php
$idpost = DBEscape( strip_tags(trim($_GET['info']) ) );
$coments = DBRead( 'post', "WHERE id = $idpost ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['id_user'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';
else  
	foreach ($peoples as $people):	 
?>
    <style>
    .postagem<?php echo $coment['id']; ?>{
        background: #fff;
        width: 100%;
        height: 100%;
        position: fixed;
        margin: 0px auto;
        top: 0vw;
        z-index: 100;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.59);
    }

    .publicacao{
        width: 50vw;
        height: 100%;
        background-image: url(static/img/animes/background.jpg);
        background-size: cover;
        float: left;
        position: relative;
        left: 0;
    }

    .right-post{
        float: right;
        width: 49vw;
        right: 0;
        height: 100%;
        z-index: 0;
        top: -60px;
        position: relative;
        white-space: nowrap;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    </style>
    <div class="postagem<?php echo $coment['id']; ?>">
    <button id="closeinfo" style="z-index:1000;">
    <svg fill="#000" enable-background="new 0 0 512 512" height="52px" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M74.966,437.013c-99.97-99.97-99.97-262.065,0-362.037c100.002-99.97,262.066-99.97,362.067,0  c99.971,99.971,99.971,262.067,0,362.037C337.032,536.998,174.968,536.998,74.966,437.013z M391.782,120.227  c-75.001-74.985-196.564-74.985-271.534,0c-75.001,74.985-75.001,196.55,0,271.535c74.97,74.986,196.533,74.986,271.534,0  C466.754,316.775,466.754,195.212,391.782,120.227z M188.124,369.137l-45.251-45.266l67.876-67.877l-67.876-67.876l45.251-45.267  L256,210.743l67.877-67.892l45.25,45.267l-67.876,67.876l67.876,67.877l-45.25,45.266L256,301.245L188.124,369.137z"/></svg>
    </button>

    <div class="publicacao">

    </div>

    <div class="right-post">

    <img src="/static/img/avatar/<?php echo $people['photo']; ?>" class="avatar" style="margin-left: 1vw;position: relative; top: 1vw;"/>
    <a href="profile.php?id=<?php echo $people['id']; ?>"><p style="position: relative; left: 4.5vw;top: -1vw;"><?php echo $people['user']; ?></a> - Postagem</p>
    <hr/>
    <p style="word-wrap: break-word;padding: 1vw;"><?php echo $coment['texto']?></p>
    <input type="text" id="content2" style="width:100%; height: 1.5vw; border: none; padding-left: 0.5vw;box-shadow: 1px 1px 1px #7f829f;" placeholder="Comente a postagem de <?Php echo $people['user']; ?>"/>
    <button name="publish2" class="publish2" style="float: right; margin-top: 0.2vw;right: 0.5vw; position: relative;border: none; background: #7f829f; color: #fff; height: 2vw; width: 6vw; border-radius: 10px; cursor: pointer;">Comentar</button>
    
    <style>
    .comentariosidav{
        width: 100%;
        height: auto;
        background: #e5e5e5;
        position: relative;
        box-shadow: 1px 1px 1px #7f829f;
        top: 0px;
        margin-top: 40px;
    }
    </style>

<div class="space2"></div>
    <div id="flash2"></div>
    <div id="show2"></div>

    <?php
$postid2 = DBEscape( strip_tags(trim($_GET['info']) ) );
$coments = DBRead( 'comment', "WHERE id and idpost = $postid2 ORDER BY id DESC" );
if (!$coments)
echo '';	
else  
	foreach ($coments as $coment):	 
?>
<?php
$comentiduser = $coment['iduser'];
$peoples = DBRead( 'user', "WHERE id = $comentiduser ORDER BY id DESC LIMIT 1" );
if (!$peoples)
echo '';	
else  
	foreach ($peoples as $people):	 
?>  
    <div class="comentariosidav">
        <img src="/static/img/avatar/<?php echo $people['photo']; ?>" class="avatar" style="padding:5px;margin-left: 10px;"/>
        <a href="profile.php?id=<?php echo $people['id']; ?>"><p style="top:-35px; position: relative; left: 60px; padding: 1px;">
        <?php echo $people['user']; ?> - Respondeu isto.
        </p></a>
        <hr/>
        <p style="word-wrap: break-word;top:0px; position: relative; left: 5px; padding: 10px;">
        <?php echo $coment['texto']; ?>
        </p>
    </div>
    <?php endforeach; endforeach; ?>
    </div>



    <script type="text/javascript">
    $(function() {
    $(".publish2").click(function() {
    var textcontent = $("#content2").val();
    var dataString = 'content2='+ textcontent;
    if(textcontent=='')
    {
    alert("Digite alguma coisa..");
    $("#content2").focus();
    }
    else
    {
    $.ajax({
    type: "POST",
    url: "action.php?idpost=<?Php echo $coment['id']; ?>",
    data: dataString,
    cache: true,
    success: function(html){
    $("#show2").after(html);
    document.getElementById('content2').value='';
    $("#flash2").hide();
    $("#content2").focus();
    }  
    });
    }
    return false;
    });
    });
</script>

    <script>
    var info = document.getElementById('info');
    var closeinfo = document.getElementById('closeinfo');
    closeinfo.addEventListener('click', function(e){
 				e.stopPropagation();
                 $("#info").fadeOut(200);
 			});
    </script>
    </div>
    <?php endforeach; endforeach; ?>

<?php } ?>


<?php
if(isset($_GET['delete'])){
    $iduser = $_COOKIE['iduser'];

    if( DBDelete( 'post','id = '.$_GET['delete'].' and id_user='.$iduser.'') );

 } ?>