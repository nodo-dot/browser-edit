# Browser Edit

Free PHP script to edit web pages directly from within the browser.

Before you can use *Browser Edit*, you'll need to open `conf.php` and edit:

- `$bed_load` to set the trigger
- `$bed_pass` to set your password
- `$bed_fold` to set the relative path

Next, open `load.php` and `auth.php` and set the proper path

For the time being you can leave edit.php alone. If you are getting permission errors, have a look inside and follow instructions. Create a folder corresponding to the value of `$bed_fold` and upload. Use the demo `index.php` to test your settings. Include a reference to the script in your global header to enable *Browser Edit*.

[Script homepage](http://phclaus.eu.org/php-scripts/browser-edit)
