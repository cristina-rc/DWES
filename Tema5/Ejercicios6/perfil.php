<?php
    if (isset($_COOKIE["edad"])) {
        $edad = $_COOKIE["edad"];
    }else if(isset($_COOKIE["sexo"])){
        $sexo = $_COOKIE["sexo"];
    }else if(isset($_COOKIE["deportes"])){
        $deportes = $_COOKIE["deportes"];
    }

    if (isset($_POST["almacenar"])) {
        $edad = $_POST["edad"];
        setcookie("edad", $edad, time() + 7*24*3600);

        $sexo = $_POST["sexo"];
        setcookie("sexo", $sexo, time() + 7*24*3600);

        $deportes = $_POST["deportes"];

        $deportesString = implode(" ", $deportes);

        setcookie("deportes", $deportesString, time() + 7*24*3600);

    } 

    if (isset($_POST["borrar"])) {
        setcookie("edad", NULL, -1);
        setcookie("sexo", NULL, -1);
        setcookie("deportes", NULL, -1);

        header("Refresh:0"); 
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    
    <form action="#" method="POST">
        Edad:  <input type="number" name ="edad" value="<?=isset($edad)?$edad:""?>"><br>
        <input type="radio" name="sexo" value="mujer" <?php if ($sexo == "mujer"){echo 'checked';}?>>Mujer
        <input type="radio" name="sexo" value="hombre" <?php if ($sexo == "hombre"){echo 'checked';}?>>Hombre<br>
        Deportes: 
        <select name = "deportes[]" multiple size=4>
            <option <?php if (stripos($deportesString, 'Futbol')!==false){echo 'selected="selected"';}?>>Futbol</option>
            <option <?php if (stripos($deportesString, 'Tenis')!==false){echo 'selected="selected"';}?>>Tenis</option>
            <option <?php if (stripos($deportesString, 'Ciclismo')!==false){echo 'selected="selected"';}?>>Ciclismo</option>
            <option <?php if (stripos($deportesString, 'Otro')!==false){echo 'selected="selected"';}?>>Otro</option>
        </select><br>

      <input type="submit" name="almacenar" value="Almacenar cookie">
      <input type="submit" name="borrar"  value="Eliminar valores">
    </form>
    <hr>

</html>
