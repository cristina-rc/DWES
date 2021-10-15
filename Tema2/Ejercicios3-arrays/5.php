<?php

$bonoloto = [];
$bonoloto2= [];

foreach (range(1, 49) as $i){

    $bonoloto[$i] = $i;

}

for($i = 0; $i < 6; $i++){
    $newNumber = random_int(1, 49);
    if($i>0){

        for($j=0; $j<sizeof($bonoloto2);$j++){
            
            while($newNumber == $bonoloto2[$j]){
                $newNumber = random_int(1, 49);
            }

        }
    
        $bonoloto2[$i] = $newNumber;
    } else {
        $bonoloto2[$i] = $newNumber;
    }
}


$posicionesAleatorias = array_rand($bonoloto, 6);

shuffle($posicionesAleatorias);

var_dump($posicionesAleatorias);

$posicionesaOrdenar = [];

for($i=0; $i<5; $i++){

    $posicionesaOrdenar[$i]=$posicionesAleatorias[$i];
}

var_dump($posicionesaOrdenar);

sort($posicionesaOrdenar);

var_dump($posicionesaOrdenar);


echo "<table border = '1'>";
echo    "<tr>";

for($i=0; $i<5; $i++){

    echo    "<td>". $posicionesaOrdenar[$i] . "</td>";

}

echo        "<td> Complementario " . $posicionesAleatorias[5] . "</td>";
echo    "</tr>";
echo "</table>";

?>