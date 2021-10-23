<?php
function usuarioOk($usuario, $contraseña) :bool {
  
   return (strlen($usuario) >= 8 && $contraseña == strrev($usuario));
    
}


function calPalabras($comentario) :int {

   $arrayPalabras = explode(' ', $comentario); 
   $numPalabras = sizeof($arrayPalabras);

   return $numPalabras;
}


function letrasRepetidas($comentario) :string{

   $comentario = str_replace(' ', '', $comentario);

   $letrasRepetidas = [];
   $msgLetras = '';
   $repeticionesMax = 0;


   for($i=0; $i<strlen($comentario); $i++){
      if(substr_count($comentario, $comentario[$i]) > $repeticionesMax){
         $repeticionesMax = substr_count($comentario, $comentario[$i]);
      }
   }

   for($i=0; $i<strlen($comentario); $i++){
      if(substr_count($comentario, $comentario[$i]) == $repeticionesMax){
         array_push($letrasRepetidas, $comentario[$i]);
      }
   }
   
   $letrasRepetidas = array_unique($letrasRepetidas);

   foreach($letrasRepetidas as $letra){
      $msgLetras .= $letra . " ";
   }

   return $msgLetras;
}

function palabrasRepetidas($comentario) :string{

   $arrayPalabras = explode(' ', $comentario);
   $arrayPalabras = array_unique($arrayPalabras);

   $palabrasRepetidas = [];
   $msgPalabras = '';
   $repeticionesMax = 0;
   

   foreach ($arrayPalabras as $palabra){
      if(substr_count($comentario, $palabra) > $repeticionesMax){
         $repeticionesMax = substr_count($comentario, $palabra);
      }
   }

   foreach ($arrayPalabras as $palabra){
      if(substr_count($comentario, $palabra) == $repeticionesMax){
         array_push($palabrasRepetidas, $palabra);
      }
   }

   foreach($palabrasRepetidas as $palabra){
      $msgPalabras .= $palabra . " ";
   }


   return $msgPalabras;
}

