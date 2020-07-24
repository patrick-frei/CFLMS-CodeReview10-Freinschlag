<?php
header("Content-type: application/json");
require_once "../php/db_connect.php";
function get_where_clause() {
  $where_clause_array = [];
  foreach ($_GET as $key => $value) {
    array_push($where_clause_array, "$key = $value");
  }
  if (count($where_clause_array) > 0) {
    return " WHERE " . join(" AND ", $where_clause_array);
  }
}
$result = $connect->query("SELECT * FROM $table" . get_where_clause());
if ($result->num_rows > 0) {
  while ($media = $result->fetch_object()) {
    $media_array[] = $media;
  }
}
if ($media_array != null) {
  echo json_encode($media_array);
} else {
  echo "[]";
}
?>