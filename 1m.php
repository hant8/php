<?php

$lang = 'en';

$day = 7;

$arr = [
    'ru' => ['1' => 'Понедельник', '2' => 'Вторник', '3' => 'Среда', 
        '4' =>'Четверг', '5' => 'Пятница', '6' => 'Суббота', '7' => 'Воскресенье'],
    'en' =>['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', 
        '4' =>'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'
    ]
];

echo $arr[$lang][$day];

?>