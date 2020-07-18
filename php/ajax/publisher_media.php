<?php
  if (isset($_GET["id"])) {
    require_once "../db_connect.php";
    $sql = "SELECT `title`, YEAR(`publish_date`) AS `publish_year`, `type` FROM `media` WHERE `fk_publisher_id` = " . $_GET["id"];
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
      echo "<ul class='list-group list-group-flush'>";
      while ($row = $result->fetch_assoc()) {
        echo  "<li class='list-group-item'>";
        echo $row['title'];
        echo " <small class='text-muted'>" . $row['publish_year'] . "</small>";
        echo " <span class='badge badge-info'>" . ucfirst($row['type']) . "</span>";
        echo "</li>";
      }
      echo "</ul>";
    } else {
      echo  "No Data Available";
    }
  }
?>