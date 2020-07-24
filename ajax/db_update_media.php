<?php
require_once '../php/db_connect.php';
if ($image_label == "No image choosen") {
  $_POST["image"] = null;
} elseif ($_FILES["image"]["error"] == 0) {
  $_POST["image"] = bin2hex(random_bytes(10)) . "." . strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
}
$old_image = db_select("SELECT `image` FROM `media` WHERE `media_id` = $media_id")[0]->image;
foreach ($_POST as $key => $value) {
  $set_clause[] = "$key = '" . str_replace("'", "\'", $value) . "'";
}
$sql = "UPDATE media SET " . join(", ", $set_clause) . " WHERE $update_key = '$media_id'; DELETE FROM `media_has_authors` WHERE `fk_media_id` = $media_id; INSERT INTO `media_has_authors` (fk_media_id, fk_author_id) VALUES " . join(", ", array_map(fn($e) => "($media_id, $e)", $fk_author_id));
if ($connect->multi_query($sql) === true) {
  if (isset($_POST["image"]) && $_FILES["image"]["error"] == 0) {
    unlink("../public/img/$old_image");
    move_uploaded_file($_FILES["image"]["tmp_name"], "../public/img/{$_POST["image"]}");
  } elseif ($_POST["image"] == null) {
    unlink("../public/img/$old_image");
  }
  echo  "Successfully updated!";
} else {
  echo "Error while updating record : " . $connect->error;
}
$connect->close();
