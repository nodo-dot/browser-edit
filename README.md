# Browser Edit

PHP script to edit web pages directly from within the browser.

Before you can use Browser Edit, you'll need to do a little editing yourself:

-   open conf.php and edit $bed_load to set the trigger
-   edit $bed_pass to set your password
-   edit $bed_fold to set the relative path
-   edit load.php and set the relative path (should be equal to $bed_fold)
-   open auth.php and repeat the previous step

For the time being you can leave edit.php alone. If you get permission errors, have a look and follow instructions. Create a folder corresponding to the value of $bed_fold on your server and upload. There is a demo index.php to test your settings. Just add a reference to Browser Edit either in the page header or your global header. You can now edit the page directly from within your browser.
