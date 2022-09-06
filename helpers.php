<?php

/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date): bool
{
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else if (is_string($value)) {
                $type = 's';
            } else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }
    return $stmt;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form(int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = [])
{
    $name = 'templates/' . $name; // Фрмирует путь  к шаблону
    $result = '';

    if (!is_readable($name)) { // Определяет существование файла и доступен ли он для чтения
        return $result;
    }

    ob_start(); // Включение буферизации вывода
    extract($data); // Импортирует переменные из массива
    require $name; // Включает указанный файл

    $result = ob_get_clean(); // Получаем содержимое текущего буфера и удаляем его

    return $result;
}
/** Подсчет задач в проекте 
 * @param array $tasks
 * @param mixed $project
 * 
 * @return [int]
 */
function list_count($tasks, $project)
{   
    $count = 0;
    foreach ($tasks as $task) {

        if ($task['project_name'] === $project) {
            $count++;
        }
    }
    return $count;
}
/** Функция определяет задачи до выполнени которых меньше 24ч
 * @param mixed $date
 * @param int $completed
 * 
 * @return [string]
 */
function hours24($date, $completed)
{
    $result = '';
    if (($date !== null)) {
        $date_timestemp = strtotime($date); /* Получаем заданную дату в timestamp */
        $time =  $date_timestemp - time(); /* Разность между заданой датой и текущим временем в timestamp */
        /* 86400 - это количество секунд равное 24 часам */
        if (($time < 86400) && ($completed == false)) {
          

            $result = 'task--important';
        }
    }

    return $result;
}
/** Функция отправляет подготовленный запрос и извлекает данные
 * @param $stmt
 * @return [array]
 */
function reading_data($stmt)
{   
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    // чтение данных
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $data??'';
}

/** Функция возвращает данные о всех проектов пользователя 
 * @param  int $id
 * @param  mysql link
 * @return [array]
 */
function projecstUser($id, $link)
{   

    $query = "SELECT projects.id as project_id, projects.name as project_name FROM projects
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

    return $projects;
}

/** Фуекция возвращает данные о всех задачах пользователя 
 * @param  int $id
 * @param  mysql link
 * @return [array]
 */
function tasksUser($id, $link)
{   

    /* Запрос на выборку всех задач пользователя */
    $query = "SELECT
    projects.id as project_id, 
    projects.name as project_name,
    users.name as user_name,
    tasks.name as task_name,
    tasks.date as task_date,
    tasks.file as task_file,
    tasks.completed as task_completed
    FROM
    tasks
    LEFT JOIN users
    ON  tasks.user_id = users.id 
    LEFT JOIN projects
    ON tasks.project_id = projects.id
    WHERE users.id = ?";

    /* Данные запроса */
    $data = [
        $id
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);

    /* Функция отправляет подготовленный запрос и извлекает данные */

    $tasks = reading_data($stmt);
    $tasks = !empty($tasks)? array_reverse($tasks) : '';


    return $tasks;
}
/** Функция проверяет наличие данного проекта у пользователя
 * @param  int $project_id
 * @param  int $id
 * @param  mysql link
 * @return bool
 */
function issetProject($project_id, $id, $link)
{   

    $query = "SELECT projects.id as project_id, projects.name as project_name FROM projects
    LEFT JOIN users ON projects.user_id = users.id
    WHERE user_id = ? AND projects.id = ?";

    /* Данные запроса */
    $data = [
        $id, $project_id
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);

    /* Функция отправляет подготовленный запрос и извлекает данные */
    $result = reading_data($stmt);

    return !empty($result)? true : false;
}

/** Функция добавляет новую задачу в бд
 * @param mixed $id
 * @param mixed $name
 * @param mixed $project_id
 * @param mixed $date
 * @param mixed $file
 * @param mixed $link
 * 
 * @return [type]
 */
function addTask($id, $name, $project_id, $date, $file, $link)
{   
    /* Дата регистрации */
    $date_register = date('Y-m-d H:i:s');
    $query = "INSERT INTO 
    tasks 
    SET 
    tasks.user_id = ?,
    tasks.name = ?,
    tasks.project_id = ?,
    tasks.date = ?,
    tasks.file = ?,
    tasks.date_register = ?
    ";

    /* Данные запроса */
    $data = [
        $id, $name, $project_id, $date, $file, $date_register
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);

    mysqli_stmt_execute($stmt);
    
}
/** Фильтрация данных от XSS
 * @param mixed $arr
 * 
 * @return [type]
 */
function xss($arr)
{   
    foreach ($arr as $elem) {
        if (is_array($elem)) {
            xss($elem);
        } else {
            strip_tags($elem);
        }
    }
    return $arr;
}
/** Фильтрация данных от XSS
 * @param mixed $email
 * @param mixed $link
 * 
 * @return [type]
 */
function issetEmail($email, $link)
{   

    $query = "SELECT * FROM users
    WHERE users.email = ?";

    /* Данные запроса */
    $data = [
        $email
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);

    /* Функция отправляет подготовленный запрос и извлекает данные */
    $result = reading_data($stmt);

    return !empty($result)? true : false;
}
/** Функция регистрирует нового пользователя
 * @param mixed $name
 * @param mixed $email
 * @param mixed $password
 * @param mixed $link
 * 
 * @return [type]
 */
function addUser($name, $email, $password, $link)
{   
    /* Хешируем пароль */
    $password = password_hash($password, PASSWORD_DEFAULT);
    /* Дата регистрации */
    $date_register = date('Y-m-d H:i:s');
    $query = "INSERT INTO users SET users.name = ?, users.email = ?, users.password = ?,
    date_register = ?";

    /* Данные запроса */
    $data = [
        $name, $email, $password, $date_register
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);

    mysqli_stmt_execute($stmt);
}

/** Функция возвращает результат по полнотекстовому поиску
 * @param mixed $search
 * @param mixed $link
 * 
 * @return [type]
 */
function searchTasks($search, $link)
{   
    $query = "SELECT 
        tasks.name as task_name,
        tasks.date as task_date,
        tasks.completed as task_completed,
        tasks.file as task_file
        FROM
        tasks
        WHERE MATCH (name) AGAINST (?)";
    
    /* Данные запроса */
    $data = [
        $search
    ];
    /* Функция возвращает подготовленный запрос */
    $stmt = db_get_prepare_stmt($link, $query, $data);
    $tasks = reading_data($stmt);

    return $tasks;
    
}