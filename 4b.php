<html>

<head>
    <meta-charset="UTF-8">
</head>

<body>
    <form action="" method="post">
        <label>
            Введите пароль:
            <hr>
            <input type="password" name="password" minlength="6" maxlength="6" />
        </label>
        <p><input type="submit" /></p>
    </form>


    <?php

    if (isset($_POST['password'])) { /* При получении формы */


        $password = str_split($_POST['password']);
        $result = '';

        foreach ($password as $elem) { /* Перебор пароля */

            switch ($elem) { /* Проверка на корректность пароля */
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    $result .= $elem;
                    break;
                default:
                    echo " $elem - некорректный символ ";
            }
        }
        echo "<p>Введенный пароль $result</p>";
    }

    ?>

</body>

</html>