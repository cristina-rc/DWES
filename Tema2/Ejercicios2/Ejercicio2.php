<?php
require_once('funcionesvar.php');
$valor1 = random_int(1, 10);
$valor2 = random_int(1, 10);

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
         
        $resultadoSuma = calSuma($valor1, $valor2);      
        $resultadoResta = calResta($valor1, $valor2);     
        $resultadoMultip = calMultip($valor1, $valor2);     
        $resultadoDiv = calDiv($valor1, $valor2);     
        $resultadoResto = calProducto($valor1, $valor2);    
        $resultadoPotencia = calPotencia($valor1, $valor2);     
        

        echo $valor
    ?>

    <p><?=$valor1?> + <?=$valor2?> = <?=$resultadoSuma?></p>
    <p><?=$valor1?> - <?=$valor2?> = <?=$resultadoResta?></p>
    <p><?=$valor1?> * <?=$valor2?> = <?=$resultadoMultip?></p>
    <p><?=$valor1?> / <?=$valor2?> = <?=$resultadoDiv?></p>
    <p><?=$valor1?> % <?=$valor2?> = <?=$resultadoResto?></p>
    <p><?=$valor1?> ^ <?=$valor2?> = <?=$resultadoPotencia?></p>

</body>
</html>