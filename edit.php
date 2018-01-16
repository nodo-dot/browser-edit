<?php
/**
 * PHP Version 5 and above
 *
 * @category  PHP_Editor_Scripts
 * @package   PHP_Browser_Edit
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2015 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @version   GIT: Latest
 * @link      https://github.com/phhpro/browser-edit
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 */


//** Load config
include './conf.php';

//** Link file object
$bed_fget = $_GET['f'];

//** Check missing or empty file object
if (isset($bed_fget) && $bed_fget !== "") {
    $bed_file = htmlentities($bed_fget, ENT_QUOTES, "UTF-8");
    $bed_file = str_replace("?" . $bed_load, "", $bed_file);
} else {
    echo "<p>Cannot edit non-existing file!</p>";
}

//** Link file object and prepare body
$bed_data = $bed_path . $bed_file;
$bed_body = file_get_contents($bed_data);
$bed_body = str_replace("</textarea>", "<\/textarea>", $bed_body);

//** Form posted -- no exit after header because it would break things
if (isset($_POST['bed_post'])) {
    $bed_text = stripslashes($_POST['bed_text']);
    $bed_text = str_replace("<\/textarea>", "</textarea>", $bed_text);
    file_put_contents($bed_data, $bed_text);
    header("Location: $bed_file");
}
?>
<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>PHP Browser Edit</title>
        <meta charset="UTF-8"/>
        <meta name=language content="en-GB"/>
        <meta name=viewport content="width=device-width, height=device-height, initial-scale=1"/>
        <link rel=stylesheet href="<?php echo $bed_fold; ?>edit.css" type="text/css"/>
    </head>
    <body>
        <form action="#OK" method=POST id=bed_form accept-charset="UTF-8">
            <div id=bed_head>
                <div id=bed_logo>
                <label for=bed_text>&ni;&isin; PHP Browser Edit</label>
                    <div id=bed_info><p><strong>PHP Browser Edit v<?php echo $bed_make; ?></strong></p><p>A free PHP script to edit web pages directly from within the browser.</p><p><a href="https://github.com/phhpro/browser-edit" title="Click here to get a free copy of this script">Click here to get a free copy.</a></p></div>
                </div>
                <span id=bed_file>File: <?php echo $bed_file; ?></span>
            </div>
            <div id=bed_area>
                <textarea name=bed_text id=bed_text rows=24 cols=80><?php echo "\n" . $bed_body; ?></textarea>
            </div>
            <div id=bed_foot>
                <input type=reset value=Undo class=bed_edit title="Click here to undo all changes"/>
                <input type=submit name=bed_post value=Save class=bed_edit title="Click here to save all changes and quit the editor"/>
            </div>
        </form>
    </body>
</html>
