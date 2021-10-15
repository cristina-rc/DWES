<?php

$usuarios=[
    "cristina91" => "taza",
    "juanjo89" => "coche",
    "tere70" => "gafas"
];
//Si el nombre o la clave están vacíos (empty), puede mostrar un mensaje de error (datos vacíos) y un botón para volver atrás
$usuarioGET = strip_tags($_GET["usuario"]);
$claveGET = $_GET["clave"];

$usuarioEncontrado = false;
$mostrarFormulario = true;

if(empty($_GET["usuario"]) || empty($_GET["clave"])){
    $msg= "Error, no ha introducido los valores de usuario y/o contraseña";
}else{
    foreach ($usuarios as $usuario => $clave){
        if(($usuarioGET == $usuario) && ($claveGET == $clave)){
            $usuarioEncontrado = true;  
            break;
        }        
    }
    
    if($usuarioEncontrado){
        $msg= "¡Bienvenido, $usuarioGET!";
        $mostrarFormulario = false;
    
    }else{
        $msg = "Ha habido un error en el inicio de sesión, por favor, vuelva a introducir sus datos";
    }
}

?>

<?= isset($msg)?$msg:"" ?>

<?php if ($mostrarFormulario): ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form name = "entrada" method="GET"> <!-- sin action se procesa en el mismo archivo -->
    <label>Usuario</label><input type="text" name="usuario"><br>
    <label>Contraseña</label><input type="password" name="clave"><br>
    <input type="submit" value="Iniciar sesión">
</form>

</body>
</html>

<?php endif; ?>