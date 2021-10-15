<?php
define('NUMS_TOTALES', '50');
define('VALOR_MAX', '100');

$minimo = 100;
$maximo = 0;
$sumaNums = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

for($i=1; $i<=NUMS_TOTALES; $i++){    
    $numGenerado = random_int(1, VALOR_MAX);
    $sumaNums += $numGenerado;

    if($numGenerado<$minimo){
        $minimo = $numGenerado;
    }elseif($numGenerado>$maximo){
        $maximo = $numGenerado;
    }
}

$mediaNums = ($sumaNums/50);

?> 

<table border = '1'>
    <tr>
        <td colspan = '2' style = "color:white" bgcolor = 'black'>Generación de 50 valores aleatorios</td>
    </tr>
    <tr>
    <tr>
        <td>Mínimo</td>
        <td><?=$minimo?></td>
    </tr>
    <tr>
        <td>Máximo</td>
        <td><?=$maximo?></td>
    </tr>
    <tr>
        <td>Media</td>
        <td><?=$mediaNums?></td>
    </tr>

</table>

</body>
</html>

