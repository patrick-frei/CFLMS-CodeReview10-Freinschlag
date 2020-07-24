<?php
require_once '../php/db_connect.php';
if (!isset($table)) die("No table submitted!");
if (!isset($delete_key)) die("No delete key submitted!");
if (!isset($delete_value)) die("No delete value submitted!");
$sql = "DELETE FROM `$table` WHERE `$delete_key` = '$delete_value'";
if ($connect->query($sql) === true) {
  echo  "Successfully deleted!";
} elseif ($connect->errno == 1451) {
  echo "Error: $delete_key is connected to a foreign key of another table!";
} else {
  echo "Error while deleting record : " . $connect->error;
}
$connect->close();
?>
