<?php

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$contrasena1 = $_POST["contrasena1"];
$contrasena2 = $_POST["contrasena2"];

$errores = [
    "Algún campo se encuentra vacío<br>",
    "El email introducido no es correcto<br>",
    "Los dos valores de la contraseña no coinciden<br>",
    "La contraseña introducida no cumple las reglas de seguridad<br>"
];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name="registro" method="POST"> <!--no hace falta poner action, ya que es el mismo archivo php el que lo muestra y lo procesa-->

    Nombre: <input type="text" name="nombre" value="<?=isset($nombre)?$nombre:""?>"><br>
    Correo Electrónico: <input type="email" name="email" value="<?=isset($email)?$email:""?>"><br>
    Contraseña: <input type="password" name="contrasena1"><br>
    Repita su contraseña: <input type="password" name="contrasena2"><br>
    
    <input type="submit" name="enviar" value="Enviar">

    </form>

</body>
</html>

<?php

$campoVacio = false;

foreach($_POST as $nombre_campo => $valor){

    if(empty($valor)){
        $campoVacio = true;        
    }
}


if($campoVacio == true){
    $msg = $errores[0];

}else{
    if(!validarEmail($email)){
        $msg .= $errores[1];
    
    }else if(!clavesIguales($contrasena1, $contrasena2)){
        $msg .= $errores[2];
    
    }else{
        if(!seguridadClave($contrasena1)){
            $msg .= $errores[3];
    
        }else{
            $msg .= "Usuario . $nombre - registrado correctamente";            
        }
    }        
}

echo $msg;


function validarEmail($email){
  return (false !== strpos($email, "@") && false !== strpos($email, "."));
}

function clavesIguales($contrasena1, $contrasena2){
    if($contrasena1 != $contrasena2){
        return false;
    }
    return true;
}

function seguridadClave($contrasena1){
    $numCaracteres = strlen($contrasena1);
    $mayusculas = false;
    $minusculas = false;
    $numeros = false;
    $alfanumericos = false;

    $contrasenaArray = str_split($contrasena1);

    for($i=0; $i<sizeof($contrasenaArray); $i++){

        if(ctype_upper($contrasenaArray[$i])){
            $mayusculas = true;

        }else if(ctype_lower($contrasenaArray[$i])){
            $minusculas = true;

        }else if(is_numeric($contrasenaArray[$i])){
            $numeros = true;

        }else if(!is_numeric($$contrasenaArray[$i]) && (!ctype_alpha($contrasena1[$i]))){
            $alfanumericos = true;
        }
    }


    echo $mayusculas, $minusculas, $numeros, $alfanumericos;

    if($numCaracteres>=8 && $mayusculas && $minusculas && $numeros && $alfanumericos){
        return true;
    }

    return false;

}

?>