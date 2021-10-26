
<?php
// CONTADOR DE VISITAS MEDINATE COOKIE ( Dura 30 dias sin borrarse aprox)
$nvisitas = 0;
// Si existe el cookie lo muestro
if (isset($_COOKIE["visitas"])){
    $nvisitas = $_COOKIE["visitas"];
}
$nvisitas++;

//Si visitas > 10, borro el cookie asignándole un tiempo en negativo
if($nvisitas >= 10){
  setcookie("visitas", $nvisitas, time() - 60);
}else{
  setcookie("visitas", $nvisitas, time() + 30*24*3600);
}
// Vuelvo a fijar el valor de cookie válido por un mes


//si pongo el setcookie en el script php de abajo, fallaría, hay que ponerlo arriba  del todo

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
      echo "Visitas: $nvisitas ";
    ?>
  </body>
</html>



