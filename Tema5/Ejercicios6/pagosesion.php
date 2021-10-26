<?php
session_start();

define('INACTIVIDAD', 10);

if(isset($_SESSION["timeout"])){
    $tiempopasado = time() - $_SESSION["timeout"];
}


// Obtengo el valor de cookie
if (isset($_SESION["tarjeta"])) {
$tarjeta = $_SESION["tarjeta"];
}

// Cambio el valor del cookie
if (isset($_GET["nuevatarjeta"])) {
$tarjeta = $_GET["nuevatarjeta"];
} 

?>

<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title>Forma de pago</title> 
    </head> 
    <body> 
        <center> 
        <?php

           
        if($tiempopasado > INACTIVIDAD){
            session_destroy();
            echo "<H2>SESIÓN CANCELADA, VUELVA A ASIGNAR UNA FORMA DE PAGO</H2> </br>";
        
        }else if(!isset($tarjeta)){
            echo "<H2>NO TIENE FORMA DE PAGO ASIGNADA</H2> </br>";

        }else{
            echo "<H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>";
            echo "<img src='imagenes/" . $tarjeta. ".gif'/></a>";
        }

        $_SESSION["timeout"] = time();  

        ?>

        <form action="#" method="GET">
            <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br> 
            <a href='pagosesion.php'><img  src='imagenes/cashu.gif' /></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=mastercard1'><img  src='imagenes/mastercard1.gif'/></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp; 
            <a href='pagosesion.php?nuevatarjeta=visa_electron'><img  src='imagenes/visa_electron.gif'/></a>  
        </center> 
    </form>
    </body> 
</html>