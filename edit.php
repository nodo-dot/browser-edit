<?php
// load config
include ('./conf.php');

// get filename
if ((isset ($_GET['f']) && ($_GET['f']) != '')) {
  $bed_file = $_GET['f'];
  $bed_file = str_replace('?' . $bed_load, '', $bed_file);
}

// create file handle and get existing content
$bed_data = $bed_path . $bed_file;
$bed_body = file_get_contents($bed_data);

// replace </textarea> with <\/textarea> to prevent premature end of script
$bed_body = str_replace('</textarea>', '<\/textarea>', $bed_body);

// form submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // store content, stripslashes() to keep inline source code intact
  $bed_text = stripslashes($_POST['bed_text']);

  // reset <\/textarea> back to </textarea>
  $bed_text = str_replace('<\/textarea>', '</textarea>', $bed_text);

  // write content back to file and close editor
  file_put_contents($bed_data, $bed_text);
  header('Location: ' . $bed_file);
  exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-GB">
  <head>
    <title>Browser Edit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
    body {
      background-color: #009;
      color: #fff;
      font-family: sans-serif;
      font-size: 95%;
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
      text-align: center;
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      padding: 1px 3px 1px 3px;
    }

    .bed_push {
      background-color: #099;
      color: #ff0;
      font-size: 75%;
      font-weight: bold;
      border: 1px outset #066;
      margin: -3px 3px 2px 3px;
      padding: 1px 3px 1px 3px;
    }

    .bed_push:hover {
      background-color: #066;
      color: #000;
      border: 1px inset #099;
    }
    </style>
  </head>
  <body>
    <form action="" method="POST" id="bed_form">
      <div id="bed_head">
        <strong><a href="http://phclaus.eu.org/php-scripts/browser-edit" title="Browser Edit v<?php echo $bed_make; ?> homepage">&ni;&isin; Browser Edit</a></strong>
        <span id="bed_file"><?php echo $bed_file; ?></span>
      </div>
      <div id="bed_area">
        <textarea rows="24" cols="80" name="bed_text" id="bed_text"><?php echo "\n" . $bed_body; ?></textarea>
      </div>
      <div id="bed_foot">
        <input type="reset" value="Undo" title="Undo all changes" class="bed_push">
        <input type="submit" value="Save" title="Save file and exit" class="bed_push">
      </div>
    </form>
  </body>
</html>
