<?php

require_once('helpers.php');

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$title = 'Главная';

/* Данные о пользователе */
$user = 'Владислав';
$id = 1;

/* Подключение к базе анных  */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "", "mydeal_master");

/* Запрос на выборку всех проектов пользователя */
$query = "SELECT projects.name as project_name FROM projects
LEFT JOIN users ON projects.user_id = users.id
WHERE user_id = ?";

/* Данные запроса */
$data = [
    $id
];
/* Функция возвращает подготовленный запрос */
$stmt = db_get_prepare_stmt($link, $query, $data);

/* Функция отправляет подготовленный запрос и извлекает данные */
$projects = reading_data($stmt);

/* Запрос на выборку всех задач пользователя */
$query = "SELECT 
projects.name as project_name,
users.name as user_name,
tasks.name as task_name,
tasks.date as task_date,
tasks.completed as task_completed
FROM
tasks
LEFT JOIN users
ON  tasks.user_id = users.id 
LEFT JOIN projects
ON tasks.project_id = projects.id
WHERE users.id = ?";

/* Функция возвращает подготовленный запрос */
$stmt = db_get_prepare_stmt($link, $query, $data);

/* Функция отправляет подготовленный запрос и извлекает данные */
$tasks = reading_data($stmt);

/* Имя шаблона */
$name = 'main.php';
/* Необходимые данные шаблона */
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