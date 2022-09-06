<div class="main_photogallery">
    <div class="grid-container">
        <div class="main_photogallery-heading heading">Фотогалерея</div>
        <div class="main_photogallery-slider slider-arrows slider-dots">
        <?php

        $main_photogallery = $database['main_photogallery'];

        foreach($main_photogallery as $key => $value){

            $photogalleryHref = $value['href'];
            $photogallerySrc = $value['src'];
            include('templates/blocks/photogallery-item.php');

        }

        ?>
        </div>
    </div>
</div>