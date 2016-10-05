<?php
include ('/path/to/bed/conf.php');

if ($_SERVER['QUERY_STRING'] == $bed_load) {
  header('Location: ' . $bed_auth . '?' . $_SERVER['PHP_SELF']);
  exit;
}
