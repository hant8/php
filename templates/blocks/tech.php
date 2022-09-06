<div class="tech-characteristics">
    <div class="grid-container">
        <div class="tech-characteristics-heading heading">Технические характеристики бытовок</div>
        <div class="tech-characteristics-wrapper">

            <?php

            $characteristics = $database['characteristics'];

            foreach ($characteristics as $item) {

                $techTitle = $item['title'];
                $techSize = $item['size'];
                include('templates/blocks/tech-item.php');
            }


            ?>
        </div>
        <div class="grid-x">
            <div class="tech-characteristics-link"><span class="btn_blue">Показать еще</span></div>
        </div>
    </div>
</div>