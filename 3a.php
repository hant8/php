<form action="" method="GET">
    <label>
        Введите верхнее основание трапеции:<br>
        <input type="number" name="top" value="<?= $_GET['top'] ?? '' ?>">
    </label>
    <br>
    <label>
        Введите нижнее основание трапеции:<br>
        <input type="number" name="bottom" value="<?= $_GET['bottom'] ?? '' ?>">
    </label>
    <br>
    <label>
        Введите высоту трапеции<br>
        <input type="text" name="height" value="<?= $_GET['height'] ?? '' ?>">
    </label>
    <br>
    <label>
        Вычислить площадь
        <input type="radio" name="radio" value="1" checked>
    </label>
    <br>
    <label>
        Вычислить периметр
        <input type="radio" name="radio" value="0">
    </label>
    <br>
    <br>
    <input type="submit" value="Вычислить">
</form>
<?php

    if (!empty($_GET)) { /* Если пользователь отправил форму */

        $top = $_GET['top']; /* Верхнее основание */
        $bottom = $_GET['bottom']; /* Нижнее основание */
        $height = $_GET['height']; /* Высота */
        $Why = (bool)$_GET['radio']; /* Что посчитать периметр/площадь */
        $s = 0.5 * $height * ($top + $bottom); /* Площадь */
        $p = 2 * ($top + $bottom); /* Периметр */

        if ($Why) {

            echo "S = 0.5*$height*($top + $bottom)= $s";
        } elseif (!$Why) {

            echo "P = 2*($top + $bottom) = $p";
        }
    }
?>