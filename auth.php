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
 * This file prints the login screen.
 */


//** Load config -- "path" if SERVER returns wrong value
include $_SERVER['DOCUMENT_ROOT'] . "/browser-edit/conf.php";

//** Form posted
if (isset($_POST['bed_post'])) {
    $bed_login = $_POST['bed_pass'];

    //** Check login password
    if ($bed_login === $bed_pass) {
        header("Location: " . $bed_edit . "?f=" . $_SERVER['QUERY_STRING']);
        exit;
    } else {
        echo "<p>Invalid login!</p>\n";
    }
}
?>
<form action="#" method=POST accept-charset="UTF-8">
    <div>
        <label for=bed_pass>Password</label>
        <input name=bed_pass id=bed_pass size=12 maxlength=32 title="Type her to enter your password" type=password />
        <input name=bed_post value=Login title="Click here to login" type=submit />
    </div>
</form>
