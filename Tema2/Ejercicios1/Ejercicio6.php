<?php

$num = random_int(1, 10);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table border = '1'>

    <tr>
        <td>Tabla del <?=$num?></td>
    </tr>

    <?php

    for($i=1; $i<=10; $i++):?>
        <tr>
            <td><?="$num x $i"?></td>
            <td><?=$num*$i?></td>
        </tr>
    <?php endfor ?>

    

</body>
</html>