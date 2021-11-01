<?php

session_start();
$nvisitas = 1;

if(isset($_COOKIE["visitas"])){
    $nvisitas = $_COOKIE["visitas"];       
}

setcookie("visitas", $nvisitas, time() + 30*24*3600);

$puedeJugar= true;

if(isset($_SESSION["dinero"])){
    $dinero = $_SESSION["dinero"];    
}else{
    $dinero = $_GET["dinero"];
    $_SESSION["dinero"] = $dinero;
}


if (isset($_POST["apostar"])) {
    $cantidadApos = (int)($_POST["cantidadApos"]);
    $dinero = (int)$dinero;

    if($cantidadApos>$dinero){
        $puedeJugar = false;
    }else{
        $puedeJugar = true;

        $apuesta = $_POST["apuesta"];

        $numAleatorio = random_int(1, 100);

        if($numAleatorio%2==0){
            $resuAleatorio = "par";
        }else{
            $resuAleatorio = "impar";
        }

        if($apuesta == $resuAleatorio){
            $dinero += $cantidadApos;
            $resultado = "GANASTE";
        }else{
            $dinero -= $cantidadApos;
            $resultado = "PERDISTE";
        }
        $_SESSION["dinero"] = $dinero;
    }

}

if (isset ($_POST["abandonar"])){

    $nvisitas++;
    session_destroy();
    setcookie("visitas", $nvisitas, time() + 30*24*3600);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>

  <?php
      if (!isset($dinero)) {
          
    ?>
        <h1><b>BIENVENIDO AL CASINO</b></h1>
        Esta es su <?=$nvisitas?>ª visita.
        <form action="#" method="GET">
          Introduzca el dinero con el que va a jugar: <input type="number" name="dinero">
          <input type="submit" name="entrar" value="Iniciar Sesión">
        </form>
    <?php

      }else if(!isset($_POST["abandonar"])){

        if($puedeJugar && isset($apuesta)){
          echo "RESULTADO DE LA APUESTA: $apuesta <br>";
          echo $resultado . "<br>";

        }else if(!$puedeJugar){
          echo "Error: no dispone de $cantidadApos euros disponibles.<br>";
        }

        echo "Dispone de $dinero euros para jugar.";
    ?>
         
        <form action="#" method="post">

        Cantidad a apostar: <input type="number" name="cantidadApos"><br>

        Tipo de apuesta:
        <input type = "radio" name="apuesta" value="par"> Par
        <input type = "radio" name="apuesta" value="impar"> Impar <br>


        <input type="submit" name="apostar" value="Apostar Cantidad">
        <input type="submit" name="abandonar"  value="Abandonar el Casino">
        </form>
    
    <?php

      }
        
      if(isset($_POST["abandonar"])){
        echo "Muchas gracias por jugar con nosotros.<br>";
        echo "Su resultado final es de $dinero euros."; 

        header ('Refresh: 5; URL=minicasino.php');
      }
      
    ?>


</html>
