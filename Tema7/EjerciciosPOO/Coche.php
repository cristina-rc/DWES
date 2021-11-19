<?php

class Coche
{
    // Definir los atributos
    private $modelo;
    private $distanciaTotal;
    private $distanciaParcial;
    private $motor;
    private $velocidad;
    private $velocidadMax;
    
    // Completar los métodos
    
    function __construct ( String $modelo, int $velocidadMax){
        $this->modelo = $modelo;
        $this->velocidadMax = $velocidadMax;
        $this->distanciaTotal = 0;
        $this->distanciaParcial = 0;
        $this->motor = false;
        $this->velocidad = 0;
    }
    
    public function  arrancar():bool{

        if(!$this->motor){
            $this->motor = true;
            return true;
        }else{
            $this->infoError("El vehículo ya se encuentra arrancado<br>");
            return false;
        }
    }
    
    public function parar():bool{

        if(!$this->motor){
            $this->infoError("El vehículo ya se encuentra parado<br>");
            return false;
        }else{
            $this->motor = false;
            $this->distanciaParcial = 0;
            $this->velocidad = 0;
            return true;
        }
    }
    
    public function acelera( int $cantidad):bool{

        if(($this->velocidad + $cantidad) > $this->velocidadMax){
            $this->velocidad = $this->velocidadMax;
            $this->infoError("Se ha alcanzado la velocidad máxima<br>");
            return false;
        
        }elseif(!$this->motor){
            $this->infoError("El vehículo no se encuentra arrancado<br>");
            return false;
        
        }else{
            $this->velocidad += $cantidad;
            return true;
        }
    }
    
    public function frena (int $cantidad):bool{

        if($this->velocidad == 0 || !$this->motor){
            $this->infoError("El vehículo se encuentra parado<br>");
            return false;
        }else{
            if($this->velocidad - $cantidad<0){
                $this->velocidad = 0;
            }else{
            $this->velocidad -= $cantidad;
            }            
            return true;
        }
    }
    
    public function recorre ():bool{

        if(!$this->motor){          
            $this->infoError("El vehículo no se encuentra arrancado<br>");
            return false;

        }else{
            $this->distanciaParcial = $this->velocidad;
            $this->distanciaTotal += $this->velocidad;
            return true;
        }    
    }
    
    public function info():string{
        if(!$this->motor){
            $estado = "parado";
        }else{
            $estado = "arrancado";
        }
        return "Modelo: " . $this->modelo . " Velocidad actual: " . $this->velocidad . " Estado: ". $estado . " Km parciales: " . $this->distanciaParcial . " Km totales: " . $this->distanciaTotal . "<br>";
    }
    
    public function getKilometros():int{
        return $this->distanciaTotal;
    }
    
    private function infoError( String $mensaje):void{
        echo $mensaje;
    }	
}

