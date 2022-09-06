<?php

/* Определяем именнованную константу

$_SERVER['DOCUMENT_ROOT'] - дирректория текущего документа */

define('ROOT_PATCH', $_SERVER['DOCUMENT_ROOT']);

/* Определяем пути для подключения подсистем и шаблонов */
const PATH_SRC = ROOT_PATCH . '/src/'; 
const PATH_TPL = ROOT_PATCH . '/templates/';

$baseFiles = [];

/* Полные пути для подключения всех нужных файлов */

/* Подсистемы */
$baseFiles[] = PATH_SRC . 'database.php';
$baseFiles[] = PATH_SRC . 'model.php';
$baseFiles[] = PATH_SRC . 'controller.php';

/* Подключаем файлы по указанным путям */

foreach($baseFiles as $key => $value){

    include_once($value);

}