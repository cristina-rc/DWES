<?php

$deportes = [
"Gimnasia" => "img/gimnasia.jpg",
"Crossfit" => "img/crossfit.jpg",
"Ciclismo" => "img/ciclismo.png",
"Padel" => "img/padel.png",
"Pilates" => "img/pilates.jpg"
];


echo "<table border = '1'>";
echo    "<tr>";
echo         "<td align='center'><b>Deporte</b></td>";
echo         "<td align='center'><b>Logo</b></td>";
echo    "</tr>";

foreach($deportes as $key => $valor){
    echo    "<tr>";
    echo         "<td>". $key . "</td>";
    echo         "<td> <img src = '". $valor . "' /></td>";
    echo    "</tr>";
}

echo "</table>";

?>
