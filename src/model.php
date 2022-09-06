<?php

/* Принимаем полученные данные из БД */
function searchData(&$database, $url_key)
{
/* 
Перебераем данные страниц и возвращаем ту страницу значение url_key 
которой совпадает с нашей
*/
    foreach ($database['pages'] as $key => $value){
        if($value['url_key'] == $url_key){
            return $value;
        }
    }
    return false;
};