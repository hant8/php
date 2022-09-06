<?php


$price = 10050; /* Программа работает при любом значении price */ 

$number = substr_replace($price, '00', -2, 2); /* Получаем число на которое price будет делится и будет получатся остаток */

$cop = $price % $number; /* Получаем копейки */ 
$number = str_split($price); 
array_splice($number, -2, 2);  
$rub = implode('', $number); /* Получаем рубли */

$rub_slovo = match($rub['-1']){ 
    '0', '5', '6', '7', '8', '9' => 'рублей',
    '1' => 'рубль',
    '2', '3', '4' => 'рубля'

};

$cop = (string) $cop;

$cop_slovo = match($cop['-1']){ 
    '0', '5', '6', '7', '8', '9' => 'копеек',
    '1' => 'копейка',
    '2', '3', '4' => 'копейки'

};


echo "$rub $rub_slovo $cop $cop_slovo<br>"; /* Первый формат */ 

$price = $rub. '.' .$cop;  
$percent = 13; /* Процент */ 
$price = (float)$price ;
$new_price = $price * ($percent / 100) + $price; /* Новая цена с учетом процента */


echo "$new_price руб."; /* Второй формат */

?>