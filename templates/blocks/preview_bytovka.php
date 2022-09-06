<div class="preview_bytovka-wrapper">
    <div class="grid-container">

        <?php

        $preview_bytovka = $database['preview_bytovka'];
        foreach($preview_bytovka as $key => $value){

            $bytovkaTitle = $value['title'];
            $bytovkaPrice = $value['price'];
            $bytovkaSize = $value['size'];

            include('templates/blocks/preview_bytovka-item.php');

        }

        ?>
        <div class="grid-x">
            <div class="preview_bytovka-more"><span class="btn_blue">Показать еще</span></div>
        </div>
    </div>
</div>