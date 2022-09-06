<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('helpers.php');

$title = 'Регистрация'; 
$name = 'tel_register.php';
$data = [];

if(isset($_POST['submit'])){
    
    /* Подключение к базе анных */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect("localhost", "root", "", "mydeal_master");

    /* Фильтрация данных от XSS */
    $request = xss($_POST); 
    /* Соханяем введенные данные в сессию */
    $_SESSION['name'] = $request['name'];
    $_SESSION['password'] = $request['password'];
    $_SESSION['email'] = $request['email'];
    /* Массив ошибок */
    $errors = [];
    /* Проверки на заполнение всех обязательных полей */
    empty($request['name'])? $errors['errorName'] = 'Имя не должно быть пустым' : '';
    empty($request['password'])? $errors['errorPassword'] = 'Пароль не должен быть пустым' : '';
    empty($request['email'])? $errors['errorEmail'] = 'Email не должен быть пустым' : '';

    /* Проверка на валидность email */
    if(filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
        /* Проверка, что такой email не зарегистрирован */
        issetEmail($request['email']??'', $link) === true? $errors['errorEmailUniqe'] = "Пользователь с таким email уже зарегистрирован" : '';    
    }else{
        $errors['errorNoEmail'] = 'E-mail введён некорректно';
    }

    /* Если есть ошибки валидации */
    if(!empty($errors)){
        $data['errors'] = $errors;
    }else{
        addUser($request['name'], $request['email'], $request['password'], $link);
         /* ID зарегистрированного пользователя */
         $_SESSION['user_id'] = mysqli_insert_id($link);
         $_SESSION['user_name'] = $request['name']; 
        header('Location: index.php');
    }
}

$content = include_template($name, $data);

$name = 'layout.php';

$data = [
    'title' => $title,
    'content' => $content
];

$layout = include_template($name, $data);

echo $layout;


