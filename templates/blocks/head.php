<head>
    <?php

    $data = $database['pages'];
    $url = $_SERVER['REQUEST_URI'];
    
    foreach($data as $key => $value){
        if($value['url_key'] == $url){
            $title = $value['title'];
            echo '<title>' . $title . '</title>';
        }
    }
    ?>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f461f187-b614-45c4-988e-6b214fceb781&amp;lang=ru_RU" type="text/javascript"></script>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/screen.css">
</head>