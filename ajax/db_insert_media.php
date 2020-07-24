<?php
require_once '../php/db_connect.php';
if ($image_label == "No image choosen") {
  unset($_POST["image"]);
} elseif ($_FILES["image"]["error"] == 0) {
  $_POST["image"] = bin2hex(random_bytes(10)) . "." . strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
}
$keys = join(", ", array_keys($_POST));
$values = join(", ", array_map(fn($v) => "'" . str_replace("'", "\'", $v) . "'", array_values($_POST))); //escapes quotation marks and adds prefix and suffix quotation marks
$sql = "INSERT INTO `$table` ($keys) VALUES ($values); SET @media_id = (SELECT LAST_INSERT_ID()); INSERT INTO `media_has_authors` (fk_media_id, fk_author_id) VALUES (" . join("), (", array_map(fn($e) => "@media_id, {$e}", $fk_author_id)) . ")";
if ($connect->multi_query($sql) === true) {
  if (isset($_POST["image"])) move_uploaded_file($_FILES["image"]["tmp_name"], "../public/img/{$_POST["image"]}");
  echo  "Successfully inserted!";
} else {
  echo "Error while updating record : " . $connect->error;
}
$connect->close();