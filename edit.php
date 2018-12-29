<?php
/**
 * PHP Version 5 and above
 *
 * Main script
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
 */


//** Init session and load config, language, and syntax high-lighter
session_start();
require "./conf.php";
require $bed_ldat;

//** Init status and action
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

    //** Check tree
    if (!empty($bed_tree) && is_dir($bed_path . $bed_tree)) {

        if (strpos($bed_file, $bed_tree) === false) {
            session_destroy();
            header("Location: " . $bed_back . "#UNAUTHORISED");
            exit;
        } else {
            $bed_data = $bed_path . $bed_file;
        }
    }

    /**
     * Check file exists to catch error when quitting after delete.
     * Mask textarea to prevent premature end of script.
     */
    if (is_file($bed_data)) {
        $bed_body = file_get_contents($bed_data);
        $bed_body = str_replace(
            "</textarea>", "<\/textarea>", $bed_body
        );
    }

    //** Quit editor
    if (isset($_POST['bed_exit'])) {

        //** Fallback when quitting after delete
        if (!is_file($bed_data)) {
            $bed_fget = $bed_back;
        }

        session_destroy();
        header("Location: " . $bed_fget . "#LOGOUT");
        exit;
    }

    //** Delete file
    if (isset($_POST['bed_fdel'])) {
        $bed_file = pathinfo($bed_fget, PATHINFO_BASENAME);
        unlink($bed_path . $bed_tree . $bed_file);
        $bed_stat = $bed_lstr['del_stat'];
        $bed_dele = " class=bed_dele";
    }

    //** Copy, move, or new file
    if (isset($_POST['bed_fcop'])
        || isset($_POST['bed_fren'])
        || isset($_POST['bed_fnew'])
    ) {
        $bed_fsrc = $_POST['bed_fsrc'];

        if (isset($_POST['bed_fnew'])) {
            $bed_done = "NEW";
        }

        //** Check missing filename
        if ($bed_fsrc !== "") {
            $bed_fnew = $bed_path . $bed_tree . $bed_fsrc;
            $bed_fdir = pathinfo($bed_fnew, PATHINFO_DIRNAME);
            $bed_fnam = pathinfo($bed_fnew, PATHINFO_BASENAME);

            //** Create folders
            if (!file_exists($bed_fdir)) {
                mkdir($bed_fdir, 0777, true);
            }

            //** Create file
            if (!file_exists($bed_fnam)) {
                fopen($bed_fnew, 'w');
            }

            $bed_file = pathinfo($bed_fget, PATHINFO_BASENAME);

            //** Copy or rename only
            if ($bed_done !== "NEW") {
                copy($bed_path . $bed_tree . $bed_file, $bed_fnew);
                $bed_done = "COPY";

                //** Remove old file after renaming
                if (isset($_POST['bed_fren'])) {
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

    //** Check mode
    if ($bed_mode !== 0 && $bed_mode !== 1) {
        $bed_mode = 1;
    }

    if (!isset($_SESSION['bed_mode'])) {
        $_SESSION['bed_mode'] = $bed_mode;
    }

    if (isset($_POST['bed_mode'])) {
        $bed_smod = $_SESSION['bed_mode'];

        if ($bed_smod === 1) {
            $_SESSION['bed_mode'] = 0;
        } else {
            $_SESSION['bed_mode'] = 1;
        }
    }

    //** Begin mark-up
    echo "<!DOCTYPE html>\n" .
         "<html lang=\"$bed_lref\">\n" .
         "    <head>\n" .
         "        <title>PHP Browser Edit - $bed_fget</title>\n" .
         "        <meta charset=\"UTF-8\"/>\n" .
         "        <meta name=language content=\"$bed_lref\"/>\n" .
         "        <meta name=viewport content=\"width=device-width, " .
         "height=device-height, initial-scale=1\"/>\n" .
         "        <link rel=stylesheet " .
         "href=\"mode-" . $_SESSION['bed_mode'] . ".css\"/>\n" .
         "    </head>\n" .
         "    <body>\n" .
         "        <form action=\"#\" method=POST id=bed_form " .
         "accept-charset=\"UTF-8\">\n" .
         "            <div id=bed_head>\n" .
         "                <span id=bed_logo><a href=\"" .
         "https://github.com/phhpro/browser-edit\" " .
         "title=\"" . $bed_lstr['get'] . "\">" .
         "PHP Browser Edit v$bed_make</a></span>\n" .
         "                <span id=bed_stat>$bed_stat</span>\n" .
         "                <span id=bed_file$bed_dele>" .
         $bed_lstr['file'] . " $bed_file</span>\n" .
         "            </div>\n" .

         //** Hover left -- tree
         "            <div id=bed_hvlo>\n" .
         "                <div id=bed_hvli>\n" .
         "                    <ol>\n";

    if ($bed_tree !== "") {
        $bed_iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($bed_path . $bed_tree)
        );
    } else {
        echo "                    <li>" .
             $bed_lstr['no_content'] . "</li>\n";
    }

    $bed_list = array();

    foreach ($bed_iter as $bed_item) {
        $bed_list[] = $bed_item->getPathname();
        $bed_link   = str_replace($bed_path, "", $bed_item);

        if ($bed_item->isDir()) {
            continue;
        }

        echo "                        <li>" .
             "<a href=\"$bed_fold" . "edit.php?f=$bed_link\" " .
             "title=\"" . $bed_lstr['edit_text'] . " " .
             $bed_link . "\">$bed_link</a></li>\n";
    }

    unset($bed_item);
    echo "                    </ol>\n" .
         "                </div>\n" . 
         "            </div>\n" .

         //** Main window -- edit
         "            <div id=bed_area>\n" .
         "                <textarea id=bed_text name=bed_text " .
         "rows=24 cols=80>$bed_body</textarea>\n" .
         "            </div>\n" .

         //** Hover right -- view
         "            <div id=bed_hvro>\n" .
         "                <div id=bed_hvri>\n" .
         "                    <object data=\"$bed_file\"></object>\n" .
         "                </div>\n" .
         "            </div>\n" .

         "            <div id=bed_menu>\n" .

         //** Exit
         "                <input type=submit " .
         "id=bed_exit name=bed_exit " .
         "value=\"" . $bed_lstr['exit'] . "\" " .
         "title=\"" . $bed_lstr['exit_text'] . "\"/>\n" .

         //** Mode
         "                <input type=submit " . 
         "id=bed_mode name=bed_mode " .
         "value=\"". $bed_lstr['mode'] . "\" " .
         "title=\"". $bed_lstr['mode_text'] . "\"/>\n" .

         //** Delete
         "                <input type=submit " .
         "id=bed_fdel name=bed_fdel " .
         "value=\"" . $bed_lstr['del'] . "\" " . 
         "title=\"" . $bed_lstr['del_text'] . "\"/>\n" .

         //** Save
         "                <input type=submit " .
         "id=bed_save name=bed_save " .
         "value=\"" . $bed_lstr['save'] . "\" " .
         "title=\"" . $bed_lstr['save_text'] . "\"/>\n" .

         //** File
         "                " . $bed_lstr['file'] . " " .
         "<input id=bed_fsrc name=bed_fsrc " .
         "title=\"" . $bed_lstr['file_text'] . "\"/>\n" .

         //** Copy
         "                <input type=submit " .
         "id=bed_fcop name=bed_fcop " .
         "value=\"" . $bed_lstr['copy'] . "\" " . 
         "title=\"" . $bed_lstr['copy_text'] . "\"/>\n" .

         //** Rename
         "                <input type=submit " .
         "id=bed_fren name=bed_fren " .
         "value=\"" . $bed_lstr['ren'] . "\" " .
         "title=\"" . $bed_lstr['ren_text'] . "\"/>\n" .

         //** New
         "                <input type=submit " .
         "id=bed_fnew name=bed_fnew " .
         "value=\"" . $bed_lstr['new'] . "\" " .
         "title=\"" . $bed_lstr['new_text'] . "\"/>\n" .

         //** End mark-up
         "            </div>\n" .
         "        </form>\n" .
         "    </body>\n" .
         "</html>\n";
} else {
    session_destroy();
    header("Location: " . $bed_back . "#UNAUTHORISED");
    exit;
}
