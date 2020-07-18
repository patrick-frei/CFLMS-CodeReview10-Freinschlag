<?php
if (isset($_GET["id"])) {
  header("Content-type: application/json");
  require_once "../db_connect.php";
  $media_sql = "SELECT * FROM `media` WHERE `media_id` = " . $_GET["id"];
  $media_result = $connect->query($media_sql);
  if ($media_result->num_rows > 0) $media = $media_result->fetch_assoc();
  $publisher_sql = "SELECT * FROM `publishers` WHERE `publisher_id` = " . $media["fk_publisher_id"];
  $publisher_result = $connect->query($publisher_sql);
  if ($publisher_result->num_rows > 0) $publisher = $publisher_result->fetch_assoc();
  $authors_sql = "SELECT `authors`.* FROM `authors` JOIN `media_has_authors` ON `media_has_authors`.`fk_author_id` = `authors`.`author_id` JOIN `media` ON `media`.`media_id` = `media_has_authors`.`fk_media_id` WHERE `media`.`media_id` = " . $media["media_id"];
  $authors_result = $connect->query($authors_sql);
  if ($authors_result->num_rows > 0) {
    while ($author = $authors_result->fetch_assoc()) {
      $authors[] = $author;
    }
  }
  $json = $media;
  $json["publisher"] = $json["fk_publisher_id"];
  unset($json["fk_publisher_id"]);
  $json["publisher"] = $publisher;
  $json["authors"] = $authors;
  echo json_encode($json);
}
?>