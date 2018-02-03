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
 * Demo index
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Browser Edit Demo</title>
    </head>
    <body>
        <h1>PHP Browser Edit Demo</h1>
        <p>This is the PHP Browser Edit test page.</p>
        <p>The demo login password is <code>edit</code>.</p>
        <p>The demo is restricted to read files from the <code>demo</code> folder only.</p>
        <p><a href="/browser-edit/load.php?/browser-edit/demo/test.php" title="Click here to test authorised editing">PASS -- File is within the scope</a></p>
        <p><a href="/browser-edit/load.php?/index.php" title="Click here to test unauthorised editing">FAIL -- File is outside the scope</a></p>
        <p>Hint: Move your pointer to the far left to show the tree list.</p>
    </body>
</html>
