<?php
//** load config
include ('./conf.php');

//** missing or empty file token
if (isset ($_GET['f'] && $_GET['f']) != '') {
  $bed_file = $_GET['f'];
  $bed_file = str_replace('?' . $bed_load, '', $bed_file);
}

//** link file
$bed_data = $bed_path . $bed_file;
$bed_body = file_get_contents($bed_data);
$bed_body = str_replace('</textarea>', '<\/textarea>', $bed_body);

//** form posted
if (isset ($_POST['bed_post'])) {
  $bed_text = stripslashes($_POST['bed_text']);
  $bed_text = str_replace('<\/textarea>', '</textarea>', $bed_text);
  file_put_contents($bed_data, $bed_text);
  header("Location: $bed_file");
  //** no exit here because it breaks the script
}
?>
<!DOCTYPE html>
<html lang="en-GB">
  <head>
    <title>Browser Edit</title>
    <meta charset="UTF-8" />
    <meta name="language" content="en-GB" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo $bed_fold; ?>bedit.css" type="text/css" />
  </head>
  <body>
    <form action="#OK" method="POST" id="bed_form" accept-charset="UTF-8">
      <div id="bed_head">
        <span id="bed_logo">
          <label for="bed_text">&ni;&isin; Browser Edit</label>
          <span id="bed_info">Browser Edit v<?php echo $bed_make; ?><br /><br />Edit webpages directly inside the browser.<br /><br /><a href="http://phclaus.com/php-scripts/browser-edit/" title="Visit Browser Edit homepage">Homepage</a></span>
        </span>
        <span id="bed_file">File: <?php echo $bed_file; ?></span>
      </div>
      <div id="bed_area">
        <textarea rows="24" cols="80" name="bed_text" id="bed_text"><?php echo "\n" . $bed_body; ?></textarea>
      </div>
      <div id="bed_foot">
        <input type="reset" value="Undo" title="Undo changes" class="bed_edit" />
        <input type="submit" value="Save" title="Save changes" class="bed_edit" name="bed_post" />
      </div>
    </form>
  </body>
</html>
