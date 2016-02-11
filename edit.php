<?php
// load config
include ('./conf.php');

// get filename
if ((isset ($_GET['f']) && ($_GET['f']) != '')) {
  $bed_file = $_GET['f'];
  $bed_file = str_replace('?' . $bed_load, '', $bed_file);
}

// create file handle
$bed_data = $bed_path . $bed_file;

// uncomment if you have permission issues
// @chmod($bed_data, 0666);

// get existing contents
$bed_body = file_get_contents($bed_data);

// replace </textarea> with <\/textarea> to prevent premature end of script
$bed_body = str_replace('</textarea>', '<\/textarea>', $bed_body);

// form submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // store contents, stripslashes() to keep in-page source codes intact
  $bed_text = stripslashes($_POST['bed_text']);

  // reset <\/textarea> back to </textarea>
  $bed_text = str_replace('<\/textarea>', '</textarea>', $bed_text);

  // write contents back to file
  file_put_contents($bed_data, $bed_text);

  // uncomment if you have permission issues
  // @chmod($bed_data, 0644);

  // close editor
  header('Location: ' . $bed_file);
  exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-GB">
  <head>
    <title><?php echo $bed_lang['name']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <style type="text/css">
    body {
      background-color: #009;
      color: #fff;
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
    }

    #bed_head {
      background-color: #099;
      color: #ff0;
      position: absolute;
      top: 0;
      right: 0;
      bottom: 24px;
      left: 0;
      font-size: 85%;
      padding: 3px 6px 3px 6px;
    }

    #bed_logo {
      float: left;
      font-weight: bold;
      height: 24px;
    }

    #bed_info {
      background-color: #099;
      color: #ff0;
      position: absolute;
      top: 24px;
      left: 0;
      font-weight: normal;
      text-align: right;
      margin: 0;
      padding: 6px 6px 6px 28px;
      z-index: -1000;
    }

    #bed_logo:hover #bed_info {
      height: auto;
      z-index: 1000;
    }

    a {
      background-color: transparent;
      color: inherit;
      text-decoration: none;
    }

    a:hover {
      background-color: transparent;
      color: #000;
    }

    #bed_form {
      text-align: center;
      margin: 0;
      padding: 0;
    }

    #bed_file {
      float: right;
      margin-bottom: 3px;
    }

    #bed_area {
      background-color: #009;
      color: #fff;
      position: absolute;
      top: 24px;
      right: 0;
      bottom: 26px;
      left: 0;
      margin: 0;
      padding: 0;
    }

    textarea {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      border: 0;
    }

    #bed_text {
      background-color: #009;
      color: #fff;
      position: absolute;
      top: 0;
      right: 2px;
      bottom: 0;
      left: 0;
      width: 99%;
      overflow: auto;
      font-family: monospace;
      font-size: 100%;
      margin: 0;
      padding: 3px 6px 3px 6px;
    }

    #bed_foot {
      background-color: #099;
      color: #ff0;
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      padding: 1px 3px 1px 3px;
    }

    .bed_edit {
      background-color: #099;
      color: #ff0;
      font-size: 75%;
      font-weight: bold;
      border: 1px outset #066;
      margin: -3px 3px 2px 3px;
      padding: 1px 3px 1px 3px;
    }

    .bed_edit:hover {
      background-color: #066;
      color: #000;
      border: 1px inset #099;
    }
    </style>
  </head>
  <body>
    <form action="" method="POST" id="bed_form">
      <div id="bed_head">
        <span id="bed_logo">
          <label for="bed_text">&ni;&isin; <?php echo $bed_lang['name']; ?></label>
          <span id="bed_info"><?php echo $bed_make; ?><br><a href="http://phclaus.eu.org/php-scripts/browser-edit" title="<?php echo $bed_lang['home']; ?>"><?php echo $bed_lang['home']; ?></a></span>
        </span>
        <span id="bed_file"><?php echo $bed_lang['file']; ?>: <?php echo $bed_file; ?></span>
      </div>
      <div id="bed_area">
        <textarea rows="24" cols="80" name="bed_text" id="bed_text" title="<?php echo $bed_lang['edit']; ?>"><?php echo "\n" . $bed_body; ?></textarea>
      </div>
      <div id="bed_foot">
        <input type="reset" value="<?php echo $bed_lang['undo']; ?>" title="<?php echo $bed_lang['void']; ?>" class="bed_edit">
        <input type="submit" value="<?php echo $bed_lang['done']; ?>" title="<?php echo $bed_lang['save']; ?>" class="bed_edit">
      </div>
    </form>
  </body>
</html>
