# PHP Browser Edit

**PHP Browser Edit** is a **free PHP editor script** to edit web pages directly from within the browser.

It supports basic features like selecting files from a tree list, preview in browser mode, create new files, and delete existing files. Accidentally deleted files can be restored by pressing the `Save` button, but only as long as no other files have been loaded or editor functions been used.

Start by editing `conf.php` to your likes, then refer to the demo index to see an example link how to pass a file to the editor. Direct access to the editor without a valid file token will fail, regardless if the password is correct.

The default tree from where to read files is set in `$bed_tree` and initially limits editing to the script's demo folder. Setting this to `"/"` allows unrestricted editing of all files on the server. You really want to make sure the value matches the user's home directory when running the script in a multi-user environment.

Any attempt to open a location outside the scope of `$bed_tree`, e.g. by changing the file token in the address bar, will result in the immediate termination of the current session and return to the previous page.

Hovering the left margin produces the tree list, while hovering the right margin renders a preview of the current file in browser mode. Obviously this only applies to mark-up files, like HTML or PHP. Moving the pointer out of the layer restores the editor screen.

Follow this link to [try the demo](http://phclaus.com/demo/browser-edit/).
