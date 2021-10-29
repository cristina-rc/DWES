<?php

session_start();

if(isset($_SESSION["nombre"])){
    $nombre = $_SESSION["nombre"];
}else{
    $nombre = $_GET["nombre"];
    $_SESSION["nombre"] = $nombre;
}

if (isset($_SESSION["listaCompra"])) {
  $arrayFrutas = $_SESSION["listaCompra"];
}


if (isset($_POST["anotar"])) {
    $frutaElegida = $_POST["frutas"];
    $cantidad = $_POST["cantidad"];

    $arrayFrutas[$frutaElegida] += $cantidad;

    $_SESSION["listaCompra"] = $arrayFrutas;   

    header("Refresh:0"); 

}

if (isset ($_POST["terminar"])){
    session_destroy();

}
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>

  <h1>La Frutería del siglo XXI</h1>
  <?php
      if (!isset($nombre)) {
          
    ?>
        <b>BIENVENIDO A LA FRUTERÍA DEL SIGLO XXI</b>
        <form action="#" method="get">
          Introduzca su nombre de cliente: <input type="text" name="nombre">
          <input type="submit" name="entrar" value="Iniciar Sesión">
        </form>
    <?php

      }else{

        if(isset($arrayFrutas)){
          echo "<p>Este es su pedido: </p>";
          echo "<table border ='1'><tr><td>";

          foreach($arrayFrutas as $fruta => $cantidad){
              echo "<b> $fruta <b> $cantidad <br>";
          }

          echo "</td></tr></table><br>";

        } 
    ?>
         
        <form action="#" method="post">       

        <b>REALICE SU COMPRA <?php echo $nombre?></b><br>
        Selecciona la fruta:  
        <select name="frutas">
          <option>Naranjas</option>
          <option>Limones</option>
          <option>Plátanos</option>
          <option>Manzanas</option>
        </select>

        Cantidad: <input type="number" name="cantidad">
        <input type="submit" name="anotar" value="Anotar">
        <input type="submit" name="terminar"  value="Terminar">
        </form>
        <hr>

    <?php
        
        if(isset($_POST["terminar"])){

    ?>
          Muchas gracias por su pedido.
          <input type="button" value=" NUEVO CLIENTE "onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">
    <?php
        }
      }
    ?>


</html>
