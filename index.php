<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once('helpers.php');

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$title = 'Главная';

/* Данные гостя */
$data = [];

/* Шаблона гостя */
$name = 'tel_guest.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){

    /* Данные о пользователе */
    $user = $_SESSION['user_name'];
    $id = $_SESSION['user_id'];

    /* Подключение к базе анных  */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect("localhost", "root", "", "mydeal_master");

    $projects = projecstUser($id, $link);

    $tasks = tasksUser($id, $link);

    /* Если есть активный проект */
    if(isset($_REQUEST['project_active'])){

        /* Проверка на существование проекта с заданным id */
        $query = "SELECT
        projects.id as project_id
        FROM
        projects
        WHERE projects.id = ?";
        $projects_id = [
            $_REQUEST['project_active']
        ];
        $stmt = db_get_prepare_stmt($link, $query, $projects_id);
        $test = reading_data($stmt);

        /* Если такого проекта не существует */
        if(empty($test)){
            exit(header('Location: /error404/'));
        }
        /* Если проект существует */
        $project_active = strip_tags($_REQUEST['project_active']);
    }
    /* Фильтрация данных от XSS */


    $tasks = !empty($tasks)? xss($tasks): '';
    $projects = !empty($projects)? xss($projects): ''; 

    /* Необходимые данные шаблона */
    $data = [

        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks,
        'project_active' => $project_active??''

    ];

    /* Определяем есть ли полнотекстовый поиск */

    if(isset($_GET['search']) && !empty($_GET['search'])){
        
        $get = strip_tags($_GET['search']);
        $search = searchTasks($get, $link);

        $data['search'] = empty($search)? 'Ничего не найдено по вашему запросу' : $search;         
    }
    /* Имя шаблона */
    $name = 'main.php';
    $content = include_template($name, $data);

}

$content = include_template($name, $data);

$name = 'layout.php';

$data = [
    'title' => $title,
    'content' => $content,
    'user' => $user??'',
    'projects' => $projects??'',
    'tasks' => $tasks??'',
    'project_active' => $project_active??''
];

$layout = include_template($name, $data);

echo $layout;
