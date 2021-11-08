<?php

define('DIRECTORIO', 'C:\xampp\htdocs');

if (! is_dir(DIRECTORIO)){ // Comprueba que realmente existe el directorio
    die("No existe el directorio " . DIRECTORIO);
}

$dir_cursor = @opendir(DIRECTORIO) or die("Error al abrir el directorio-");

echo "<table border=1>";
echo "<tr><th>Nombre</th><th>Nº líneas</th></tr>";

$entrada = readdir($dir_cursor);

$arrayArchivos = [];
$i = 0;
$lineasDirectorio = 0;

while ($entrada !== false){// mientras haya datos

    if (is_file(DIRECTORIO . "/" .$entrada)) {
        $tipoArchivo = mime_content_type(DIRECTORIO . "/" . $entrada);

        if($tipoArchivo == "text/x-php"){
            $arrayArchivos[$i]["nombre"] = $entrada;
            $ficherolineas = file(DIRECTORIO . "/" .$entrada);
            $arrayArchivos[$i]["lineas"] = sizeof($ficherolineas);
            $lineasDirectorio += sizeof($ficherolineas);
            $i++;
        }       
    }
    
    $entrada = readdir($dir_cursor); // lee siguiente entrada
}

var_dump($arrayArchivos);
echo "<br><br>";

for($i=0; $i<sizeof($arrayArchivos); $i++){

    echo "<tr><td>". $arrayArchivos[$i]["nombre"] . "</td><td>" . $arrayArchivos[$i]["lineas"] . "</td>";
}

echo "<tr><td><b>Líneas totales" . "</b></td><td><b>" . $lineasDirectorio . "</b></td></tr>";

echo "</table>";

closedir($dir_cursor); // cerramos el directorio

?>