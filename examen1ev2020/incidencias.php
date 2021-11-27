<?php
define('FILEUSER',"incidencias.txt");
$msg = "";

function limpiarEntrada($campo){
    $salida = trim($campo); // Elimina espacios antes y después de los datos
    $salida = stripslashes($campo); // Elimina backslashes \
    $salida = htmlspecialchars($campo); // Traduce caracteres especiales en entidades HTML
    
    return $salida;
}

$nombre    = limpiarEntrada($_POST['
nombre']);
$prioridad = limpiarEntrada($_POST['prioridad']);
$resumen   = limpiarEntrada($_POST['resumen']);

if(isset($_POST['nombre'])){

    $momento = date("d:m:Y  G:i");  
    $ip = $_SERVER['REMOTE_ADDR'];

    $incidencia = $momento . "," . $nombre . "," . $resumen . "," . $prioridad . "," . $ip . "\n"; 

    $resultado = file_put_contents(FILEUSER, $incidencia, FILE_APPEND);

    if ($resultado === false) {
        echo "Error no se ha podido anotar su incidencia <br>";
    } else {
        echo "Muchas gracias $nombre, se ha anotado su incidencia. <br>";
    }
}


?>