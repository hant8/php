<div class="main_slider-wrapper">
    <div class="grid-container">
        <div class="grid-x">
            <div class="main_slider">
            <?php

            $main_slider = $database['main_slider'];

            foreach($main_slider as $key => $value){
                
                $srcImg = $value['src'];
                $headingImg = $value['heading'];
                $descriptionImg = $value['description'];
                include('templates/blocks/main_slider-item.php');

            }
            ?>   
            </div>
        </div>
    </div>
</div>