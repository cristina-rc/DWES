<?php

header("Refresh: 5; URL='Ejercicio7.php'");

$tamanoRojo = random_int(100, 500);
$tamanoVerde = random_int(100, 500);
$tamanoAzul = random_int(100, 500);


echo "<table width='".$tamanoRojo."' bgcolor='#FF0000'>";
echo    "<tr>";
echo        "<td>Rojo</td>";
echo    "</tr>";
echo "</table>";

echo "<table width='".$tamanoVerde."' bgcolor='#00FF00';>";
echo    "<tr>";
echo        "<td>Verde</td>";
echo    "</tr>";
echo "</table>";

echo "<table width='".$tamanoAzul."' bgcolor='#0000FF';>";
echo    "<tr>";
echo        "<td>Azul</td>";
echo    "</tr>";
echo "</table>";

?>