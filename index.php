<?php require_once "php/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "templates/head.php"; ?>
</head>

<body>
  <header>
    <?php include "templates/header.php"; ?>
  </header>
  <div class="container">
    <div class="row row-cols-lg-4">
      <?php
      $sql = "SELECT `media`.`media_id`, `media`.`title`, `media`.`image`, YEAR(`media`.`publish_date`) AS `publish_year`, `media`.`type`, `media`.`status`, `authors`.`author_id`, CONCAT(`authors`.`first_name`, ' ', `authors`.`last_name`) AS `author` FROM `media` JOIN `media_has_authors` ON `media_has_authors`.`fk_media_id` = `media`.`media_id` JOIN `authors` ON `authors`.`author_id` = `media_has_authors`.`fk_author_id`";
      $result = $connect->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='col'>";
          echo "<div class='card'>";
          echo "<img class='card-img-top media-card' src='img/" . $row['image'] . "' alt='Card image cap'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>";
          echo $row['title'];
          echo " <small class='text-muted'>" . $row['publish_year'] . "</small>";
          echo "<div class='mt-2'>";
          echo " <span class='badge badge-info'>" . ucfirst($row['type']) . "</span>";
          if ($row['status'] == "available") {
            echo " <span class='badge badge-success'>Available</span>";
          } elseif ($row['status'] == "reserved") {
            echo " <span class='badge badge-warning'>Reserved</span>";
          }
          echo "</div>";
          echo "</h5>";
          echo "<p class='card-text'>";
          echo "<a href='/authors.php?id=" . $row['author_id'] . "'>" . $row['author'] . "</a></p>";
          echo "<a href='/index.php?id=" . $row['media_id'] . "' class='btn btn-secondary'>More info</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo  "<li class='list-group-item'>No Data Available</li>";
      }
      ?>
    </div>
  </div>
</body>

</html>