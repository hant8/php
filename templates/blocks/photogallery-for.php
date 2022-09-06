<div class="photogallery">
    <div class="grid-container">
        <div class="photogallery-for slider-dots">
        <?php

        $for_photogallery = $database['for_photogallery'];

        foreach($for_photogallery as $key => $value){

            $photogalleryForHref = $value['href'];
            $photogalleryForSrc = $value['src'];
            $photogalleryForCaption = $value['caption'];
            include('templates/blocks/photogallery-for-item.php');
        }

        ?>
        </div>
        <div class="photogallery-nav">

            <?php
    
            $for_photogallery = $database['for_photogallery'];
            foreach($for_photogallery as $key => $value){
                
                $photogalleryForSrc = $value['src'];
                include('templates/blocks/photogallery-nav-item.php');
            }
            
            ?>
        </div>
    </div>
</div