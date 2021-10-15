<?php

$medios = [
"Expansión" => "http://www.expansion.com",
"El Pais" => "http://www.elpais.com",
"El Mundo" => "http://www.elmundo.es",
"Diario Marca" => "http://www.marca.com",
"20 Minutos" => "https:www.20minutos.es"
];

echo "<ul>";

foreach($medios as $key => $valor){

    echo "<li><a href= " . $valor . ">" . $key . "</a></li>";

}

echo "</ul>";

function elegirMedioAzar($medios){

    $clave_aleatoria = array_rand($medios);

    echo "El medio recomendado hoy es: " . $clave_aleatoria;
    
}

elegirMedioAzar($medios);


?>