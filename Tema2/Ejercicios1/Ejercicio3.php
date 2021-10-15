<?php
$num = random_int(1, 9);

for($altura=1; $altura<=$num; $altura++){
    for($blancos=1; $blancos<=$num-$altura; $blancos++){
        echo("&nbsp");
    }
    for($asteriscos=1; $asteriscos<=($altura*2)-1; $asteriscos++){
        echo("*");
    }

    echo ("</br>");
}

?>