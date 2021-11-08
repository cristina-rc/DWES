<?php

function contadorvisitas(){//  La función que ejecutara las visitas

    $visitasCookie = 0;
    // Si existe el cookie lo muestro
    if (isset($_COOKIE["visitas"])){
        $visitasCookie = $_COOKIE["visitas"];
    }
    $visitasCookie++;

    setcookie("visitas", $visitasCookie, time() + 90*24*3600);

    define('ACCESOS', 'accesos.txt');
    
    if (!is_readable(ACCESOS) ){ //Si no existe el directorio, lo crea
        // El directorio donde se crea tiene que tener permisos adecuados
        $fichero = @fopen(ACCESOS,"w") or die ("Error al crear el fichero.");
        fclose($fichero);
    }

    $arrayFichero = file(ACCESOS); //Almacenamos el contenido del fichero en un array
    $contadorvisitas = (int)$arrayFichero[0];//leemos la primera linea del archivo, y asignamos el contenido a la variable contadorvisitas
    $contadorvisitas += 1; // Le agregamos una visita mas al contador
    $mensajeEscribir = $contadorvisitas . "<br>" . $visitasCookie;
    
    file_put_contents(ACCESOS, $mensajeEscribir); //Sobrescribimos el contenido del archivo con el nuevo valor de contadorvisitas y el valor del cookie visitas

    $contenidoFichero = file_get_contents(ACCESOS); //Volvemos a leer el archivo con las visitas incrementadas

    echo $contenidoFichero . "<br> visitas"; //Imprimimos el contenido del archivo
}

contadorvisitas();

?> 
