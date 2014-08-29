<?php 

function url_to($relative_path) {
  $domain = 'http://' . $_SERVER["SERVER_NAME"];
  $path = dirname($_SERVER['REQUEST_URI']);
  if ($path == '.' || $path == '/') { $path = ''; }
  return trim_and_join(array($domain, $path, $relative_path), '/');
}

function trim_and_join($array, $delimiter) {
  $trimmed = array();
  foreach ($array as $a) {
    if ($a > '') {
      array_push($trimmed, trim($a, $delimiter));
    }
  }
  return join($delimiter, $trimmed);
}

?>