<!DOCTYPE html>
<html lang="ru">

<?php
    include_once('templates/blocks/head.php');  
?>
<body>
    <?php
        include_once('templates/blocks/header.php');
    ?>
    <?php
        include_once('templates/blocks/mobile_menu.php');
    ?>
  <main>
    <div class="content">
      <div class="grid-container">
        <ul class="breadcrumbs">
          <li><a href="/index.php">Главная</a></li>
          <li><span>Аренда бытовки</span></li>
        </ul>
      </div>
      <div class="grid-container">
      <?php

      $data = $database['pages'];
      $url = $_SERVER['REQUEST_URI'];

      foreach($data as $key => $value){
          if($value['url_key'] == $url){
              $title = $value['h1'];
              echo '<h1>' . $title . '</h1>';
          }
      }
      ?>
      </div>
      <?php include_once('templates/blocks/preview_bytovka.php'); ?>
      <?php include_once('templates/blocks/calculator.php'); ?>
      <?php include_once('templates/blocks/photogallery.php'); ?>
      <?php include_once('templates/blocks/order_form.php'); ?>
      <?php include_once('templates/blocks/main_article.php'); ?>
  </main>
  <?php include_once('templates/blocks/footer.php'); ?>
  <?php include_once('templates/blocks/script-js.php'); ?>
  <?php include_once('templates/blocks/modal.php'); ?>
</body>

</html>