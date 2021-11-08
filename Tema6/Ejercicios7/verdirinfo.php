<?php

define('DIRECTORIO', 'C:\Windows\apppatch');

if (! is_dir(DIRECTORIO)){ // Comprueba que realmente existe el directorio
    die("No existe el directorio " . DIRECTORIO);
}

$dir_cursor = @opendir(DIRECTORIO) or die("Error al abrir el directorio-");

echo "<table border=1>";
echo "<tr><th>Nombre</th><th>Tamaño</th><th>Tipo de Archivo</td></tr>";

$arrayArchivos = [];

$entrada = readdir($dir_cursor);

$i = 0;

while ($entrada !== false){// mientras haya datos

    if (is_file(DIRECTORIO . "/" .$entrada)) {
        $arrayArchivos[$i]["nombre"] = $entrada;
        $tamaño = filesize(DIRECTORIO . "/" . $entrada);
        $arrayArchivos[$i]["tamaño"] = $tamaño;
        $tipoArchivo = mime_content_type(DIRECTORIO . "/" . $entrada);
        $arrayArchivos[$i]["tipo"] = $tipoArchivo;

        $i++;
    }
    
    $entrada = readdir($dir_cursor); // lee siguiente entrada
}

var_dump($arrayArchivos);
echo "<br><br>";


function comparar($a, $b){

    return (strcmp($a["tamaño"], $b["tamaño"]));
}

//Ordenamos los archivos de mayor a menor tamaño:

$tamañoOrdenar = array_column($arrayArchivos, 'tamaño');

array_multisort($tamañoOrdenar, SORT_DESC, $arrayArchivos);

var_dump($arrayArchivos);
echo "<br><br>";

for($i=0; $i<sizeof($arrayArchivos); $i++){

    echo "<tr><td>". $arrayArchivos[$i]["nombre"] . "</td><td> : " . $arrayArchivos[$i]["tamaño"] ."</td><td> : " . $arrayArchivos[$i]["tipo"] . "</td></tr>";
}

echo "</table>";

closedir($dir_cursor); // cerramos el directorio

?>