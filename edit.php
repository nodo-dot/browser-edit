<?php
//** load config
include ('./conf.php');

//** check missing or empty file token
if (isset ($_GET['f'] && $_GET['f']) !== "") {
  $bed_file = htmlentities($_GET['f'], ENT_QUOTES, "UTF-8");
  $bed_file = str_replace("?" . $bed_load, "", $bed_file);
}

//** link file and prepare body
$bed_data = $bed_path . $bed_file;
$bed_body = file_get_contents($bed_data);
$bed_body = str_replace("</textarea>", "<\/textarea>", $bed_body);

//** form posted
if (isset ($_POST['bed_post'])) {
  $bed_text = stripslashes($_POST['bed_text']);
  $bed_text = str_replace("<\/textarea>", "</textarea>", $bed_text);
  file_put_contents($bed_data, $bed_text);
  header("Location: $bed_file");
  //** no exit here because it would break things
}
?>
<!DOCTYPE html>
<html lang="en-GB">
  <head>
    <title>Browser Edit</title>
    <meta charset="UTF-8"/>
    <meta name=language content="en-GB"/>
    <meta name=viewport content="width=device-width, height=device-height, initial-scale=1"/>
    <link rel=stylesheet href="<?php echo $bed_fold; ?>bedit.css" type="text/css"/>
  </head>
  <body>
    <form action="#OK" method=POST id=bed_form accept-charset="UTF-8">
      <div id=bed_head>
        <span id=bed_logo>
          <label for=bed_text>&ni;&isin; Browser Edit</label>
          <span id=bed_info>Browser Edit v<?php echo $bed_make; ?><br/><br/>Free PHP script to edit web pages directly from inside the browser.<br/><br/><a href="https://github.com/phhpro/browser-edit" title="Click here to visit the Browser Edit repository">Homepage</a></span>
        </span>
        <span id=bed_file>File: <?php echo $bed_file; ?></span>
      </div>
      <div id=bed_area>
        <textarea name=bed_text id=bed_text rows=24 cols=80><?php echo "\n" . $bed_body; ?></textarea>
      </div>
      <div id=bed_foot>
        <input value=Undo title="Click here to undo all changes" class=bed_edit type=reset />
        <input value=Save title="Click here to save all changes" class=bed_edit name=bed_post type=reset />
      </div>
    </form>
  </body>
</html>
