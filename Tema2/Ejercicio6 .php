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
        echo "****&nbsp;&nbsp;";      
    }
    echo "</br>";

    for($j=0; $j<$almenas; $j++){
        echo "****&nbsp;&nbsp;";     
    }
    echo "</br>";
    
    for($k=2; $k<=$almenas; $k++){
        echo "*****";  
        
        if($k==$almenas){
            echo("****");
        }
    }
}

generarMuralla(3);

?>

</body>
</html>