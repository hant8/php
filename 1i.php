<?php

$arr = ['1' => 'Понедельник', '2' => 'Вторник', '3' => 'Среда', 
'4' =>'Четверг', '5' => 'Пятница', '6' => 'Суббота', '0' => 'Воскресенье'];

$date = date('w'); /* Текущий день */

echo $arr[$date];
?>
