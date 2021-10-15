<?php

//Nombre
$_GET["nombre"] = strip_tags($_GET["nombre"]);

echo "Nombre: " . $_GET["nombre"] . "<br>";

//Clave
$_GET["clave"] = htmlspecialchars($_GET["clave"]);

echo "Clave: " . $_GET["contraseña"] . "<br>";

echo "Semáforo: " . $_GET["semaforo"] . "<br>";

//Publicidad
if(empty($_GET["publicidad"])){
    echo "Publicidad: NO Publicidad";

}else{
    echo "Publicidad: SI Publicidad";
}

echo "<br>";

//Idiomas
echo "Idiomas: ";

foreach ($_GET["idiomas"] as $idioma){
    echo $idioma . ", ";
}

echo "<br>";

//Año finalización estudios
echo "Año de fin de estudios: " . strip_tags($_GET["anio"]) . "<br>";


//Ciudades - códigos postales

echo "Lista de los códigos postales de provincias: ";

foreach ($_GET["ciudades"] as $ciudad){
    switch($ciudad){

        case "Asturias": echo "33 ";
        break;
        case "Gerona": echo "17 ";
        break;
        case "Madrid": echo "28 ";
        break;
        case "Sevilla": echo "41 ";
    }
}

echo "<br>";


//Comentarios 

echo "Comentarios: " . strip_tags($_GET["comentarios"]);

?>