<?php
header("Content-type: application/json");
require_once "../db_connect.php";
$publishers_sql = "SELECT * FROM `publishers`";
$publishers_result = $connect->query($publishers_sql);
if ($publishers_result->num_rows > 0) {
  while ($publisher = $publishers_result->fetch_assoc()) {
    $publishers[] = $publisher;
  }
}
echo json_encode($publishers);
?>