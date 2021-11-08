<?php

    define ('FICHERO', 'prueba.txt');

    $nlinea = 1;

    $ficherolineas = file(FICHERO);
    $caracteresTotales = 0;

    echo " Contenido del fichero: ".FICHERO."<p> <pre>";
    
    foreach ($ficherolineas as $linea) {
        echo $nlinea.":".$linea;
        $caracteresTotales += strlen($linea);
        $nlinea++;
    }
    
    echo "</pre></p>";

    $lineasTotales = sizeof($ficherolineas);

    echo "El número de líneas del archivo es $lineasTotales y el número total de caracteres es $caracteresTotales";


?>