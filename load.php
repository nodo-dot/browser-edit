<?php
// load config
require ('/home/www/public_html/bedit/conf.php');

// link file
if (isset ($_GET[$bed_load])) {
    header('Location: ' . $bed_auth . '?' . $_SERVER['PHP_SELF']);
}
