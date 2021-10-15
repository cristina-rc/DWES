
<?php if (!isset ($_GET["nombre"])): ?>

<form action="ejeformulario1.php" method="GET"> <!--Con método POST no se muestra en la barra del navegador, con GET sí-->
        NOMBRE: <input type="text" name="nombre"><br>
        EDAD: <input type="number" name="valor"><br>

        Marca o no marca: <input type="checkbox" name="casilla1"><br>

        Botón radios:

        Uno <input type="radio" name="opcion" value="1"> <!-- Sólo se puede seleccionar uno porque se llaman igual "opcion"-->
        Dos <input type="radio" name="opcion" value="2">
        Tres <input type="radio" name="opcion" value="3"><br>

        COLOR:
        <select name = "color">
            <option>rojo</option>
            <option>verde</option>
            <option>azul</option>
        </select><br>

        COLORES:
        <select name = "colores[]" multiple size=3> <!--Hay que indicar en selección multiple, que el nombre es un array-->
            <option>rojo</option>
            <option selected = "selected" value = "green">verde</option> <!--por defecto se selecciona el color verde, recibe "green"-->
            <option>azul</option>
            <option>amarillo</option>
            <option>marron</option>
        </select>

        <input type="submit" value="Enviar">

    </form>


<?php else: ?>
<?php

if (isset ($_GET["nombre"])) echo "SIEMPRE<br>"; //Siempre va a existir 
if (empty ($_GET["nombre"])) echo "Está vacío<br>"; //Sólo si está vacía, o no existe

$_GET["nombre"] = strip_tags($_GET["nombre"]);

//Con strip_tags quito las etiquetas html que pueda introducir el usuario en el campo nombre (se limpia)
//con htmlspecialchars(), cualquier marca html no se va a interpretar
//con trim() se eliminan los espacios en blanco

echo "Su nombre es: " . $_GET["nombre"]; //los campos input normales se envían aunque estén en blanco. 

echo "Su edad es: " . $_GET["valor"];


if(isset ($_GET["casilla1"])){
    echo "<br>Has marcado la casilla <br>"; //si existe, está marcado, ya que si no se selecciona nada,  no se envían
}

if(isset ($_GET["opcion"])){
    echo "<br>Has elegido " . $_GET["opcion"] . "<br>"; 
}

echo "<br>Has seleccionado el color: " . $_GET["color"] . "<br>";
echo "<br>Has seleccionado los colores: "; //si no existe, el array no existirá


foreach ($_GET["colores"] as $color){

    echo $color . ", ";

}

echo "<br>";

echo "He recibido los siguientes datos: <br>";

var_dump($_GET);

foreach ($_GET as $clave => $valor){
    echo $clave .", con valor= " . $valor . "<br>";
}

endif?>
