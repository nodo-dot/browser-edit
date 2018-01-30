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
 * Basic authentication to load editor screen
 */


//** Init session and load config
session_start();
require './conf.php';

//** Form posted
if (isset($_POST['bed_post'])) {
    $bed_login = $_POST['bed_pass'];

    //** Check password
    if ($bed_login === $bed_pass) {
        $_SESSION[$bed_name] = $bed_auth;
        header("Location: " . $bed_edit . "?f=" . $_SERVER['QUERY_STRING']);
        exit;
    } else {
        echo "<p>Invalid login!</p>\n";
    }
}

//** Login form
echo '<form action="#" method=POST accept-charset="UTF-8">' . "\n" .
     "    <div>\n" .
     "        <label for=bed_pass>Password</label>\n" .
     '        <input type=password id=bed_pass name=bed_pass ' .
     'size=12 maxlength=32 ' .
     'title="Type here to enter your password"/>' . "\n" .
     '        <input type=submit name=bed_post value=Login ' .
     'title="Click here to login"/>' . "\n" .
     "    </div>\n" .
     "</form>\n";
