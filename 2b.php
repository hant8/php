<?php

$range = [1,50]; 


function rangefunc($arr){

    $range = range($arr[0], $arr[1]); /* Получение диапазона */

    foreach($range as $elem){ 

        $flag = true; /* Устанавливаем флаг-проверку */

        if($elem !== 1 && $elem !== 0){ /* Убираем 0 и 1 */
            
            for($i = 2; $i < $elem; $i++){ /* Все делители */
                
                if($elem % $i === 0){ /* Если число сложное */

                    $flag = false;
                    break;
                }

            }
            if($flag){ 

                $result['simple'][] = $elem;
    
            }else{
    
                $result['hard'][] = $elem;
    
            }
        }
        
    }
    return $result;
}

$all = rangefunc($range);

echo "Простые числа<br><hr>";

foreach($all['simple']  as $elem){
    
    echo "$elem<br>";

}
echo "<br>Не простые<br><hr>";

foreach($all['hard']  as $elem){
    
    echo "$elem<br>";

}

?>