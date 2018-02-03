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
 * Basic authentication
 */


/**
 * Init session
 * Load config
 * Load language data file
 */
session_start();
require './conf.php';
require $bed_ldat;

//** Check empty tree
if ($bed_tree === "") {
    echo "<p>" . $bed_lstr['empty_tree'] . "</p>\n";
    exit;
}

//** Form posted
if (isset($_POST['bed_post'])) {
    $bed_login = $_POST['bed_pass'];

    //** Check password
    if ($bed_login === $bed_pass) {
        $_SESSION[$bed_name] = $bed_auth;
        header("Location: " . $bed_edit . "?f=" .
               $_SERVER['QUERY_STRING'] . "#EDIT");
        exit;
    } else {
        header("Location: " . $bed_href . "#INVALID_LOGIN");
        exit;
    }
}

//** Login form
echo '<form action="#" method=POST accept-charset="UTF-8">' . "\n" .
     "    <div>\n" .
     '        <label for=bed_pass>' . $bed_lstr['pass'] . "</label>\n" .
     '        <input type=password id=bed_pass name=bed_pass size=12 ' .
     'maxlength=32 title="' . $bed_lstr['pass_text'] . '"/>' . "\n" .
     '        <input type=submit name=bed_post ' .
     'value="' . $bed_lstr['enter'] . '" ' .
     'title="' . $bed_lstr['enter_text'] . '"/>' . "\n" .
     "    </div>\n" .
     "</form>\n";
