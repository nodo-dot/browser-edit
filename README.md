# PHP Browser Edit

**PHP Browser Edit** is a **free PHP editor script** to edit web pages directly from within the browser.

Features are minimal, yet functional enough to get the job done. There is no extra `Save as` function because the same result can be achieved using the existing `Copy` function. Simply enter the name of the new file and press the `Copy` button. You can just as easily add a path (without leading /), e.g. foo/bar/baz.txt, to save the copy elsewhere.

Accidentally deleted files can be restored by pressing the `Save` button. However, this is only possible as long as no other action has been used. Hovering the left margin produces the file tree. Hovering the right margin renders a live preview. Moving the pointer out of the area restores the normal editor screen.

Direct access to the editor without a valid file token will fail, regardless whether the password is correct. Any attempt to open a location outside the scope of `$bed_tree`, e.g. by changing the file token in the address bar, will result in the immediate termination of the session.

Setting `$bed_tree` to `"/"` allows unrestricted editing of absolutely everything on the server. This may well break the script when trying to parse a tree containing thousands of files. Use with caution! The initial value defaults to the script's `demo` folder. It should go without saying that `bed_tree` ought to match the user's home directory when running the script in a multi-user environment.

Edit `conf.php` to your likes and then navigate to `index.php` in the script folder to experiment.
