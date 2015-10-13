# browser-edit

PHP script which to edit a web pages directly in the browser.

Before you can actually use Browser Edit to edit your pages, you'll need to do a little editing. Here is how:

-   open conf.php and edit $bed_load to set the trigger
    The trigger is the query string to the script

    Example: http://www.example.com/foo.php?bedit
    This would load /foo.php into the editor

-   edit $bed_pass to set your password

-   edit $bed_fold to set the relative path

    Example: /site/bed/
    This links to /home/www/public_html/site/bed/

    That's pretty much it in conf.php. Feel free to translate
    the messages if you'd prefer a different language.

-   open load.php and set the relative path
    This value should be the same as $bed_fold

-   open auth.php and repeat the previous step

For the time being you can leave edit.php alone, but if you
get permission errors, have a look and follow instructions.

Create a folder corresponding to the value of $bed_fold on
your server, and upload the lot into that folder.

There is a demo index.php in that folder to test your settings.
Just add the include reference to your global header to enable
Browser Edit on all pages across your site.

From now on, you can patch both contents and mark-up of the
current page directly from within your browser. Happy editing.
