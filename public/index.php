<?php
foreach ($_GET as $key => $value) {
  if (preg_match("/(?<=[_]{2}).+?(?=[_]{2})/", $key, $special_key)) {
    ${$special_key[0]} = $value;
    unset($_GET[$key]);
  }
}
foreach ($_POST as $key => $value) {
  if (preg_match("/(?<=[_]{2}).+?(?=[_]{2})/", $key, $special_key)) {
    ${$special_key[0]} = $value;
    unset($_POST[$key]);
  }
}
if (!isset($path) || $path == "home") {
  $request = "../templates/home.html.php";
} else {
  if (dirname($path) == ".") {
    $request = "../templates/$path.html.php";
  } else {
    $request = "../$path.php";
  }
}
if (file_exists($request)) {
  require $request;
}