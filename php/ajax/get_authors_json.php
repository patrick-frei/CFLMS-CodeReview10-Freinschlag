<?php
header("Content-type: application/json");
require_once "../db_connect.php";
$authors_sql = "SELECT * FROM `authors`";
$authors_result = $connect->query($authors_sql);
if ($authors_result->num_rows > 0) {
  while ($author = $authors_result->fetch_assoc()) {
    $authors[] = $author;
  }
}
echo json_encode($authors);
?>