<div class="main_article">
    <div class="grid-container">
        <div class="main_article-heading heading">Так же Вам могут быть полезны <a href="articles.php"> наши статьи</a><a class="mobile-more" href="#"></a></div>
        <div class="main_article-wrapper">
        <?php

        $main_article = $database['main_article'];

        foreach($main_article as $key => $value){

            $articleHref = $value['href'];
            $articleTitle = $value['title'];
            include('templates/blocks/main_article-item.php');

        }

        ?>
        </div>
    </div>
</div>