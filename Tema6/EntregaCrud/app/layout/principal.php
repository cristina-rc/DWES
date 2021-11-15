<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.0</h1>
</div>
<div id="content">
<?= $contenido ?>
<?php if(isset($_GET['orden']) && $_GET['orden']=="Terminar"){
}else{
?>
    <form>
    <input type="submit" name="orden" value="Nuevo">
    <input type="button" name="orden" value="Terminar" onclick="confirmarTerminar()"></input><br>
    </form>
    </div>
    </div>
    </body>
<?php
}
?>

