<?php
//** load config
include ($_SERVER['DOCUMENT_ROOT'] . "/path/to/bed/conf.php");

//** check query
if ($_SERVER['QUERY_STRING'] === $bed_load) {
  header("Location: " . $bed_auth . "?" . $_SERVER['PHP_SELF']);
  exit;
}
