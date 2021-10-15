<?php

$contadorSeis = 0;
$contadorNums = 0;
$segComienzo = microtime(true);

while($contadorSeis<3){

    $num = random_int(1, 10);
    $contadorNums++;

    if($num==6){
        $contadorSeis++;

    }else{
        $contadorSeis = 0;
    }

    
}

echo($contadorNums);

$segFin = microtime(true);
$segsTotales = $segFin - $segComienzo;

echo (" Han salido tres 6 seguidos tras generar ".$contadorNums ." en " .($segsTotales*1000) ." milisegundos");

?>