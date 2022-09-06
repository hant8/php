<?php

session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('helpers.php');

/* Подключение к базе анных  */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "", "mydeal_master");
$title = 'Добавить проект'; 

/* Данные о пользователе */
$user = $_SESSION['user_name'];
$id = $_SESSION['user_id'];

$projects = projecstUser($id, $link);

$name = 'tel_addproject.php';

$data = [

    'projects' => $projects
    
];

/* Если форма была отправлена */
if(isset($_POST['addproject'])){

    /* Фильтрация данных от XSS */
    $request = xss($_POST); 
    /* Соханяем введенные данные в сессию */
    $_SESSION['projectName'] = $request['project_name'];
    /* Массив ошибок */
    $errors = [];
    /* Проверки на заполнение всех обязательных полей */
    empty($request['project_name'])? $errors['errorProjectName'] = 'Имя проекта не должно быть пустым' : '';
    uniqueProject($id, $request['project_name'], $link)=== true? $errors['errorProjectUnique'] = 'Проект с таким название уже существует' : '';

    /* Если есть ошибки валидации */
    if(!empty($errors)){
        $data['errors'] = $errors;
    }else{
        addProject($id, $request['project_name'], $link);
        header('Location: index.php');
    } 
}

$content = include_template($name, $data);

$name = 'layout.php';
$data = [

    'title' => $title,
    'content' => $content,
    'user' => $user,
    'tasks' => $tasks??'',
    'projects' => $projects??''
    
];



$layout = include_template($name, $data);


echo $layout;













