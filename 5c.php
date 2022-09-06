<?php

$IP_1 = '123.123.123.123'; /*Формат 1*/
/* $IP_2 = 3232235777;  Формат 2 */

$IP = $IP_1 ?? $IP_2; 


if(is_string($IP)){ /* Определит если это формат 1 */

    echo "Введеный формат IP4 $IP<br>";
    function separation($IP, $start, $finish){ /* Функция на вырезание значений из IP4*/

        return substr($IP, $start, $finish);

    }

    $numberY_4 = strpos($IP, '.');  /* Порядковый номер первой точки */
    $length = $numberY_4; /* Длинна первого значения всегда будет равнятся порядковому номеру первой точки */
    $Y_4 = separation($IP, 0, $length); /* Получаем первое число */

    $numberY_3 = strpos($IP, '.', $numberY_4 + 1);  /* Порядковый номер второй точки */
    $length =  $numberY_3 - ($numberY_4 + 1);  /* Вычисляем длинну второго значения */
    $Y_3 = separation($IP, $numberY_4 + 1, $length); /* Получаем второе число */

    $numberY_2 = strpos($IP, '.', $numberY_3 + 1); /* Порядковый номер третьей точки */
    $length =  $numberY_2 - ($numberY_3 + 1); /* Вычисляем длинну третьего значения */
    $Y_2 = separation($IP, $numberY_3 + 1, $length); /* Получаем третье число */

    $length =  strlen($IP) - $numberY_2 + 1; /* Длинна последнего значения */
    $Y_1 = separation($IP, $numberY_2 + 1, $length); /* Получаем последнее число */

    /* Проверка  на правильное получение значений IP4
        $result = []; 
        array_push($result, $Y_4, $Y_3, $Y_2, $Y_1);
        var_dump($result);
    */

    $IP_new_format = $Y_1 * 256 ** 0 + $Y_2 * 256 ** 1 + $Y_3 * 256 ** 2 + $Y_4 * 256 ** 3; /*  Алгоритм перевода строковой записи IP4 в числовую  */
    
    echo "Альтернативная запись введеного IP = $IP_new_format";

}elseif(is_int($IP)){ /* Определит если это формат 2 */
    
    echo "Введеный формат числовой $IP<br>";
    $IP = decbin($IP); /* Кодирование в двоичную систему счисления */
    $IP = (string)$IP;

    if(strlen($IP) !== 32){ /* Подводим все результаты к одному формату по 8 цифр на значение */
        $fill = 32 - strlen($IP); /* Находим недостающую разницу */
        $IP = str_repeat('0', $fill).$IP; /* Добавление */
    }
    $IP = str_split($IP, 8); /* Делим двоичную систему по 8 цифр */
    function func($elem){ /* Функция на перевод в десятичную систему счисления */

        return bindec($elem);

    }

    $IP = array_map('func', $IP); 
    $IP_new_format = implode('.',  $IP);
    echo "Альтернативная запись введеного IP = $IP_new_format";
}
?>