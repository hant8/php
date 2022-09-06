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
        Введите левое основание трапеции:<br>
        <input type="number" name="left" value="<?= $_GET['left'] ?? '' ?>">
    </label>
    <br>
    <label>
        Введите правое основание трапеции:<br>
        <input type="number" name="right" value="<?= $_GET['right'] ?? '' ?>">
    </label>
    <br>
    <label>
        Введите высоту трапеции<br>
        <input type="text" name="height">
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
    if (!empty($_GET)){ /* Если пользователь отправил форму */

        $top = $_GET['top']; /* Верхнее основание */
        $bottom = $_GET['bottom']; /* Нижнее основание */
        $height = $_GET['height']; /* Высота */
        $right = $_GET['right'];  /* Правое основание */
        $left = $_GET['left']; /* Левое основание */
        $Why = (bool)$_GET['radio']; /* Что посчитать периметр/площадь */
        $s = 0.5*$height*($top + $bottom);  /* Площадь */
        $p = 2*($top + $bottom); /* Периметр */
        /* Вычисление высоты для проверки на соответствие с введенной пользователем */
        $heightvalid = round(sqrt($left**2 - ((($bottom - $top)**2 + $left**2 - $right**2)/(2*($bottom - $top)))**2));
        
        if($heightvalid == $height){ /* Проверка */

            if($Why){

                echo "S = 0.5*$height*($top + $bottom)= $s";
    
            }elseif(!$Why){ 
    
                echo "P = 2*($top + $bottom) = $p";
    
            }
        }else{
            echo "Неправильные данные, высота трапеции при заданных параметрах должна быть $heightvalid";
        }
    } 
?>