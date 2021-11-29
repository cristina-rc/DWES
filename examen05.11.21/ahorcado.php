<?php

session_start();

//Hacer código limpieza texto
if (!isset($_SESSION['palabrasecreta'])) {
    $_SESSION['palabrasecreta'] = elegirPalabra();
    $_SESSION['letrasusuario'] = []; // Inicialmente no tiene ninguna letra  
    $_SESSION['fallos'] = 0; // Inicialmente no hay ningún fallo
}

if($_SESSION["fallos"]<6){
    if (isset($_GET["accion"])) {
        $letra = htmlspecialchars($_GET["letraElegida"]);
        if(comprobarLetra($letra, $_SESSION['palabrasecreta'])){
            array_push($_SESSION['letrasusuario'], $letra);
    
        }else{
            $_SESSION['fallos']++;
            echo "Has cometido ";
            echo $_SESSION["fallos"];
            echo " fallos";
        }    
    }
}

function elegirPalabra(){
    static $tpalabras = ["madrid","Sevilla","Murcia","Malaga","Mallorca","Menorca"];
    $posicion = array_rand($tpalabras);
    $cadenapalabra = $tpalabras[$posicion];
   
    return $cadenapalabra;   
}

function comprobarLetra($letra, $cadenapalabra){

    if(strpos($cadenapalabra, $letra)===false){
        return false;
    }else{
        return true;
    }
    // COMPLETAR
     // Devuelve true o false si la letra esta en la cadena  
}

/*
 * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición    si cada letra se encuentra en la cadenaletras
 *
 * Ej  generaPalabraconHuecos("aeiou"     ,"hola pepe") -->"-o-a--e-e"
 *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
 *
 */

function generaPalabraconHuecos ($cadenaletras, $cadenapalabra) {

    $resu = $cadenapalabra;
    $msg = "";

    if(empty($cadenaletras)){
        for ($i = 0; $i<strlen($resu); $i++){
            $msg .= "-";
        }
    }else{
        for ($i = 0; $i<strlen($resu); $i++){
            if(in_array($resu[$i], $cadenaletras)){
                $msg .= $resu[$i];
            }else{
                $msg .= '-';
            } 
        }
    }
    // Genero una cadena resultado inicialmente con todas las posiciones con -

    // COMPLETAR rellenado la cadena resu
      
    
    return $msg;
}

$msg2 = generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']);


$palabraAcertada = false;


if(strpos($msg2, "-")===false){
    $palabraAcertada = true;
}


if($_SESSION["fallos"] <= 5 && !$palabraAcertada){

    ?>
    <form action="#" method="GET">
    PALABRA: <?php echo generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']); ?>
    <br>Introduzca una letra: <input type="text" name="letraElegida">
    <input type="submit" name="accion" value="Comprobar"><br>


<?php 
}


if($_SESSION["fallos"]>5){

    session_destroy();
?>

    Superado el máximo número de fallos. Has perdido.

    <input type="button" value=" NUEVO CLIENTE "onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">

<?php
}

if($palabraAcertada){
    
?>

    PALABRA: <?php echo $_SESSION['palabrasecreta'];?>
    <br>Enhorabuena, has acertado
    <input type="button" value=" NUEVO CLIENTE "onclick="location.href='<?=$_SERVER['PHP_SELF'];?>'">
<?php

session_destroy();
}

?>

</form>
<hr>
