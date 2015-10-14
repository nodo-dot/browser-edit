# Browser Edit

PHP script to edit web pages directly from within the browser.

Before you can use Browser Edit, you'll need to:

-   open conf.php and edit $bed_load to set the trigger
-   edit $bed_pass to set your password
-   edit $bed_fold to set the relative path
-   open load.php and set the relative path
-   open auth.php and repeat the previous step

For the time being you can leave edit.php alone. If you get permission errors, have a look inside and follow instructions. Create a folder corresponding to the value of $bed_fold and upload. Use the demo index.php to test your settings. Include a reference to the script in your global header to enable Browser Edit.
