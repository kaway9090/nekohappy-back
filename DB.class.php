<?php

class DB{
	public function con(){
		try{
			return new PDO("mysql:host=localhost;dbname=nekohappy", "root", "");
		}catch(PDOException $e){
			var_dump($e);
		}
	}
}