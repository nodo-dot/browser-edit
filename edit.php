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
 *
 * Main editor script
 */


/**
 * Init session
 * Load config
 * Load language data file
 */
session_start();
require './conf.php';
require $bed_ldat;

/**
 * Init status
 * Init action flag
 */
$bed_stat = "";
$bed_done = "";

//** Check session
if (isset($_SESSION[$bed_name]) && $_SESSION[$bed_name] === $bed_auth) {

    //** Link file object
    if (isset($_GET['f']) && $_GET['f'] !== "") {
        $bed_fget = $_GET['f'];
        $bed_file = htmlentities($bed_fget, ENT_QUOTES, "UTF-8");
        $bed_file = str_replace("?" . $bed_load, "", $bed_file);
    }

    //** Check if tree is set
    if ($bed_tree !== "") {
        //** Match file against tree to prevent unauthorised access
        if (strpos($bed_file, $bed_tree) === false) {
            session_destroy();
            header("Location: " . $bed_back . "#UNAUTHORISED");
            exit;
        }
    }

    //** Link file
    $bed_data = $bed_path . $bed_file;

    /**
     * Need to check if the file exists to catch error when quitting
     * the editor immediately after deleting a file.
     *
     * Because the script uses a textarea to show the file contents,
     * any closing tags in the sources must be masked to prevent a
     * premature end of the script.
     */
    if (file_exists($bed_data)) {
        $bed_body = file_get_contents($bed_data);
        $bed_body = str_replace("</textarea>", "<\/textarea>", $bed_body);
    }

    //** Quit editor
    if (isset($_POST['bed_quit'])) {

        //** Link fallback when quitting after deleting file
        if (!file_exists($bed_data)) {
            $bed_fget = $bed_back;
        }

        //** Clear session and pass page to browser
        session_destroy();
        header("Location: " . $bed_fget . "#LOGOUT");
        exit;
    }

    //** Delete file
    if (isset($_POST['bed_fdel'])) {
        $bed_file = pathinfo($bed_fget, PATHINFO_BASENAME);
        unlink($bed_path . $bed_tree . $bed_file);
        $bed_stat = $bed_lstr['deleted'];
        $bed_dele = " class=bed_dele";
    }

    //** Copy, move, or new file
    if (isset($_POST['bed_fcop'])
        || isset($_POST['bed_fmov'])
        || isset($_POST['bed_fnew'])
    ) {
        $bed_fsrc = $_POST['bed_fsrc'];

        //** New file
        if (isset($_POST['bed_fnew'])) {
            $bed_done = "NEW";
        }

        //** Check missing filename
        if ($bed_fsrc !== "") {

            //** Link path, directory and filename
            $bed_fnew = $bed_path . $bed_tree . $bed_fsrc;
            $bed_fdir = pathinfo($bed_fnew, PATHINFO_DIRNAME);
            $bed_fnam = pathinfo($bed_fnew, PATHINFO_BASENAME);

            //** Create folders if required
            if (!file_exists($bed_fdir)) {
                mkdir($bed_fdir, 0777, true);
            }

            //** Create file
            if (!file_exists($bed_fnam)) {
                fopen($bed_fnew, 'w');
            }

            //** Link file
            $bed_file = pathinfo($bed_fget, PATHINFO_BASENAME);

            //** Copy or rename only
            if ($bed_done !== "NEW") {
                copy($bed_path . $bed_tree . $bed_file, $bed_fnew);
                $bed_done = "COPY";

                //** Remove old file after renaming
                if (isset($_POST['bed_fmov'])) {
                    unlink($bed_path . $bed_tree . $bed_file);
                    $bed_done = "MOVE";
                }
            }

            //** Edit file
            $bed_fnew = str_replace($bed_path, "", $bed_fnew);
            header("Location: ?f=" . $bed_fnew . "#" . $bed_done);
        } else {
            header("Location: ?f=" . $bed_fget . "#MISSING_FILENAME");
        }

        exit;
    }

    //** Save file
    if (isset($_POST['bed_save'])) {
        $bed_text = stripslashes($_POST['bed_text']);
        $bed_text = str_replace("<\/textarea>", "</textarea>", $bed_text);
        file_put_contents($bed_data, $bed_text);
        header("Location: ?f=" . $bed_fget . "#SAVE");
        exit;
    }

    //** Editor screen
    echo "<!DOCTYPE html>\n" .
         '<html lang="' . $bed_lref . '">' . "\n" .
         "    <head>\n" .
         "        <title>PHP Browser Edit - $bed_fget</title>\n" .
         '        <meta charset="UTF-8"/>' . "\n" .
         '        <meta name=language ' .
         'content="' . $bed_lref . '"/>' . "\n" .
         '        <meta name=viewport content="width=device-width, ' .
         'height=device-height, initial-scale=1"/>' . "\n" .
         '        <link rel=stylesheet href="edit.css"/>' . "\n" .
         "    </head>\n" .
         "    <body>\n" .
         '        <form action="#" method=POST id=bed_form ' .
         'accept-charset="UTF-8">' . "\n" .
         "            <div id=bed_head>\n" .
         '                <span id=bed_logo><a href="' .
         'https://github.com/phhpro/browser-edit" ' .
         'title="' . $bed_lstr['get_script'] . '">' .
         "&#x220B;&#x2208; PHP Browser Edit v$bed_make</a></span>\n" .
         "                <span id=bed_stat>$bed_stat</span>\n" .
         '                <span id=bed_file' . $bed_dele .
         '>' . $bed_lstr['file'] . ' ' . $bed_file . "</span>\n" .
         "            </div>\n" .

         //** Tree
         "            <div id=bed_tree>\n" .
         "                <div id=bed_list>\n" .
         "                    <ul>\n";

    //** Check empty tree and prepare iterator
    if ($bed_tree !== "") {
        $bed_iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($bed_path . $bed_tree)
        );
    } else {
        echo "                    <li>" .
             $bed_lstr['empty_tree'] . "</li>\n";
    }

    //** Link items
    $bed_list = array();

    //** Parse tree
    foreach ($bed_iter as $bed_item) {

        //** Build item link
        $bed_list[] = $bed_item->getPathname();
        $bed_link   = str_replace($bed_path, "", $bed_item);

        //** Item is directory
        if ($bed_item->isDir()) {
            continue;
        }

        //** Item is file
        echo '                        <li><a href="' . $bed_fold .
             'edit.php?f=' . $bed_link . '" title="' .
             $bed_lstr['edit_text'] . ' ' . $bed_link . '">' .
             $bed_link . "</a></li>\n";
    }

    //** Clear item
    unset($bed_item);

    //** Close tree
    echo "                    </ul>\n" .
         "                </div>\n" . 
         "            </div>\n" .

         //** Editor
         "            <div id=bed_area>\n" .
         '                <textarea id=bed_text name=bed_text ' .
         "rows=24 cols=80>$bed_body</textarea>\n" .
         "            </div>\n" .

         //** Preview
         "            <div id=bed_vsrc>\n" .
         "                <div id=bed_vweb>\n" .
         '                    <object data="' . $bed_file .
         '"></object>' . "\n" .
         "                </div>\n" .
         "            </div>\n" .

         //** Menu
         "            <div id=bed_menu>\n" .

         // Hover
         "                <div>\n" .
         '                <span id=bed_slft title="' .
         $bed_lstr['left_text'] . '">' . $bed_lstr['left'] .
         '</span>' . "\n" .
         '                <span id=bed_srgt title="' .
         $bed_lstr['right_text'] . '">' . $bed_lstr['right'] .
         '</span>' . "\n" .
         "                </div>\n" .

         //** Quit
         '                <input type=submit value="'.
         $bed_lstr['quit'] .'" id=bed_quit name=bed_quit ' .
         'title="'. $bed_lstr['quit_text'] . '"/>' . "\n" .

         //** Delete
         '                <input type=submit value="' .
         $bed_lstr['del'] . '" id=bed_fdel name=bed_fdel ' .
         'title="' . $bed_lstr['del_text'] . '"/>' . "\n" .

         //** Filename
         '                ' . $bed_lstr['file'] . ' <input ' .
         'id=bed_fsrc name=bed_fsrc ' .
         'title="' . $bed_lstr['file_text'] . '"/>' . "\n" .

         //** Copy
         '                <input type=submit value="' .
         $bed_lstr['copy'] . '" id=bed_fcop name=bed_fcop ' .
         'title="' . $bed_lstr['copy_text'] . '"/>' . "\n" .

         //** Move
         '                <input type=submit value="' .
         $bed_lstr['move'] . '" id=bed_fmov name=bed_fmov ' .
         'title="' . $bed_lstr['move_text'] . '"/>' . "\n" .

         //** New
         '                <input type=submit value="' .
         $bed_lstr['new'] . '" id=bed_fnew name=bed_fnew ' .
         'title="' . $bed_lstr['new_text'] . '"/>' . "\n" .

         //** Save
    '                <input type=submit value="' .
         $bed_lstr['save'] . '" id=bed_save name=bed_save ' .
         'title="' . $bed_lstr['save_text'] . '"/>' . "\n" .

         //** Close menu, form, and file
         "            </div>\n" .
         "        </form>\n" .
         "    </body>\n" .
         "</html>\n";
} else {
    //** Clear session and load fallback
    session_destroy();
    header("Location: " . $bed_back . "#UNAUTHORISED");
    exit;
}
