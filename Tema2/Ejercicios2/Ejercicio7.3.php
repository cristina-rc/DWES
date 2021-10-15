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

function generarTablaColores(){

    $colorGenerado = generarColor();
    $intensidadColor = 100;

    echo "<table border = '2'>";

        for($i=0; $i<10; $i++){
            echo "<tr>";
            $intensidadColor--;

            for($j=0; $j<10; $j++){
                echo "<td bgcolor='#".$colorGenerado ." " .$intensidadColor ."%'width='30px' height='30px'> </td>";
            }
            
            echo "</tr>";

        }

    echo "</table>";
}

function generarColor(){

    $caracteresRGB = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 6;
    return substr(str_shuffle($caracteresRGB), 0, $longitud);
}


generarTablaColores();

?>

</body>
</html>