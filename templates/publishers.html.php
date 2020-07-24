<?php require_once "../php/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../templates/head.html.php"; ?>
  <script>
    <?php include "js/publishers.js"; ?>
  </script>
</head>

<body>
  <header>
    <?php include "../templates/header.html.php"; ?>
  </header>
  <div class="container">
    <ul class="list-group">
      <?php
      $publishers = db_select("SELECT * FROM `publishers`");
      foreach ($publishers as $publisher) {
        echo  "<li class='list-group-item media' data-publisher_id='{$publisher->publisher_id}'>";
        echo "<span>{$publisher->name}</span>";
        echo " <small class='text-muted'>{$publisher->street}, {$publisher->ZIP_code} {$publisher->city}</small>";
        echo "<button class='btn btn-secondary btn-sm media-trigger float-right'>Show media</button>";
        echo "<div class='media-result'></div>";
        echo "</li>";
      }
      ?>
    </ul>
  </div>
</body>

</html>
<?php $connect->close() ?>