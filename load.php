<?php
//** load config
include ($_SERVER['DOCUMENT_ROOT'] . "/site/bed/conf.php");

//** check query
if ($_SERVER['QUERY_STRING'] === $bed_load) {
  header("Location: " . $bed_auth . "?" . $_SERVER['SCRIPT_NAME']);
  exit;
}
