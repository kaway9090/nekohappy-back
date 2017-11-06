<?php 

$nome = $_POST['nome'];

include("DB.class.php");

$db = new DB;
$db2 = new DB;

$sql2 = $db2->con()->prepare("SELECT * FROM neko_anime WHERE nome LIKE '%$nome%'");
$sql = $db->con()->prepare("SELECT * FROM neko_user WHERE user LIKE '%$nome%'");
$sql->execute();
$sql2->execute();

if(empty($nome)){
	echo "";
}
else if($nome == "dono"){
	echo "<a href='https://facebook.com/imxandeco'><li class='buscaright'>"."<img src='static/img/avatar/default.png' class='avatar' />"."<div class='name'>Alexandre Silva</div>"."</li></a>";
}
else if($nome == "staff"){
	echo "<a href='https://facebook.com/imxandeco'><li class='buscaright'>"."<img src='static/img/avatar/default.png' class='avatar' />"."<div class='name'>Alexandre Silva</div>"."</li></a>";
}
else if($nome == "admin"){
	echo "<a href='https://facebook.com/imxandeco'><li class='buscaright'>"."<img src='static/img/avatar/default.png' class='avatar' />"."<div class='name'>Alexandre Silva</div>"."</li></a>";
}
else if($nome == "adm"){
	echo "<a href='https://facebook.com/imxandeco'><li class='buscaright'>"."<img src='static/img/avatar/default.png' class='avatar' />"."<div class='name'>Alexandre Silva</div>"."</li></a>";
}
else{
	while($ftc = $sql->fetchObject()){
		echo "<a href='profile.php?id=".$ftc->id."'><li class='buscaright'>"."<img src='static/img/avatar/".$ftc->photo."' class='avatar' />"."<div class='name'>".$ftc->user."</div>"."</li></a>";
	}
	while($ftc = $sql2->fetchObject()){
		echo "<a href='profile.php?id=".$ftc->id."'><li class='buscaright'>"."<img src='static/img/animes/".$ftc->foto."' class='avatar' />"."<div class='name'>".$ftc->nome."</div>"."</li></a>";
	}
}


?>