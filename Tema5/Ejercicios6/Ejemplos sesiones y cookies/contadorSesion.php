<?php

  //Las sesiones se guardan en el servidor, y las cookies en el navegador
  //La diferencia entre esta forma y la de cookies, es que al cerrar el navegador, 
  //las cookies se almacenan, y la sesión no (ya que se cierra), a no ser que entres de forma privada
  //En los cookies no se almacena información privada

  // Contador de visitas (Mientras no cierres en navegador 
  session_start(); // Inicio de sesión
  
  $nvisitas = 0;
  if(isset($_SESSION['visitas'])) {
    $nvisitas = $_SESSION['visitas'];
  }
  $nvisitas++;
  if($nvisitas >= 10){
    session_destroy();
  }else{ 
  // Cambio el valor en la variable superglobal
  $_SESSION['visitas'] = $nvisitas;
  // Tambien funciona $_SESSION['visitas']++
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
      echo "Visitas: ".$nvisitas;
    ?>
  </body>
</html>
