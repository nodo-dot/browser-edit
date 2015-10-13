# browser-edit

PHP script which to edit a web pages directly in the browser.

Before you can actually use Browser Edit to edit your pages, you'll need to do a little editing:

-   open conf.php and edit $bed_load to set the trigger
-   edit $bed_pass to set your password
-   edit $bed_fold to set the relative path
-   edit load.php and set the relative path (should be equal to $bed_fold)
-   open auth.php and repeat the previous step

For the time being you can leave edit.php alone, but if you get permission errors, have a look and follow instructions. Create a folder corresponding to the value of $bed_fold on your server, and upload the lot into that folder. There is a demo index.php in that folder to test your settings. Just add the include reference to your global header to enable
Browser Edit on all pages across your site. From now on, you can patch both contents and mark-up of the current page directly from within your browser. Happy editing.
