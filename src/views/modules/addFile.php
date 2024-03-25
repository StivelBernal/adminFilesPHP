<?php

if (isset($_FILES["file"])){
    
    $data = $_FILES["file"];
    $type = $_POST["type"];
    
    $resp = FilesController::ctrSubirFiles($data, $type);
  
    echo $resp;
}
  