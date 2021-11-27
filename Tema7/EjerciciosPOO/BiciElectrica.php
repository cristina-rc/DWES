<?php

class Bicicleta{
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)


    public function __get($name){
        if ( property_exists($this,$name)){
            return $this->$name;
        } else {
            return null;
        }

    }

    public function __set($name, $value){
        if ( property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    // Distancia de la bici a un punto
    function distancia($x, $y){
        return sqrt( ($x-$this->coordx)*($x-$this->coordx)+($y-$this->coordy)*($y-$this->coordy));
    }

    function __toString()
    {
        return "Identificador: $this->id Bateria $this->bateria %";
    }
}

?>

