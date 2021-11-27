<?php

session_start();

if (!isset ($_SESSION['saldo'])){
    $_SESSION['saldo'] = 0;
}

$msg = "";


if ( isset($_GET['orden'])){
    switch ($_GET['orden']) {
        case "Ingreso"    : $msg = ingreso($_POST['importe']); break;
        case "Reintegro"   : $msg = reintegro($_POST['importe']); break;
        case "Ver saldo": $msg = verSaldo(); break;
        case "Terminar" : $msg = terminar(); break;
    }
}

function ingreso($importe){

    if($importe<0){
        $msg = "Importe erróneo o importe menor que 0";
    }else{
        $_SESSION['saldo'] += $importe;
        $msg = 'Operación realizada';
    }

    return $msg;
}

function reintegro($importe){

    if(($importe<0) || ($importe>$_SESSION['saldo'])){
        $msg = "Importe erróneo o importe superior al saldo";
    }else{
        $_SESSION['saldo'] -= $importe;
        $msg = 'Operación realizada';
    }
    
    return $msg;
}

function verSaldo(){

    $msg = 'Su saldo actual es de '. $_SESSION['saldo'];

    return $msg;
}

function terminar(){

    session_destroy();

    return $msg;
}


header("Location: minibanco.php?msg=".urlencode($msg));

?>