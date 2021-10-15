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
    echo "<table border = '2'>";

        for($i=0; $i<10; $i++){
            echo "<tr>";

            for($j=0; $j<10; $j++){
                $colorGenerado = generarColor();
                echo "<td bgcolor='".$colorGenerado ."'width='30px' height='30px'> </td>";
            }

            echo "</tr>";
        }

    echo "</table>";
}

function generarColor(){

    $colores = array('red', 'green', 'blue', 'white', 'black');
    return $colores[random_int(0, sizeof($colores))];
}


generarTablaColores();

?>

</body>
</html>