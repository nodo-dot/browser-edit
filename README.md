# PHP Browser Edit

**PHP Browser Edit** is a **free PHP editor script** to edit web pages directly from within the browser.

Note: This script expects the user to have a solid understanding of the sources being edited. This is not a fancy WYSIWYG toy or point-and-click thing.

Features are minimal. There's no extra **`Save as`** because the same can be achieved with **`Copy`**. Simply enter a file name and press the appropiate button. You can add a path (without leading /), e.g. **`new/dir/file.ext`**, to save the file at a different location.

Deleted files can be restored by pressing the `Save` button immediately after deleting. Hovering the left margin produces a file tree, the right margin renders a web preview. Moving the pointer out of the area restores the normal editor screen.

Direct access without a valid file token will fail, even if the password is correct. Any attempt to open a file outside the scope of **`$bed_tree`**, e.g. by changing the token in the address bar, immediately terminates the session.

The expected syntax to pass a file to the editor is via **`load.php`**, e.g. **`load.php?/path/to/file.xyz`**. You probably want to point **`$bed_tree`** to a directory above the script folder. You can do so by setting 
**`$bed_tree = "/dir/";`** or **`$bed_tree = "/dir1/dir2/";`**, etc.

Edit **`conf.php`** to your likes and then navigate to **`index.php`** in the script folder to experiment. Once you are familiar with the script, and have set **`$bed_tree`** to point to the proper location, it's safe to delete the **`demo`** folder.
