<?php

$temperaturas =  [ 6, 10, 12, 14, 16 ,20 ,25 , 30, 18, 15, 14, 8];
$meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
$mesTemperatura = [];


for($i = 0; $i<sizeof($meses); $i++){

    $mesTemperatura = array_merge($mesTemperatura, ["$meses[$i]" => "$temperaturas[$i]"]);    
}


echo "<table border = '1'>";

foreach ($mesTemperatura as $mes => $temperatura){

    echo "<tr>";
    echo "<td>$mes</td>";
    echo "<td> <img src='img/barra.png' width = ".($temperatura*5)."px height = 10 px>" . $temperatura . "ºC</td>";
    echo "</tr>";

}
echo "</table>";

?>