<?php
/**
 * PHP Version 5 and above
 *
 * @category  PHP_Editor_Scripts
 * @package   PHP_Browser_Edit
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2015 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @link      https://github.com/phhpro/browser-edit
 *
 * This file loads the editor screen.
 */


//** Load config -- "path" if SERVER returns wrong value
include $_SERVER['DOCUMENT_ROOT'] . "/demo/browser-edit/conf.php";

//** Check query
if ($_SERVER['QUERY_STRING'] === $bed_load) {
    header("Location: " . $bed_auth . "?" . $_SERVER['SCRIPT_NAME']);
    exit;
}
