<?php

$optimist = 0;
$pessimist = 0;

for($i = 0; $i < 100; $i++){ 
    $computer = rand(0,1); /* Оптимист/Пессимист */
    if($computer == 0){
        $pessimist++;
    }else{
        $optimist++;
    }
}

$percent = 100; /* Процент */

if($pessimist > $optimist){
    
    $result = $pessimist*($percent / 100); 
    echo "Пессимист на: $result%";

}elseif($pessimist < $optimist){

    $result = $optimist*($percent / 100);
    echo "Оптимист на: $result%";

}elseif($pessimist == $optimist){

    echo "50 на 50";
}

?>