<?php

// $ruta = ControladorRuta::ctrRuta();
// $servidor = ControladorRuta::ctrServidor();

if(isset($_GET["page"])){

	if ($_GET["page"] === "AddFile"){
			
		include "modules/addFile.php";
		
	}

}

?>
