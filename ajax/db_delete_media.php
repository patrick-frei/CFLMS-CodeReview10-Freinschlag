<?php
require_once '../php/db_connect.php';
if (!isset($table)) die("No table submitted!");
if (!isset($delete_key)) die("No delete key submitted!");
if (!isset($delete_value)) die("No delete value submitted!");
$old_image = db_select("SELECT `image` FROM `media` WHERE `media_id` = $media_id")[0]->image;
$sql = "DELETE FROM `$table` WHERE `$delete_key` = '$delete_value'";
if ($connect->query($sql) === true) {
  unlink("../public/img/$old_image");
  echo  "Successfully deleted!";
} elseif ($connect->errno == 1451) {
  echo "Error: $delete_key is connected to a foreign key of another table!";
} else {
  echo "Error while deleting record : " . $connect->error;
}
$connect->close();
