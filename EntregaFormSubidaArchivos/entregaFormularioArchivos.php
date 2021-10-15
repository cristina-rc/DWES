<html>
<head>
<title>Procesa varias subidas de archivos</title>
<meta charset="UTF-8">
</head>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once("entregaFormularioArchivos.html");
}

$codigosErrorSubida= [
    0 => 'Subida correcta',
    1 => 'El tamaño del archivo excede el admitido por el servidor', // directiva upload_max_filesize en php.ini
    2 => 'El tamaño del archivo excede el admitido por el cliente', // directiva MAX_FILE_SIZE en el formulario HTML
    3 => 'El archivo no se pudo subir completamente',
    4 => 'No se seleccionó ningún archivo para ser subido',
    6 => 'No existe un directorio temporal donde subir el archivo',
    7 => 'No se pudo guardar el archivo en disco', // permisos
    8 => 'Una extensión PHP evito la subida del archivo', // extensión PHP
    //Errores propios
    9 => 'El tamaño del archivo supera el límite permitido',
    10 => 'La suma de los tamaños de los archivos subidos supera el máximo permitido',
    11 => 'Formato de imagen no admitido'
];

    $mensaje = '';
    $directorioSubida = "/home/cristina_rodriguez/imgusers";
    $tamanioTotalImagenes = 0;

    $arrayArchivosCol = recolocarArray($_FILES["archivos"]);


    foreach($_FILES['archivos']['size'] as $archivo => $tamanio){
        $tamanioTotalImagenes += $tamanio;
    }
    

    
    if(count($_POST) == 0 ){
        $mensaje= "Error: se supera el tamaño máximo de un petición POST <br><br><hr>";    

    }else if ($_FILES['archivos']['name'][0] == ""){
        $mensaje.= "ERROR: No se seleccionaron archivos para subir.<br><br><hr>";

    }else if($tamanioTotalImagenes>300000){
        $mensaje.= "Se ha producido el error 10: ".$codigosErrorSubida["10"] . "<br><br><hr>";

    }else{

        foreach($arrayArchivosCol as $archivo){
            
            $nombreFichero = $archivo['name'];
            $tipoFichero = $archivo['type'];
            $tamanioFichero = $archivo['size'];
            $temporalFichero = $archivo['tmp_name'];
            $errorFichero = $archivo['error'];
   
            $mensaje.= "Intentando subir el archivo: " . ' <br/>';
            $mensaje.= "- Nombre: $nombreFichero" . ' <br/>';
            $mensaje.= '- Tamaño: ' . ($tamanioFichero / 1024) . ' KB <br/>';
            $mensaje.= "- Tipo: $tipoFichero" . ' <br/>' ;
            $mensaje.= "- Nombre archivo temporal: $temporalFichero" . ' <br/>';
            $mensaje.= "- Código de estado: $errorFichero" . ' <br/>';
    
            $mensaje .= '<br/>RESULTADO<br/>';


            if($errorFichero > 0){
                $mensaje.= "Se ha producido el error: $errorFichero : ".$codigosErrorSubida[$errorFichero] . "<br><br>";   

            }else{

                if($tamanioFichero>200000){
                    $mensaje.= "Se ha producido el error 9: ".$codigosErrorSubida["9"] . "<br><br><hr>";

                }else if($tipoFichero!="image/jpeg" && $tipoFichero!= "image/png"){
                    $mensaje.= "Se ha producido el error 11: ".$codigosErrorSubida["11"] . "<br><br><hr>";        
                
                }else{

                    if(is_dir($directorioSubida) && is_writable($directorioSubida)){

                        if(file_exists($directorioSubida . "/" . $nombreFichero)){
                            $mensaje.="No se ha podido subir el archivo correctamente, ya que el nombre del archivo ya existe en la ruta especificada<br><br><hr>";
                        
                        }else{
                            
                            if(move_uploaded_file($temporalFichero, $directorioSubida . '/' . $nombreFichero)==true){
                                $mensaje.="Archivo guardado en: " . $directorioSubida . '/' . $nombreFichero . "<br><br><hr>";
                        
                            }else{

                                $mensaje.="ERROR: Archivo no guardado correctamente <br><br><hr>";
                            }
                        }

                    }else{
                        $mensaje.= "ERROR: El directorio no es correcto, o no se poseen permisos de escritura sobre él <br><br><hr>";
                    }

                }
            }           
        }
    }

function recolocarArray(&$array_archivos) {

    $file_ary = array();
    $file_count = count($array_archivos['name']);
    $file_keys = array_keys($array_archivos);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $array_archivos[$key][$i];
        }
    }

    return $file_ary;
}

?>


<body>
<?php echo "Bienvenido ".$_REQUEST['nombre'] . "<br><br>"; ?>
<?php echo $mensaje; ?>
<br>
    <a href="entregaFormularioArchivos.html">Volver a la página de subida</a>
</body>
</html>
