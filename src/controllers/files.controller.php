<?php
// header("Access-Control-Allow-Headers: Authorization, Content-Type");
// header("Access-Control-Allow-Origin: *");
// header('content-type: application/json; charset=utf-8');

class FilesController{

  static public function ctrSubirFiles($datos, $folder){

    try {
        
      $availableFolders = ['soat', 'tecnicomecanica', 'tarjetaPropiedad', 'documentoUsuario', 'licencia', 'planilla'];
      $availableTypes = ['image/png', 'image/jpeg'];

      if (!in_array($folder,  $availableFolders)) throw new Exception("this is not available");
      

      if (isset($datos["tmp_name"]) && !empty($datos["tmp_name"])){
  
        $maxSize = 2 * 1024 * 1024; // 2MB en bytes
        if (!in_array($datos["type"],  $availableTypes)) throw new Exception("this type is not available");
        if ($datos["size"] > $maxSize) throw new Exception("this type is not available");

        $extension = pathinfo($datos["name"], PATHINFO_EXTENSION);
        $availableExtensions = array('png', 'jpeg', 'jpg');

        if (!in_array($extension, $availableExtensions)) throw new Exception("this type is not available");
          
        /*=============================================
        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
        =============================================*/
    
          function sanear_string($string)
          {
           
              $string = trim($string);
           
              $string = str_replace(
                  array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                  array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                  $string
              );
           
              $string = str_replace(
                  array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                  array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                  $string
              );
           
              $string = str_replace(
                  array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                  array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                  $string
              );
           
              $string = str_replace(
                  array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                  array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                  $string
              );
           
              $string = str_replace(
                  array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                  array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                  $string
              );
           
              $string = str_replace(
                  array('ñ', 'Ñ', 'ç', 'Ç'),
                  array('n', 'N', 'c', 'C',),
                  $string
              );
    
                //Esta parte se encarga de eliminar cualquier caracter extraño
                $string = str_replace(
                    array("@", "|", "!", "º", "-", "~", "#", "·", "$", "%", "&", "/", 
                         "(", ")", "?", "'", "¡","@", "|", "!", "¿", "[", "^", "<code>", "]",
                         "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", " "),
                    '',
                    $string
                );
             
             
                return $string;
            }
    
           $nameSani = sanear_string($datos["name"]);
    
          $rutaExtracto = './files/' . $folder . '/' . $nameSani; 
          move_uploaded_file($datos['tmp_name'], $rutaExtracto);
    
    
        return '{"success": true, "url":"https://bucket.colgravas.com/files/' . $folder . '/' . $nameSani.'"}';	
        
    
      } else {
        throw new Exception("The file was not sent");
      }
    } catch (Exception $th) {

      return '{"success": false, "error":"'.$th->getMessage().'"}';	

    }
  
  }
}

// TODO DE GUARDAR, DE VER Y ELIMINAR 
// GET URL ENCRIPTADA DEBE VISUALIZAR O DESCARGAR EL ARCHIVO
// POST GUARDAR VERFICAR SI EL ARCHIVO EXISTE GENERAR UN ID UNICO
// UPDATE O DELETE DEBE MOVER A UNA PAPELERA

