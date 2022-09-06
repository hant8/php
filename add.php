<?php

session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('helpers.php');

/* Подключение к базе анных  */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "", "mydeal_master");
$title = 'Добавить задачу'; 

/* Данные о пользователе */
$user = 'Владислав';
$id = 1;

$projects = projecstUser($id, $link);
$tasks = tasksUser($id, $link);

$name = 'tel_add.php';

$data = [

    'projects' => $projects
    
];

/* Если форма была отправлена */
if(isset($_POST['submit'])){

    /* Фильтрация данных от XSS */
    $request = xss($_POST); 
    /* Соханяем введенные данные в сессию */
    $_SESSION['taskName'] = $request['name'];
    /* Массив ошибок */
    $errors = [];
    /* Проверки на заполнение всех обязательных полей */
    empty($request['name'])? $errors['errorTaskName'] = 'Имя задачи не должно быть пустым' : '';
    empty($request['project'])? $errors['errorTaskProject'] = 'Выберите проект' : '';
    /* Проверка на правильный формат даты */
    if(!empty($request['date'])){
        /* Соханяем введенные данные в сессию */
        $_SESSION['taskDate'] = $request['date'];
        is_date_valid($request['date']) === false? $errors['errorTaskDateFormat'] = "Переданная дата не соответствует формату 'ГГГГ-ММ-ДД'" : '';
        /* Текущий день */
        $day = date('Y-m-d');
        /* Проверка на корректность заданной даты */
        if($request['date'] !== $day && strtotime($request['date']) < strtotime($day)){
            $errors['errorTaskDate'] = "Дата должна быть больше или равна текущей";
        }
    }else{
        $request['date']  = null;
    }

    /* Проверка на существование проекта с переданным id */
    issetProject($request['project']??'', $id, $link) === false? $errors['errorProject'] = "Проекта не существует" : '';    
    
    /* Сохранение файла */
    if($_FILES['file']['size'] !== 0){ /* Проверка на загрузку файла */
        $dir = 'files/';
        $file = $dir . basename($_FILES['file']['name']);
        /* Сохранение */
        move_uploaded_file($_FILES['file']['tmp_name'], $file);
    }else{
        $file = null;
    }

    /* Если есть ошибки валидации */
    if(!empty($errors)){
        $data['errors'] = $errors;
    }else{
        addTask($id, $request['name'], $request['project'], $request['date'], $file, $link);
        header('Location: index.php');
    } 
}




$content = include_template($name, $data);

$name = 'layout.php';
$data = [

    'title' => $title,
    'content' => $content,
    'user' => $user,
    'tasks' => $tasks,
    'projects' => $projects
    
];



$layout = include_template($name, $data);


echo $layout;













