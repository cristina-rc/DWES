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

        foreach($deportes as $deporte){
            setcookie($deporte, $deporte, time() + 7*24*3600);
        }
    } 

    if (isset($_POST["borrar"])) {
        setcookie("edad", NULL, -1);
        setcookie("sexo", NULL, -1);
        setcookie("deportes", NULL, -1);

        header("Refresh:0"); 
    }

    var_dump($_COOKIE["Futbol"]);
    if(isset($_COOKIE["Futbol"])){
        echo "existe";
    };
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
        <input type="radio" name="sexo" value="mujer" <?php if ($_COOKIE["sexo"] == "mujer"){echo 'checked';}?>>Mujer
        <input type="radio" name="sexo" value="hombre" <?php if ($_COOKIE["sexo"] == "hombre"){echo 'checked';}?>>Hombre<br>
        Deportes: 
        <select name = "deportes[]" multiple size=4>
            <option <?php if (isset($_COOKIE["Futbol"])){echo 'selected="selected"';}?>>Futbol</option>
            <option <?php if (isset($_COOKIE["Tenis"])){echo 'selected="selected"';}?>>Tenis</option>
            <option <?php if (isset($_COOKIE["Ciclismo"])){echo 'selected="selected"';}?>>Ciclismo</option>
            <option <?php if (isset($_COOKIE["Otro"])){echo 'selected="selected"';}?>>Otro</option>
        </select><br>

      <input type="submit" name="almacenar" value="Almacenar cookie">
      <input type="submit" name="borrar"  value="Eliminar valores">
    </form>
    <hr>

</html>