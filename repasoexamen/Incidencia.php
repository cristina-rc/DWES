<?php

class Incidencia{
    private $fecha;
    private $nombre;
    private $resumen;
    private $prioridad;
    private $ip;

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

    function toString(){
        return $this->fecha . "," . $this->nombre . "," . $this->resumen . "," . $this->prioridad . "," . $this->ip . "\n"; 
    }

    public function getJSONEncode() {
        return json_encode(get_object_vars($this));
    }

}

?>