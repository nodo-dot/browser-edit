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
 *
 *
 * Main editor script
 */


//** Init session and load config
session_start();
require './conf.php';

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
            header("Location: " . $bed_href . "#UNAUTHORISED");
            exit;
        }
    }

    /**
     * Link file object and prepare body
     *
     * Because the script uses a textarea element to display the file
     * contents, any closing textarea tags in the sources need to be
     * masked first to prevent a premature end of the script. None of
     * this is visible to the user and fully restored when saving.
     */
    $bed_data = $bed_path . $bed_file;
    $bed_body = file_get_contents($bed_data);
    $bed_body = str_replace("</textarea>", "<\/textarea>", $bed_body);

    //** Save file
    if (isset($_POST['bed_save'])) {
        $bed_text = stripslashes($_POST['bed_text']);
        $bed_text = str_replace("<\/textarea>", "</textarea>", $bed_text);
        file_put_contents($bed_data, $bed_text);
        header("Location: ?f=" . $bed_fget . "#SAVED");
        exit;
    }

    //** Create new file
    if (isset($_POST['bed_fnew'])) {
        $bed_fsrc = $_POST['bed_fsrc'];

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

            //** Load new file into editor
            $bed_fnew = str_replace($bed_path, "", $bed_fnew);
            header("Location: ?f=" . $bed_fnew . "#CREATED");
        } else {
            header("Location: ?f=" . $bed_fget . "#MISSING_FILENAME");
        }

        exit;
    }

    //** Delete file
    if (isset($_POST['bed_fdel'])) {
        $bed_file = pathinfo($bed_fget, PATHINFO_BASENAME);
        unlink($bed_path . $bed_tree . $bed_file);
        $bed_stat = "FILE DELETED -- Press <code>Save</code> to restore\n";
    }

    //** Quit editor
    if (isset($_POST['bed_quit'])) {
        session_destroy();
        header("Location: " . $bed_fget . "#LOGOUT");
        exit;
    }

    //** Editor screen
    echo "<!DOCTYPE html>\n" .
         '<html lang="en-GB">' . "\n" .
         "    <head>\n" .
         "        <title>PHP Browser Edit</title>\n" .
         '        <meta charset="UTF-8"/>' . "\n" .
         '        <meta name=language content="en"/>' . "\n" .
         '        <meta name=viewport content="width=device-width, ' .
         'height=device-height, initial-scale=1"/>' . "\n" .
         '        <link rel=stylesheet ' .
         'href="' . $bed_fold . 'edit.css" type="text/css"/>' . "\n" .
         "    </head>\n" .
         "    <body>\n" .
         '        <form action="#" method=POST id=bed_form ' .
         'accept-charset="UTF-8">' . "\n" .
         "            <div id=bed_head>\n" .
         '                <span id=bed_logo><a href="' .
         'https://github.com/phhpro/browser-edit" ' .
         'title="Click here to get a free copy of this script.">' .
         "&#x220B;&#x2208; PHP Browser Edit v$bed_make</a></span>\n" .
         "                <span id=bed_stat>$bed_stat</span>\n" .
         "                <span id=bed_file>File: $bed_file</span>\n" .
         "            </div>\n" .
         "            <div id=bed_tree>\n" .
         "                <div id=bed_list>\n" .
         "                    <ul>\n";

    //** Check empty tree and prepare iterator
    if ($bed_tree !== "") {
        $bed_iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($bed_path . $bed_tree)
        );
    } else {
        echo "                    <li>Warning: Found empty tree!</li>\n" .
             "                    <li>Please check your settings.</li>\n";
    }

    //** Link items
    $bed_list = array();

    //** Parse tree
    foreach ($bed_iter as $bed_item) {

        //** Build item link
        $bed_list[] = $bed_item->getPathname();
        $bed_link = str_replace($bed_path, "", $bed_item);

        //** Item is directory
        if ($bed_item->isDir()) {
            continue;
        }

        //** Item is file
        echo '                        <li><a href="' . $bed_fold .
             'edit.php?f=' . $bed_link . '" title="Click here to edit ' .
             $bed_link . '">' . $bed_link . "</a></li>\n";
    }

    //** Clear item
    unset($bed_item);

    //** Close list and print footer
    echo "                    </ul>\n" .
         "                </div>\n" . 
         "            </div>\n" .
         "            <div id=bed_area>\n" .
         '                <textarea id=bed_text name=bed_text ' .
         "rows=24 cols=80>\n$bed_body\n</textarea>\n" .
         "            </div>\n" .
         "            <div id=bed_vsrc>\n" .
         "                <div id=bed_vweb>\n" .
         '                    <object data="' . $bed_file .
         '"></object>' . "\n" .
         "                </div>\n" .
         "            </div>\n" .
         "            <div id=bed_foot>\n" .
         '                <span id=bed_slft title="Hover left ' .
         'margin to view the file tree.">TREE</span>' . "\n" .
         '                <input type=submit value="Quit" ' .
         'title="Click here to quit the editor." ' .
         "id=bed_quit name=bed_quit />\n" .
         '                <input type=submit value="Delete" ' .
         'title="Click here to delete this file. Its contents will ' .
         'remain in memory for the time being, so if you deleted ' .
         'the file accidentally, you can still press the Save ' .
         'button to restore it." ' .
         "id=bed_fdel name=bed_fdel />\n" .
         '                <input ' .
         'title="Type here to enter the name of the new file. You ' .
         'can add a path (without leading /, e.g. foo/bar/baz.txt) ' .
         'to create the file in a different location." ' .
         "name=bed_fsrc id=bed_fsrc />\n" .
         '                <input type=submit value="New" ' .
         'title="Click here to create a new file." ' .
         "id=bed_fnew name=bed_fnew />\n" .
         '                <input type=submit value="Save" ' .
         'title="Click here to save all changes or to restore ' .
         'an accidentally deleted file." ' .
         "id=bed_save name=bed_save />\n" .
         '                <span id=bed_srgt title="Hover the right ' .
         'margin to view the file in browser mode.">VIEW</span>' . "\n" .
         "            </div>\n" .
         "        </form>\n" .
         "    </body>\n" .
         "</html>\n";
} else {
    //** Clear session and return to login
    session_destroy();
    header("Location: " . $bed_href . "#UNAUTHORISED");
    exit;
}
