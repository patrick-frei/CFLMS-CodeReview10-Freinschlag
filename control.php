<?php require_once "php/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "templates/head.php"; ?>
  <script>
    <?php include "js/control.js" ?>
  </script>
</head>

<body>
  <header>
    <?php include "templates/header.php"; ?>
  </header>
  <div class="container">
    <label for="option-picker">Option: </label>
    <select class="mb-3" id='option-picker'>
      <option selected>Show</option>
      <option>Update</option>
      <option>Add</option>
    </select>
    <label for="media-picker">Media: </label>
    <select class="mb-3" id='media-picker'>
      <?php
      $sql = "SELECT `media_id`, `title` FROM `media`";
      $result = $connect->query($sql);
      if ($result->num_rows > 0) {
        echo "<option disabled selected></option>";
        while ($row = $result->fetch_assoc()) {
          echo "<option value='" . $row['media_id'] . "'>" . $row['title'] . "</option>";
        }
      } else {
        echo "<option>No data avaliable</option>";
      }
      ?>
    </select>
    <table class="table">
      <thead>
        <tr>
          <th>key</th>
          <th>value</th>
        </tr>
      </thead>
      <tbody id="media-table">
      </tbody>
    </table>
  </div>
  </div>
</body>

</html>