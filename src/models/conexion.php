<?php

Class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=reservas-db_admin_files",
						"root",
						"Abc12345");

		$link->exec("set names utf8");

		return $link;

	}


}