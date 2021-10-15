<?php

include_once "infopaises.php";

$paisRandom = array_rand($paises);


echo "La capital, y la población de " . $paisRandom . " es ";

foreach ($paises as $pais => $datos){

    foreach($datos as $valor){      

        if($pais == $paisRandom){
            echo $valor . " ";

        }  

    }
}

echo "</br><a href = 'https://www.google.es/maps/place/$paisRandom'>Enlace a google maps del país: </a>";

?>