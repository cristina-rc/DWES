<?php

//Bienvenida - sexo

if($_POST["sexo"] == "hombre"){
    echo "Bienvenido ";
}elseif($_POST["sexo"] == "mujer"){
    echo "Bienvenida ";
}

//Don-doña

if(($_POST["sexo"] == "hombre")&&($_POST["edad"] == "Mayor de 55")){
    echo "D ";
}elseif(($_POST["sexo"] == "mujer")&&($_POST["edad"] == "Mayor de 55")){
    echo "Dña ";
}

//Imprimir nombre y apellidos

echo $_POST["nombre"] . " " . $_POST["apellidos"];

//Hobbies

if(empty($_POST["hobbies"])){
    echo " no tiene aficiones de nuestra lista.";
    
}elseif(sizeof($_POST["hobbies"]) == 1){
    echo " su única afición es ";

    foreach($_POST["hobbies"] as $aficion){
        echo $aficion;
    }

}else{
    echo " sus aficiones son: ";

    foreach($_POST["hobbies"] as $aficion){
        echo $aficion . ", ";
    }
}

?>