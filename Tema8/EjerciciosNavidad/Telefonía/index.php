<?php  
include_once('verpuntos.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CONSULTA DE PUNTOS TELEFONÍA</title>
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
    <?php
        //Obtengo el valor consultando a la BD
        $puntosmax = obtenerPuntosMax();
    ?>
    <script language="JavaScript">
        function validar() {
            valor=parseInt(document.nombreFormulario.puntos.value);
            puntosmaxjs = <?=$puntosmax ?>;

            if(valor> puntosmaxjs) {
                alert("El valor supera el máximo actual");
                return false;
            }
            return true;
        }
    </script>


    <h1>CONSULTA DE PUNTOS TELEFONÍA</h1>
    <form action="verpuntos.php" name="nombreFormulario" method="get" onsubmit="return validar()">
        Indicar un número de puntos para mostrar los clientes que tienen igual o mayor cantidad de puntos que los solicitados:
        <br><br>
        <input type="number" name="puntos"  value=<?=isset($_GET['puntos'])? $_GET['puntos'] : 0?> size=10>
        <br><br>
        <input type="submit" name="accion" value="Consultar">
    </form>
                

    </body>
</html>