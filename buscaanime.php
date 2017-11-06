<?php 

$nome = $_POST['nomeanime'];

include("DB.class.php");

$db = new DB;

$sql = $db->con()->prepare("SELECT * FROM neko_anime WHERE nome LIKE '%$nome%'");
$sql->execute();

if(empty($nome)){
	echo "";
}else{
	while($ftc = $sql->fetchObject()){
		echo "<a href='#'><li class='buscaright'>"."<img src='static/img/animes/".$ftc->foto."' class='avatar' />"."<div class='name'>".$ftc->nome."</div>"."</li></a>";
	}
}


?>