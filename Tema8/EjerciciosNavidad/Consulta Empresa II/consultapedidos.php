<?php  
include_once('AccesoDatos.php');

$db = AccesoDatos::initModelo();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CONSULTAS A EMPRESA</title>
        <style>
            table {
            border-collapse: collapse;
            }
            table, td, th {
            border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>CONSULTA Y PROCESAMIENTO DE PEDIDOS</h1>
        <form name="consulta"  method="POST">
            Indicar el código de cliente: <input type="number" name="cod_cliente"  value=<?=isset($_POST['cod_cliente'])? $_POST['cod_cliente'] : 0?> size=10>
            <br><br>
            <input type="submit" name="accion" value="CONSULTAR">


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($_REQUEST['accion'] == "CONSULTAR"){
        echo "<h2>Pedidos disponibles para entregar</h2>";
        verresu($db->consultaDisp(intval($_POST['cod_cliente'])));

        echo"<h2>Pedidos pendientes</h2>";
        verresu($db->consultaPtes(intval($_POST['cod_cliente'])));
?>

            <br>
            <input type="submit" name="accion" value="PROCESAR PEDIDOS">
            <input type="submit" name="accion" value="CANCELAR">


<?php

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){    
    if ($_REQUEST['accion'] == "PROCESAR PEDIDOS"){
        $db->procesar(intval($_POST['cod_cliente']));

        echo "<h2>Pedidos disponibles para entregar</h2>";
        verresu($db->consultaDisp(intval($_POST['cod_cliente'])));

        echo"<h2>Pedidos pendientes</h2>";
        verresu($db->consultaPtes(intval($_POST['cod_cliente'])));
?>

            <br>
            <input type="submit" name="accion" value="PROCESAR PEDIDOS">
            <input type="submit" name="accion" value="CANCELAR">


<?php
 
    }else if($_REQUEST['accion'] == "CANCELAR"){
        //header???
        include_once("consultapedidos.php");
    }
}


function verresu ($datos){    
    if ( count($datos) == 0){
        echo "<br>No hay resultados disponibles.<br>";
        return;   
    }
    
    echo "<table>";
    $cabecera=false;
    foreach ($datos as $fila){
        // Genero los campos de la caberas de la tabla
        if (!$cabecera){
            echo "<tr>";
            foreach($fila as $clave => $valor){
                echo "<th> $clave </th>";
            }
            echo "</tr>";
            $cabecera=true;
        }
        echo "<tr>";
        foreach($fila as $valor){
            echo "<td> $valor </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>
        </form>
    </body>
</html>
