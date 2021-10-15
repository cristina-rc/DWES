<?php

include_once "infopaises.php";

//Sacamos el máximo, igualamos al país correspondiente, e imprimimos sus ciudades

$max = max(array_column($paises, 'Poblacion'));
$paisMayor = null;

foreach ($paises as $clave => $valor){

    if ($valor["Poblacion"] == $max){
        $paisMayor = $clave;        
    }    
}

echo ("Las ciudades de ". $paisMayor . " son: ");

foreach ($ciudades as $pais => $coleccionCiudades){

    foreach ($coleccionCiudades as $ciudades){

        if ($pais == $paisMayor){
            echo $ciudades . ", ";  
        } 
    }   
}

echo "</br></br>";


//Función comparar para usarla en el método de ordenación uasort:

function comparar($a, $b){

    return (strcmp($a["Poblacion"], $b["Poblacion"]));
}

//Ordenamos los países por población de menor a mayor: 

uasort($paises, "comparar");

//Recorremos el array para visualizarlo ordenado

foreach ($paises as $clave => $valor){

    echo $clave . " : " . $valor["Poblacion"]. "\n";
    
}

//Imprimimos el país que aparece último en el array ordenado, que es el de mayor población


foreach ($paises as $clave => $valor){

    echo $clave . " : " . $valor["Poblacion"]. "\n";
    
}

echo "</br></br>";
echo "El país con mayor población, es: ". end(array_keys($paises));


?>