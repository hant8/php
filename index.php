<?php

require_once('helpers.php');

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$title = 'Главная';
$user = 'Владислав';

/* Массив проектов */
$projects  = [

    'Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'

];
/* Массив задач */
$tasks = [

    1 => [

        'Task' => 'Собеседование в IT компании',
        'Date of completion' => '01.12.2019',
        'Category' => 'Работа',
        'Completed' => false,

    ],
    2 => [

        'Task' => 'Выполнить тестовое задание',
        'Date of completion' => '25.12.2019',
        'Category' => 'Работа',
        'Completed' => false,

    ],
    3 => [

        'Task' => 'Сделать задание первого раздела',
        'Date of completion' => '21.12.2019',
        'Category' => 'Учеба',
        'Completed' => true,

    ],
    4 => [

        'Task' => 'Встреча с другом',
        'Date of completion' => '22.12.2019',
        'Category' => 'Входящие',
        'Completed' => false,

    ],
    5 => [

        'Task' => 'Купить корм для кота',
        'Date of completion' => null,
        'Category' => 'Домашнии дела',
        'Completed' => false,

    ],
    6 => [

        'Task' => 'Заказать пиццу',
        'Date of completion' => null,
        'Category' => 'Домашнии дела',
        'Completed' => false,

    ],

];

$name = 'main.php';
$data = [

    'show_complete_tasks' => $show_complete_tasks,
    'projects' => $projects,
    'tasks' => $tasks

];

$content = include_template($name, $data);

$name = 'layout.php';
$data = ['title' => $title, 'content' => $content, 'user' => $user];

$layout = include_template($name, $data);

echo $layout;

?>