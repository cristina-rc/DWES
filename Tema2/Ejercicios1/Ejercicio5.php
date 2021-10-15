<?php

$num1 = random_int(1, 10);
$num2 = random_int(1, 10);

echo "<table border = '1'>";

echo    "<tr>";
echo        "<td bgcolor='#9B9B9B' font color='#0000FF'>Operación</td>";
echo        "<td bgcolor='#9B9B9B' font color='#0000FF'>Resultado</td>";
echo    "</tr>";

echo    "<tr>";
echo        "<td>$num1 + $num2</td>";
echo        "<td>".($num1+$num2) ."</td>";
echo    "</tr>";

echo    "<tr bgcolor='#CAF0F8'>";
echo        "<td>$num1 - $num2</td>";
echo        "<td>".($num1-$num2) ."</td>";
echo    "</tr>";

echo    "<tr>";
echo        "<td>$num1 * $num2</td>";
echo        "<td>".($num1*$num2) ."</td>";
echo    "</tr>";

echo    "<tr bgcolor='#CAF0F8'>";
echo        "<td>$num1 / $num2</td>";
echo        "<td>".($num1/$num2) ."</td>";
echo    "</tr>";

echo    "<tr>";
echo        "<td>$num1 % $num2</td>";
echo        "<td>".($num1%$num2) ."</td>";
echo    "</tr>";

echo    "<tr bgcolor='#CAF0F8'>";
echo        "<td>$num1 ^ $num2</td>";
echo        "<td>".($num1**$num2) ."</td>";
echo    "</tr>";

echo "</table>";

?>