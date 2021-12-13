<?php
include_once "Producto.php";

function accionBorrar ($num_product){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarProducto($num_product);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function accionAlta(){
    $product = new Producto();
    $product->PRODUCTO_NO  = "";
    $product->DESCRIPCION   = "";
    $product->PRECIO_ACTUAL   = "";
    $product->STOCK_DISPONIBLE = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($num_product){
    $db = AccesoDatos::getModelo();
    $product = $db->getProducto($num_product);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($num_product){
    $db = AccesoDatos::getModelo();
    $product = $db->getProducto($num_product);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $product = new Producto();
    $product->PRODUCTO_NO  = $_POST['numero'];
    $product->DESCRIPCION   = $_POST['descripcion'];
    $product->PRECIO_ACTUAL   = $_POST['precio'];
    $product->STOCK_DISPONIBLE = $_POST['stock'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($product);
    
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $product = new Producto();
    $product->PRODUCTO_NO  = $_POST['numero'];
    $product->DESCRIPCION   = $_POST['descripcion'];
    $product->PRECIO_ACTUAL   = $_POST['precio'];
    $product->STOCK_DISPONIBLE = $_POST['stock'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($product);
    
}

