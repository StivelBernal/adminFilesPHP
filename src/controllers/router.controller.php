<?php

class RouterController{

	public function ctrRoutes(){

		include "views/routes.php";

	}


	private function verifySession() {

		$url = 'http://149.50.136.71:8088/api/';

		// Inicializar cURL
		$curl = curl_init($url);

		// Configurar opciones de cURL
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Realizar la petición y obtener la respuesta
		$response = curl_exec($curl);

		// Verificar si la petición fue exitosa
		if ($response === false) {
			// Error al realizar la petición
			echo "Error al realizar la petición: " . curl_error($curl);
		} else {
			var_dump($response);
		}

		// Cerrar la sesión de cURL
		curl_close($curl);


		// colocar metodo para comprobar la sesion
	}

}
