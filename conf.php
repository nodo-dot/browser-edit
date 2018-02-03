<?php
/**
 * PHP Version 5 and above
 *
 * @category  PHP_Editor
 * @package   PHP_Browser_Edit
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2015 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @version   GIT: Latest
 * @link      https://github.com/phhpro/browser-edit
 *
 * Script configuration
 */


/**
 ***********************************************************************
 *                                                   BEGIN USER CONFIG *
 ***********************************************************************
 */


/**
 * Document root
 *
 * Enter full "path" without trailing / if SERVER has wrong value.
 * E.g. "/home/john/htdocs"
 */
$bed_path = $_SERVER['DOCUMENT_ROOT'];


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
 * Editor tree
 *
 * Top level location from where to allow editing.
 * E.g. "/foo/bar/"
 *
 * Setting this to "/" enables unrestricted editing of absolutely
 * everything on the server and may well break the script trying
 * to parse the entire tree with possibly thousands of files.
 *
 * Use with caution!
 */
$bed_tree = $bed_fold . "demo/";


/**
 * Language reference
 *
 * Available language files are stored in the "lang" folder.
 */
$bed_lref = "en";


/**
 * Default fallback
 *
 * Return to this page when quitting the editor after deleting a file.
 */
$bed_back = "/";

/**
 ***********************************************************************
 *                                                     END USER CONFIG *
 ***********************************************************************
 */


/**
 * Script version
 * Editor screen
 * Language data file
 */
$bed_make = 20180203;
$bed_edit = $bed_fold . "edit.php";
$bed_ldat = './lang/' . $bed_lref . '.php';

//** Check if language data file exists
if (!file_exists($bed_ldat)) {
    echo "<p>Please check your language settings.</p>\n" .
         "<p>Script halted.</p>\n";
    exit;
}
