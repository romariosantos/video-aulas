<?php 
	class DB{
		protected static $host = 'localhost';
		protected static $user = 'root';
		protected static $pass = '';
		protected static $db   = 'video_aulas';

		public static function Conn(){
			try{
				return new PDO('mysql:host='.self::$host.';dbname='.self::$db.';', self::$user, self::$pass);
			}catch(PDOException $e){
				echo 'Erro ao conetar-se ao banco!'. $e->getMessage();
			}
		}
	}