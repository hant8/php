<?php

/* $_SERVER['SCRIPT_NAME'] - путь к текущему исполняемому скрипту 
Определяем какая страница и какие данные должны загрузится
*/
$url_key_acive = match ($_SERVER['SCRIPT_NAME']) {
    '/index.php' => '/index.php',
    '/catalog.php' => '/catalog.php',
    '/bytovka.php' => '/bytovka.php',
    '/articles.php' => '/articles.php',
    '/contacts.php' => '/contacts.php',
    '/delivery.php' => '/delivery.php',
    '/photogallery.php' => '/photogallery.php',
    '/price.php' => '/price.php'
};
    printPage($url_key_acive, $database);


/* Функция подключает файл в котором находится данная страница */

function printPage($url_key, &$database){
    /* Данные о странице */
    $data = searchData($database, $url_key);
    /* Проверка что данные не пустые и что указанный файл существует */
    if(!empty($data) && file_exists(PATH_TPL . $data['tpl'])){
        include_once(PATH_TPL . $data['tpl']);
    }else{
        die('в базе данных нет данных для вызываемой страницы');
    }
    
}