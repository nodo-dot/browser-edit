# PHP Browser Edit

**PHP Browser Edit** is a **free PHP editor script** to edit web pages directly from within the browser.

Start by editing `conf.php` to your likes, then refer to the demo index to see an example link how to pass a given file to the editor. You can also access the editor directly by navigating to either `load.php` or `edit.php` in the script folder. However, unless you have a valid editor session, `edit.php` will automatically redirect you back to `load.php` to the login screen.

The default tree from where to read files is set in `$bed_tree` and initially restricts editing to the script's demo folder. Setting this to `/` allows unrestricted editing of all files on the server. You really want to make sure the value matches the user's home directory when using the script in a multi-user environment.

Any attempt to open a location outside the scope of `$bed_tree`, e.g. by changing the file token in the address bar, will result in the immediate termination of the current session and return to the login screen.

Follow this link to [try the demo](http://phclaus.com/demo/browser-edit/).
