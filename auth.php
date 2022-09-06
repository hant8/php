<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('helpers.php');

$name = 'tel_auth.php';
$data = [];

if(isset($_POST['submit'])){

    /* Подключение к базе анных */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect("localhost", "root", "", "mydeal_master");

    /* Фильтрация данных от XSS */
    $request = xss($_POST); 
    /* Соханяем введенные данные в сессию */
    $_SESSION['password'] = $request['password'];
    $_SESSION['email'] = $request['email'];
    /* Массив ошибок */
    $errors = [];
    /* Проверки на заполнение всех обязательных полей */
    empty($request['password'])? $errors['errorPassword'] = 'Пароль не должен быть пустым' : '';
    empty($request['email'])? $errors['errorEmail'] = 'Email не должен быть пустым' : '';

    /* Проверка на валидность email */
    if(filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
        /* Проверка, что такой email не зарегистрирован */
        $query = "SELECT * FROM users
        WHERE users.email = ?";

        /* Данные запроса */
        $data = [
            $request['email']
        ];
        /* Функция возвращает подготовленный запрос */
        $stmt = db_get_prepare_stmt($link, $query, $data);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        empty($user)? $errors['errorValid'] = "Вы ввели неправильный email/пароль" : '';    
    }else{
        $errors['errorNoEmail'] = 'E-mail введён некорректно';
    }
    /* Если есть ошибки валидации */
    if(!empty($errors)){
        $data['errors'] = $errors;
    }else{
        $hash = $user['password']; // пароль из БД
		
 		// Проверяем соответствие хеша из базы и введеннного пароля
 		if (password_verify($request['password'], $hash)) {
            /* ID зарегистрированного пользователя */
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name']; 
            header('Location: index.php');
        }else{
            $errors['errorValid'] = "Вы ввели неправильный email/пароль";
            $data['errors'] = $errors;
        }    
    }
}

$layout = include_template($name, $data);

echo $layout;
