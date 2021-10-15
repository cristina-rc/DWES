<?php
   function elMayor ($a,$b,&$c){
       
       if($a==$b){
           $c = 0;
       }elseif($a>$b){
           $c = $a;
       }else{
           $c = $b;
       }
   }
   
?>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<?php
    $resu = 0;
    $uno = 1;
    $dos = 2;
    elMayor($uno, $dos, $resu);


   echo "Valor $resu";
?>
</body>
</html>