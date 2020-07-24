<?php
require_once "../php/db_connect.php";
$media = db_select("SELECT * FROM `media` WHERE `media_id` = " . $_GET["media_id"])[0];
$publisher = db_select("SELECT * FROM `publishers` WHERE `publisher_id` = {$media->fk_publisher_id}")[0];
$authors = db_select("SELECT `authors`.* FROM `authors` JOIN `media_has_authors` ON `fk_author_id` = `author_id` JOIN `media` ON `media_id` = `fk_media_id` WHERE `media_id` = " . $_GET["media_id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../templates/head.html.php"; ?>
</head>
<body>
  <?php include "../templates/header.html.php"; ?>
  <div class="container">
    <h1 class="text-center"><?php echo $media->title ?></h1>
    <div class="text-center">
      <img class="rounded w-25" src="img/<?php echo $media->image ?>">
    </div>
    <ul class="list-group list-group-flush mx-auto">
      <li class="list-group-item">ISBN: <span class="float-right"><?php echo $media->ISBN ?></span></li>
      <li class="list-group-item">Description: <span class="d-block mt-2"><?php echo $media->description ?></span></li>
      <li class="list-group-item">Publish date: <span class="float-right"><?php echo $media->publish_date ?></span></li>
      <li class="list-group-item">Publisher: <span class="float-right"><?php echo $publisher->name ?></span></li>
      <?php
      echo "<li class='list-group-item'>Authors: ";
      foreach ($authors as $author) {
        if ($author != $authors[0]) echo "<br>";
        echo "<span class='float-right'>{$author->first_name} {$author->last_name}</span>";
      }
      echo "</li>";
      ?>
      <li class="list-group-item">Type: <span class="float-right"><?php echo $media->type ?></span></li>
      <li class="list-group-item">Status: <span class="float-right"><?php echo $media->status ?></span></li>
    </ul>
  </div>
</body>
</html>
<?php $connect->close(); ?>