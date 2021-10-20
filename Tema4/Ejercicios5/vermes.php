<?php
$fechaActual = getDate();

if(!isset($mes)){
    $mes = $_POST["mes"];
}

if(!isset($anio)){
    $anio = $_POST["anio"];
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

<div align = "center"><b>BIENVENIDO AL GENERADOR DE CALENDARIOS</b></div>

<form name="calendario" method="POST">

MES: <select name="mes">
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select><br>

AÑO: <select name="anio">
        <?php

        for($i=1980; $i<=$fechaActual["year"]; $i++){
            echo "<option>$i</option>";
        }
        ?>

    </select><br><br>

    <input type="submit" value="Enviar"><br><br>
    
</form>

</body>
</html>

<?php


$diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

$fechaDia1Mes =  new DateTime("$anio-$mes-01");

echo $fechaDia1Mes->format('Y-m-d');

$diaSemana = $fechaDia1Mes->format('w');

if ($diaSemana == 0){
    $diaSemana =7;
}


echo "<table border='1'>";
echo    "<tr>";
echo         "<td colspan='7'><b> Mes: ".$mes. "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$anio."</b></td>";
echo    "</tr>";
echo    "<tr>";
echo         "<th>L</th>";
echo         "<th>M</th>";
echo         "<th>X</th>";
echo         "<th>J</th>";
echo         "<th>V</th>";
echo         "<th>S</th>";
echo         "<th>D</th>";
echo    "</tr>";

$ultima_celda=$diaSemana+$diasMes;


for($i=1;$i<$ultima_celda;$i++){
    if($i==$diaSemana){
        $day=1;
    }

    if($i<$diaSemana || $i>=$ultima_celda){
        echo "<td>&nbsp;</td>";

    }else{
        echo "<td>$day</td>";

        $day++;
    }

    if($i%7==0){
        echo "</tr><tr>\n";

    }
}

echo "</table>";

?>