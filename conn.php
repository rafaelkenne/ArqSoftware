<?php
class conn{
	public static $dbName = "hotelaria";
	public static $host = "localhost";
	public static $user = "root";
	public static $password = "";
	private static $connect = null;
	
	private function Conectar(){
		try{
			self::$connect = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName, self::$user, self::$password);
		}catch(Exception $ex){
			echo "Mensagem".$ex->getMessage();
			die();
		}
		return self::$connect;
	}

	public function getConn(){
		return self::Conectar();	
	}



}


?>