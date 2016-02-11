<?php
// load config
include ($_SERVER['DOCUMENT_ROOT'] . '/bedit/conf.php');

// link file
if (isset ($_GET[$bed_load])) {
    header('Location: ' . $bed_auth . '?' . $_SERVER['PHP_SELF']);
}
