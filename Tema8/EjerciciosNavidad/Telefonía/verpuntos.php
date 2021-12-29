<?php
// Utilizando el interfaz PDO
$resu = [];

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['puntos'])){

        //Conexión con BBDD        
        try{
            $dsn = "mysql:host=localhost;dbname=telefonia";
            $dbh = new PDO($dsn, "root", "");
        }catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

        // Filtro escapa caracteres peligrosos
        $puntos = $dbh->quote($_GET['puntos']);

        // Sentencia preparada
        $stmt = $dbh->prepare("SELECT * FROM clientes WHERE puntos> ?");
        $stmt->bindValue(1,$_GET['puntos']);

        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }

        verresu($resu);
    }
}

function verresu ($resu){        
    //Muestro la tabla de clientes
    if (count($resu) == 0){
        echo "<br>No hay resultados disponibles.<br>";
    }

    echo "<table border=1>";
    $cabecera=false;
    foreach ($resu as $fila){
        // Genero los campos de la cabeceras de la tabla
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

function obtenerPuntosMax(){
    //Conexión con BBDD        
    try{
        $dxn = "mysql:host=localhost;dbname=telefonia";
        $dch = new PDO($dxn, "root", "");
    }catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }

    $stmt = $dch->prepare("SELECT MAX(puntos) FROM clientes");
    $stmt->execute();
    $puntosmax = $stmt->fetchColumn();

    return $puntosmax;
}
?>