<?php

require_once "BiciElectrica.php"; 
session_start();


// Programa principal
$tabla = [];

if (isset ($_SESSION['bicis'])){
    $tabla = $_SESSION['bicis'];
}

function anadirBici(){
    $bici = new Bicicleta();

    $bici->id = $_GET['id'];
    $bici->coordx = $_GET['coordxNew'];
    $bici->coordy = $_GET['coordyNew'];
    $bici->bateria = $_GET['bateria'];

    $_SESSION['bicis'][] = $bici; 
}


function mostrartablabicis($tbicis): string{
    $msg = "<table><th>Id</th><th>Coord X</th><th>Coord Y</th><th>Bateria</th>";
    foreach ($tbicis as $bici) {
        $msg .= "<tr>";
        $msg .= "<td>$bici->id </td>\n";
        $msg .= "<td>$bici->coordx </td>\n";
        $msg .= "<td>$bici->coordy </td>\n";
        $msg .= "<td>$bici->bateria% </td>\n";
        $msg .= "</tr>";
    }
    $msg .= "</table>";

    return $msg;
}

function bicimascercana($x, $y, $tabla){

    $biciMaxProxima = array_shift($tabla);
    $distanciamin = $biciMaxProxima->distancia($x, $y);
    foreach ($tabla as $bici) {
        $distancia = $bici->distancia($x, $y);
        if ($distancia < $distanciamin) {
            $distanciamin = $distancia;
            $biciMaxProxima = $bici;
        }
    }

    return $biciMaxProxima;
}


if (isset ($_GET['orden'])){
    switch ($_GET['orden']) {
        case "Añadir"    : 
            anadirBici(); 
            var_dump($_SESSION['bicis']);
            break;
        case "Consultar"   : $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla); break;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>MOSTRAR BICIS OPERATIVAS</title>
<style>
table, th, td {
border: 1px solid black;
}
</style>

</head>

<body>
    <h1> Listado de bicicletas operativas </h1>
    <?= mostrartablabicis($tabla); ?>
    <?php if (isset($biciRecomendada)) : ?>
        <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
    <?php else : ?>
                <form>                
                <h2> Añadir bicicleta: </h2>
                    Id: <input type="number" name="id"><br>
                    Coordenada X: <input type="number" name="coordxNew"><br>
                    Coordenada Y: <input type="number" name="coordyNew"><br>
                    Batería: <input type="number" name="bateria"><br>
                    <input type="submit" name = "orden" value="Añadir">
                <h2> Indicar su ubicación: </h2>
                    Coordenada X: <input type="number" name="coordx"><br>
                    Coordenada Y: <input type="number" name="coordy"><br>
                    <input type="submit" name = "orden" value="Consultar">
                </form>
    <?php endif ?>
</body>

</html>