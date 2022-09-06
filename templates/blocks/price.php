<div class="price">
    <div class="grid-container">
        <div class="price_wrapper">
        <?php

        $price_block = $database['price_block'];

        foreach($price_block as $key => $value){

            $itemTitle = $value['title'];
            $itemPrice = $value['price'];
            include('templates/blocks/price_item.php');

        }

        ?>
        </div>
        <div class="grid-x">
            <div class="price_link"><span class="btn_blue">Показать еще</span></div>
        </div>
    </div>
</div>