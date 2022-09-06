<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FSD</title>
    <link rel="stylesheet" href="style-2a.css">
</head>

<body>
    <div class="wrapper">
        <div class="elem">Начало</div>
        <div class="arrow"></div>
        <div class="elem">Вводим ширину и высоту</div>
        <div class="arrow"></div>
        <div class="elem">P = 2 * ($a + $b)</div>
        <div class="arrow"></div>
        <div class="elem">Выводим результат</div>
        <div class="arrow"></div>
        <div class="elem">Конец</div>
    </div>
    <?php

    $a = 100; /* Высота */
    $b = 200; /* Ширина */
    $perimetr = 2 * ($a + $b);
    echo "P = 2*($a + $b) = $perimetr" . "<br>";

    ?>
</body>

</html>