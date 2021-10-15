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

function generarMuralla ($almenas){

    for($i=0; $i<$almenas; $i++){
        for($n=0; $n<4; $n++){
            echo "<img src='/img/ladrillos.jpg' width='20' height='30'>";      
        }
        echo "<img src='/img/blanco.jpg' width='20' height='30'>"; 
    }
    echo "</br>";

    for($j=0; $j<$almenas; $j++){
        for($m=0; $m<4; $m++){
            echo "<img src='/img/ladrillos.jpg' width='20' height='30'>";      
        }
        echo "<img src='/img/blanco.jpg' width='20' height='30'>"; 
    }
    echo "</br>";
    
    for($k=2; $k<=$almenas; $k++){

        for($o=0; $o<5; $o++){
            echo "<img src='/img/ladrillos.jpg' width='20' height='30'>";      
        }
        
        if($k==$almenas){
            for($p=0; $p<4; $p++){
                echo "<img src='/img/ladrillos.jpg' width='20' height='30'>";      
            }
        }
    }
}

generarMuralla(3);

?>

</body>
</html>