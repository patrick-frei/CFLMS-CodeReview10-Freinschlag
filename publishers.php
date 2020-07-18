<?php require_once "php/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "templates/head.php"; ?>
  <script>
    <?php include "js/publisher_media.js"; ?>
  </script>
</head>

<body>
  <header>
    <?php include "templates/header.php"; ?>
  </header>
  <div class="container">
    <ul class="list-group">
      <?php
      $sql = "SELECT `publisher_id`, `name`, `street`, `ZIP_code`, `city` FROM `publishers` ORDER BY `size` DESC";
      $result = $connect->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo  "<li class='list-group-item media' data-media='" . $row['id'] . "'>";
          echo "<span>" . $row['name'] . " </span>";
          echo "<small class='text-muted'>" . $row['street'] . ", " . $row['ZIP_code'] . " " . $row['city'] . "</small>";
          echo "<button class='btn btn-secondary btn-sm media-trigger float-right'>Show media</button>";
          echo "<div class='media-result'></div>";
          echo "</li>";
        }
      } else {
        echo  "<li class='list-group-item'>No Data Available</li>";
      }
      ?>
    </ul>
  </div>
</body>

</html>