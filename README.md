# Browser Edit

**Browser Edit** is a **free PHP script** to edit web pages directly from within the browser.

Before you can use **Browser Edit**, you'll need to open `conf.php` and edit:

- `$bed_path` to set the path to your public html folder
- `$bed_fold` to set the relative path to the script folder
- `$bed_load` to set the trigger token
- `$bed_pass` to set your password

Next, open `load.php` and `auth.php` and set the full path to `conf.php`

For the time being you can leave edit.php alone. If you are getting permission errors have a look inside and follow instructions. Create a folder corresponding to the value of `$bed_fold` and upload the script. Use the demo `index.php` to test your settings. Include a reference to the script in the files you want to enable for editing or simply link it in your global header to enable **Browser Edit** for all files.

[Script homepage](http://phclaus.com/php-scripts/browser-edit/)
