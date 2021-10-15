<?php

function generarHTMLTable($filas, $columnas, $borde, $contenido){
    echo "<table border = '" .$borde ."'>";

        for($i=0; $i<$filas; $i++){
            echo "<tr>";

            for($j=0; $j<$columnas; $j++){
                echo "<td>" .$contenido ."</td>";
            }

            echo "</tr>";
        }

    echo "</table>";
}
generarHTMLTable(5, 4, 2, "Cris");

?>