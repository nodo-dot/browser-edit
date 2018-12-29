<?php
/**
 * PHP Version 5 and above
 * 
 * Configuration
 *
 * @category  PHP_Editor
 * @package   PHP_Browser_Edit
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2015 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @version   GIT: Latest
 * @link      https://github.com/phhpro/browser-edit
 */


/**
 ***********************************************************************
 *                                                   BEGIN USER CONFIG *
 ***********************************************************************
 */


/**
 * Document root -- path without trailing / if SERVER has wrong value
 * Script folder
 * Login password
 */
$bed_path = $_SERVER['DOCUMENT_ROOT'];
$bed_fold = "/browser-edit/";
$bed_pass = "edit";

//** Session tokens -- simple hack to prevent bypassing login screen
$bed_name = "BED_SESSION_NAME";
$bed_auth = "BED_SESSION_AUTH";

/**
 * Tree to allow editing
 * Below script folder: $bed_tree = $bed_fold . "dir/";
 * Above script folder: $bed_tree = "/dir/";
 *
 * A value of "/" enables editing ALL files on server but
 * may break script trying to parse thousands of files
 */
$bed_tree = $bed_fold . "demo/";

/**
 * Language -- refer to "lang" folder for available options
 * Exit page when quitting after deleting file
 * Initial mode -- 0 = dark, 1 = light
 */
$bed_lref = "en";
$bed_back = "/";
$bed_mode = 1;


/**
 ***********************************************************************
 *                                                     END USER CONFIG *
 ***********************************************************************
 */


//** Script version, editor screen, and language file
$bed_make = "20181229";
$bed_edit = $bed_fold . "edit.php";
$bed_ldat = "./lang/$bed_lref.php";
