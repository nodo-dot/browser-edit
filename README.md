# PHP Browser Edit

**PHP Browser Edit** is a **free PHP editor script** to edit web pages directly from within the browser.

- Edit `conf.php` to match your environment.
- Edit `load.php` and `auth.php` to adjust the path to `conf.php`
- Add a reference to `load.php` at the top of every file for which you want to enable editing. Refer to the demo `index.php` for an example.

Append `?ACCESS_TOKEN` as configured in `conf.php => $bed_load` to the URL to edit the given file.
