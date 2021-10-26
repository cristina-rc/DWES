<?php

session_start();

if(isset($_SESSION['aleatorio'])){
    $aleatorio = $_SESSION['aleatorio'];
}else{
    $aleatorio = rand(1, 20);
    $_SESSION['aleatorio'] = $aleatorio;
}

if(isset($_SESSION['oportunidades'])) {
    $oportunidades = $_SESSION['oportunidades'];
}

if($oportunidades>5){
    session_destroy();
    echo "<h2> Ha agotado sus oportunidades</h2>";
}else{
    $_SESSION['oportunidades']++;
}

$numeroIntro = $_POST["numero"];

if(isset($numeroIntro)){
    if($numeroIntro<$aleatorio && $oportunidades<=5){
        echo "El número es mayor";
    }else if($numeroIntro>$aleatorio && $oportunidades<=5){
        echo "El número es menor";
    }else if ($numeroIntro == $aleatorio && $oportunidades<=5){
        echo "Enhorabuena, ha adivinado el número!";
    }
}
echo "<br>" . $aleatorio . "<br>";
echo $numeroIntro . "<br>";
echo $oportunidades;

if(isset($_POST["borrar"])){
    session_destroy();
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
      if(!isset($numeroIntro)){
          echo "Introduzca un número entre el 1 y el 20.<br>";
          echo "Tiene 5 oportunidades para adivinar el número generado";
      }
    ?>
    <form action='#' method='POST'>
      Número: <input type="number" name="numero"><br>
      <input type="submit" name="comprobar" value="Comprobar"><br>
      <input type="submit" name="borrar" value="Nueva partida">


    </form>
  </body>
</html>
