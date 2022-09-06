<!DOCTYPE html>
<html lang="ru">

<?php
    include_once('templates/blocks/head.php');  
?>

<body>
  <?php include_once('templates/blocks/header.php'); ?>
  <main>
    <div class="content price-page">
      <div class="grid-container">
        <ul class="breadcrumbs">
          <li><a href="index.php">Главная</a></li>
          <li><span>Цены</span></li>
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
      <?php include_once('templates/blocks/price.php'); ?>
      <?php include_once('templates/blocks/calculator.php'); ?>
      <?php include_once('templates/blocks/seo-text.php'); ?>
  </main>
  <?php include_once('templates/blocks/footer.php'); ?>
  <?php
        include_once('templates/blocks/script-js.php');
    ?>
    <?php
        include_once('templates/blocks/modal.php');
    ?>
</body>

</html>