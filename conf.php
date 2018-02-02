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
 *
 * Script configuration
 */


/**
 ***********************************************************************
 *                                                   BEGIN USER CONFIG *
 ***********************************************************************
 */


/**
 * Script folder
 * Login password
 */
$bed_fold = "/browser-edit/";
$bed_pass = "edit";


/**
 * Session name
 * Session auth
 *
 * This attempts to prevent bypassing the login screen. Even if the
 * script was tricked into thinking the session was set, it would
 * still need to match the value set here. Not perfect, but well.
 */
$bed_name = "BED_SESSION_NAME";
$bed_auth = "BED_SESSION_AUTH";


/**
 * Document root
 *
 * Enter full "path" without trailing / if SERVER returns wrong value.
 * E.g. "/home/john/htdocs"
 */
$bed_path = $_SERVER['DOCUMENT_ROOT'];


/**
 * Editor tree
 *
 * Top level location from where to allow editing.
 * E.g. "/foo/bar/"
 *
 * While setting this to "/" may seem convenient, it will allow
 * unrestricted editing of absolutely everything on the server!
 *
 * Security apart, this may also cause the script to exit prematurely
 * trying to parse the entire tree with possibly thousands of files.
 *
 * Use with caution!
 */
$bed_tree = $bed_fold . "demo/";


/**
 ***********************************************************************
 *                                                     END USER CONFIG *
 ***********************************************************************
 */


/**
 * Script version
 * Editor screen
 * HTTP referrer
 * Init status
 */
$bed_make = 20180202;
$bed_edit = $bed_fold . "edit.php";
$bed_href = $_SERVER['HTTP_REFERER'];
$bed_stat = "";
