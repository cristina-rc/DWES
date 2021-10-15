<html>
<head>
<body>
    <form name = "calculadora" method="GET"> <!--no hace falta poner action, ya que es el mismo archivo php el que lo muestra y lo procesa-->
        VALOR 1: <input type="number" name="valor1" value="<?=isset($_GET['valor1'])?$_GET['valor1']:""?>"><br> <!--Poner condición, si existe $valor1 seguir mostrándolo-->
        VALOR 2: <input type="number" name="valor2" value="<?=isset($_GET['valor2'])?$_GET['valor2']:""?>"><br>

        <button name="operacion" value="suma">+</button>
        <button name="operacion" value="resta">-</button>
        <button name="operacion" value="multiplicacion">*</button>
        <button name="operacion" value="division">/</button><br>

        <input type="radio" name="formato" value="decimal" checked>Decimal 
        <input type="radio" name="formato" value="binario">Binario
        <input type="radio" name="formato" value="hexadecimal">Hexadecimal <br>      

    </form>

</body>
</head>
</html>

<?php

    $valor1 = $_GET["valor1"];
    $valor2 = $_GET["valor2"];

    $operacion = $_GET["operacion"];
    $formato = $_GET["formato"];
    
   
    switch($operacion){
        case "suma": $resultado = $valor1+$valor2;
        break;
        case "resta": $resultado = $valor1-$valor2;
        break;
        case "multiplicacion": $resultado = $valor1*$valor2;
        break;
        case "division":
            if($valor2 == 0){
                echo "Error. No es posible dividir entre cero";
            }else{
                $resultado = $valor1/$valor2;
            }
    }

    switch($formato){
        case "binario": $resultado = decbin($resultado);
        break;
        case "hexadecimal": $resultado = dechex($resultado);
        break;
        default:$resultado;
    }

    $msg = "El resultado es $resultado";

    if(isset($resultado)){
        echo $msg;
    }
    
?>