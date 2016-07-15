<?php
// load config
include ($_SERVER['DOCUMENT_ROOT'] . '/browser-edit/conf.php');

// link file
if ($_SERVER['QUERY_STRING'] == $bed_load) {
  header('Location: ' . $bed_auth . '?' . $_SERVER['PHP_SELF']);
  exit;
}
