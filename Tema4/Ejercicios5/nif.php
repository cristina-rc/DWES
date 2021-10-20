<?php
    $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];


    if (!is_numeric($_POST["dni"])){
        echo "Introduzca caracteres numéricos";

    }else{
        $dni = $_POST["dni"];

        $resto = $dni % 23;
        $letra = $letras[$resto];
        $dniCompleto=  $dni . "-" . $letra;
    }

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
    <form name="nif" method="POST"> <!--no hace falta poner action, ya que es el mismo archivo php el que lo muestra y lo procesa-->

    DNI: <input type="text" name="dni" value="<?=isset($dniCompleto)?$dniCompleto:""?>"><br>
    <input type="submit" name="mostrarLetra" value="Mostrar letra">

</body>
</html>

