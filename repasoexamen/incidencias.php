<?php

require_once "Incidencia.php";
session_start();

$tabla = [];
define('FILEUSER',"incidencias.txt");


if(!isset ($_SESSION['incidencias'])){
    $_SESSION['incidencias'] = cargarDatosTxt();
}

$tabla = $_SESSION['incidencias'];

if (isset ($_POST['Orden'])){
    switch($_POST['Orden']){
        case "Añadir": añadir();
            break;
        case "Ver incidencias": visualizar($tabla);
            break;
        case "Guardar y salir": salir($tabla);
            break;
    }   
}

function limpiarEntrada($campo){
    $salida = trim($campo); // Elimina espacios antes y después de los datos
    $salida = stripslashes($campo); // Elimina backslashes \
    $salida = htmlspecialchars($campo); // Traduce caracteres especiales en entidades HTML
    
    return $salida;
}

function cargarDatosTxt(){
    if (!is_readable(FILEUSER) ){
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    
    while ($linea = fgets($fich)) {
        $partes = explode(',', trim($linea));
        // Escribimos la correspondiente fila en tabla
        //$tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
        $incidencia1 = new Incidencia();
        
        $incidencia1->fecha = $partes[0];
        $incidencia1->nombre = $partes[1];
        $incidencia1->resumen = $partes[2];
        $incidencia1->prioridad = $partes[3];
        $incidencia1->ip = $partes[4];

        $tabla[] = $incidencia1;
    }

    fclose($fich);
    
    return $tabla;
}

function cargarDatosCsv(){
    $tabla=[];
    if (!is_readable(FILEUSER) ){
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    
    while ($partes = fgetcsv($fich)) {
        // Escribimos la correspondiente fila en tabla
        //$tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
        $incidencia1 = new Incidencia();
        
        $incidencia1->fecha = $partes[0];
        $incidencia1->nombre = $partes[1];
        $incidencia1->resumen = $partes[2];
        $incidencia1->prioridad = $partes[3];
        $incidencia1->ip = $partes[4];

        $tabla[] = $incidencia1;
    }

    fclose($fich);
    
    return $tabla;
}

function cargarDatosjson(){
    // Si no existe lo creo
    $tabla=[];
    $datosjson = @file_get_contents(FILEUSER) or die("ERROR al abrir fichero de usuarios");
    $tablajson = json_decode($datosjson, true);   

    foreach($tablajson as $partes){    
        $incidencia1 = new Incidencia();

        $incidencia1->fecha = $partes['fecha'];
        $incidencia1->nombre = $partes['nombre'];
        $incidencia1->resumen = $partes['resumen'];
        $incidencia1->prioridad = $partes['prioridad'];
        $incidencia1->ip = $partes['ip'];

        $tabla[] = $incidencia1;
    }

    return $tabla;
}

function añadir(){    
    $fecha = date("d:m:Y  G:i");  
    $ip = $_SERVER['REMOTE_ADDR'];

    //if(isset($_POST['nombre'])){
        $incidencia1 = new Incidencia();

        $incidencia1->fecha = $fecha;
        $incidencia1->ip = $ip;
        $incidencia1->nombre = limpiarEntrada($_POST['nombre']);
        $incidencia1->prioridad = limpiarEntrada($_POST['prioridad']);
        $incidencia1->resumen =limpiarEntrada($_POST['resumen']);
    
    $_SESSION['incidencias'][] = $incidencia1;

    usort($_SESSION['incidencias'],'ordenarporprioridad');

    echo "Se ha almacenado la nueva incidencia <br>";

    echo "<button onclick='history.back()'> Volver </button>";
}

function visualizar($tabla){
    $msg = "<table border ='1'><th>Fecha</th><th>Nombre</th><th>Resumen</th><th>Prioridad</th><th>IP</th>";
    foreach ($tabla as $incidencia) {
        $msg .= "<tr>";
        $msg .= "<td>$incidencia->fecha </td>\n";
        $msg .= "<td>$incidencia->nombre </td>\n";
        $msg .= "<td>$incidencia->resumen </td>\n";
        $msg .= "<td>$incidencia->prioridad </td>\n";
        $msg .= "<td>$incidencia->ip </td>\n";
        $msg .= "</tr>";
    }
    $msg .= "</table>";

    echo $msg;

    echo "<button onclick='history.back()'> Volver </button>";
}

function salir($tabla){
    volcarDatosTxt($tabla);

    session_destroy();
}

function volcarDatosTxt($tabla){
    $escribir = "";

    foreach($tabla as $incidencia){

        $escribir .= $incidencia->toString();
    }

    $resultado = @file_put_contents(FILEUSER, $escribir, FILE_APPEND);

    if ($resultado === false) {
        echo "Error, no se han podido guardar correctamente sus incidencias <br>";
        echo "<button onclick='history.back()'> Volver </button>";
    } else {
        echo "Muchas gracias, se han guardado correctamente sus incidencias. <br>";
    }
}

function volcarDatosCsv($tabla){

    $fich = @fopen(FILEUSER,"w") or die ("Error al escribir en el fichero.");
    foreach ($tabla as $incidencia) {
        $arr = (array)$incidencia;
        fputcsv($fich, $arr);
    }
    fclose($fich);

    echo "Muchas gracias, se han guardado correctamente sus incidencias. <br>";
}

function volcarDatosjson($tabla){
    $datosjson = "[";

    foreach ($tabla as $incidencia) {
        $datosjson .= $incidencia->getJSONEncode() . ",";
    }
    
    $datosjson= substr($datosjson, 0, -1);
    $datosjson .= "]";

    $resultado = @file_put_contents(FILEUSER, $datosjson) or die ("Error al escribir en el fichero.");

    if ($resultado === false) {
        echo "Error, no se han podido guardar correctamente sus incidencias <br>";
        echo "<button onclick='history.back()'> Volver </button>";
    } else {
        echo "Muchas gracias, se han guardado correctamente sus incidencias. <br>";
    }

}

function ordenarporprioridad ( $a, $b){
    return $a->prioridad - $b->prioridad;
}

?>