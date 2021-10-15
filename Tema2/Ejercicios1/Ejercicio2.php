<?php
$num = random_int(1, 9);

for($altura=1; $altura<=$num; $altura++){
    for($pintar=0; $pintar<$altura; $pintar++){
        if($altura%2==0){
            echo "<font color='blue'>". $altura."</font>";
        }else{
            echo "<font color='red'>". $altura."</font>";
        }
}

echo ("</br>");

}
?>