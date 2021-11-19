<?php

class Reloj
{
    private $segundos;
    private $formato24;
    
    public function __construct (int $hora, int $minutos, int $segundos){
        $segHora = $hora * 3600;
        $segMinutos = $minutos * 60;
        $this->segundos = $segHora + $segMinutos + $segundos;
        $this->formato24 = true;
    }
    
    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    
    public function mostrar(){
        
        $hora = floor($this->segundos/3600);
        $minutos = floor(($this->segundos - ($hora * 3600))/60);
        $segundos = $this->segundos - ($hora*3600) - ($minutos*60);

        if($minutos<10){
            $minutos = "0" . $minutos;
        }elseif ($segundos<10) {
            $segundos = "0" . $segundos;
        }

        if(!$this->formato24){
            if($hora>12){
                $hora = $hora-12;

                return $hora . ":" . $minutos . ":" . $segundos . "pm";

            }else{
                return $hora . ":" . $minutos . ":" . $segundos . "am";
            }
        }else{
            return $hora . ":" . $minutos . ":" . $segundos;
        }
    }
    
    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24(bool $formato24){
        $this->formato24 = $formato24;
    }
    
    // Incrementa en un segundo el valor de reloj
    public function tictac (){
        $this->segundos++;
        $hora = $this->segundos/3600;


        if($hora>24){
            $this->segundos = 0;                  
        }
    }
    
    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia
    
    public function comparar (Reloj $otroreloj){

        $otroreloj->cambiarFormato24(true);
        $this->cambiarFormato24 = true;

        $horaCompleta = $otroreloj->mostrar();

        $hora = (int)(substr($horaCompleta, 0, 3));
        $minutos = (int)(substr($horaCompleta, 3, 6));
        $segundos = (int)(substr($horaCompleta, 6, 9));

        $segHora = $hora * 3600;
        $segMinutos = $minutos * 60;
        $segTotales = $segHora + $segMinutos + $segundos;
        
        return $this->segundos - $segTotales;
    }    
}




