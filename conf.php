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
 * This file contains the script's configuration.
 */


/**
 ***********************************************************************
 *                                                   BEGIN USER CONFIG *
 ***********************************************************************
 */


/**
 * Document root -- "path" if SERVER returns wrong value
 * Script folder
 * Access token
 * Editor password
 */
$bed_path = $_SERVER['DOCUMENT_ROOT'];
$bed_fold = "/browser-edit/";
$bed_load = "edit";
$bed_pass = "edit";


/**
 ***********************************************************************
 *                                                     END USER CONFIG *
 ***********************************************************************
 */


/**
 * Login screen
 * Editor screen
 * Script version
 */
$bed_auth = $bed_fold . "auth.php";
$bed_edit = $bed_fold . "edit.php";
$bed_make = 20180116;
