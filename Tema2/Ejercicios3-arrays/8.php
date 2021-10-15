<?php

include_once("infopaises.php");

echo <<<FOO

    <table border = '1'>
        <tr>
            <td><b>País</b></td>
            <td><b>Capital</b></td>
            <td><b>Poblacion</b></td>
            <td><b>Ciudades</b></td>
        </tr>
FOO;

foreach($paises as $clave => $valor){
    echo    "<tr>";
    echo        "<td>" . $clave . "</td>";
    echo        "<td>" . $valor["Capital"] . "</td>";
    echo        "<td>" . $valor["Poblacion"] . "</td>";
     
    echo        "<td>";

    foreach($ciudades as $pais => $coleccionCiudades){
        
        foreach ($coleccionCiudades as $ciudadesInd){
            
            if($pais == $clave){
                echo $ciudadesInd . ", ";

            }                   
        }        
    }
    echo "</td>";      
}

echo    "</tr>";  

echo "</table>";

?>