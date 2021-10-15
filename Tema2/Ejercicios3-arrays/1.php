<?php

$numeros = [];

for($i=0; $i<20; $i++){
    $numeros[$i] = random_int(1, 10);
}

function mostrarContenido($numeros){

    echo "<table border = '1'>";
        echo "<tr>";

            foreach ($numeros as $valor){
            echo "<td>" . $valor . "</td>";
            }

        echo "</tr>";
    echo "</table>";    
}

function mostrarValorMaximo($numeros){

    $valorMaximo = 0;

    foreach ($numeros as $valor){
        if($valor>$valorMaximo){
            $valorMaximo = $valor;
        }
    }

    echo "El valor máximo es: " . $valorMaximo . "</br>";
}

function mostrarValorMinimo($numeros){

    $valorMinimo = 10;

    foreach ($numeros as $valor){
        if($valor<$valorMinimo){
            $valorMinimo = $valor;
        }
    }

    echo "El valor máximo es: " . $valorMinimo . "</br>";

}

function mostrarModa($numeros){

    $cuenta = array_count_values($numeros);   
    arsort($cuenta);
    echo "La moda es: " . key($cuenta);
}

mostrarContenido($numeros);
mostrarValorMaximo($numeros);
mostrarValorMinimo($numeros);
mostrarModa($numeros);

?>