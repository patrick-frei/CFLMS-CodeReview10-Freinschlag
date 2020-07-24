<?php
require_once '../../php/db_connect.php';
if (!isset($table)) die("No table submitted!");
if (!isset($update_key)) die("No update key submitted!");
if (!isset($update_value)) die("No update value submitted!");
foreach ($_POST as $key => $value) {
  $set_clause[] = "$key = '" . str_replace("'", "\'", $value) . "'";
}
$sql = "UPDATE `$table` SET" . join(", ", $set_clause) . " WHERE $update_key = '$update_value'";
echo $sql;
exit;
if ($connect->query($sql) === true) {
  echo  "Successfully updated!";
} else {
  echo "Error while updating record : " . $connect->error;
  exit;
}
$connect->close();
?>