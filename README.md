# Browser Edit

**Browser Edit** is a **free PHP script** to edit web pages directly from within the browser.

Open `conf.php` and edit the below to match your environment.

- `$bed_fold` script folder
- `$bed_load` access token
- `$bed_pass` editor password

Next open `load.php` and `auth.php` to set the path to `conf.php`

Now add a reference to `load.php` in your global header or the files you want to enable for editing.

Append `?ACCESS_TOKEN` to the URL to edit the given file.

You can test the script using the demo `index.php`.
