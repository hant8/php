<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FSD</title>
    <link rel="stylesheet" href="style-4d.css">
</head>

<body>
    <div class="container">
        <div class="elem">Вторая цифра первого пароля</div>
        <div class="block-center">
            <div class="block-center__left">Меньше или равно 5</div>
            <div class="block-center__right">Больше 5</div>
        </div>
        <div class="block-footer">
            <div class="block-footer__left">Алгоритм шифрования :<br>$pass2Se = $pass2</div>
            <div class="block-footer__right">Алгоритм шифрования :<br>$pass2Se = 3 цифра $pass2 + 1 цифра $pass2 + 2 цифра $pass2</div>
        </div>
    </div>
    <?php

        $pass1 = '416'; /* Первый пароль */
        $pass2 = '243'; /* Второй пароль */

        if($pass1[1] > 5){

            $pass2Se = $pass2; /* Шифр при первом алгоритме */
            echo "Вторая цифра $pass1[1] > 5 поэтому зашифрованный пароль = $pass2Se";

        }elseif($pass1[1] <= 5){

            $pass2Se = $pass2['2'].$pass2['0'].$pass2['1']; /* Шифр при втором алгоритме */
            echo "Вторая цифра $pass1[1] <= 5 зашифрованный пароль = $pass2Se";
        }

    ?>
</body>

</html>

