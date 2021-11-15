<?php

function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}


function accionPostAlta(){
    $loginRepe = false;
 
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código

    $contenido2 = "";

    foreach($_SESSION['tuser'] as $usuario){
        if($_POST['login'] == $usuario[1]){
            $loginRepe = true;
        }
    }    

    if(!$loginRepe){
        $contenido2="";
        $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
        $_SESSION['tuser'][]= $nuevo; 
        return true;

    }else{
        $contenido2 = "El login introducido ya existe, escoja otro diferente.";
        $nombre  = $_POST['nombre'];
        $login   = $_POST['login'];
        $clave   = $_POST['clave'];
        $comentario = $_POST['comentario'];
        $orden= "Nuevo";
        include_once "layout/formulario.php";
        return false;
    }
}

function accionModificar($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
}

function accionPostModificar($id){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $modificado = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    $_SESSION['tuser'][$id]= $modificado;
}


function accionBorrar($id){
    $nusuariosAnt = count($_SESSION['tuser']);
    unset($_SESSION['tuser'][$id]);

    $idNew=0;

    foreach($_SESSION['tuser'] as $usuario){
        $_SESSION['tuser'][$idNew] = $usuario;
        $idNew++;
    }

    unset($_SESSION['tuser'][$nusuariosAnt-1]);
}

//VolcarDatos(sesion) y cerrar sesión
function accionTerminar(){    
    volcarDatos($_SESSION['tuser']);

    return "Se han guardado los datos correctamente.";  
}

