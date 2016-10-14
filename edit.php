<?php
include ('./conf.php');

if ((isset ($_GET['f']) && ($_GET['f']) != '')) {
  $bed_file = $_GET['f'];
  $bed_file = str_replace('?' . $bed_load, '', $bed_file);
}

$bed_data = $bed_path . $bed_file;
$bed_body = file_get_contents($bed_data);
$bed_body = str_replace('</textarea>', '<\/textarea>', $bed_body);

if (isset ($_POST['bed_post'])) {
  $bed_text = stripslashes($_POST['bed_text']);
  $bed_text = str_replace('<\/textarea>', '</textarea>', $bed_text);
  file_put_contents($bed_data, $bed_text);
  header('Location: ' . $bed_file);
  //exit:
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-GB">
  <head>
    <title>Browser Edit</title>
    <style type="text/css">body{font-family:Arial,Helvetica,sans-serif;margin:0;padding:0;}a{background-color:transparent;color:inherit;text-decoration:none;}a:hover{background-color:transparent;color:#f00;}#bed_form{position:absolute;top:0;right:0;bottom:0;left:0;background-color:#ccc;color:#000;text-align:center;}#bed_head{position:absolute;top:0;right:0;bottom:24px;left:0;font-size:85%;padding:3px 6px 3px 6px;}#bed_logo{float:left;font-weight:bold;height:24px;}#bed_info{position:absolute;top:24px;left:0;background-color:#ccc;color:#000;font-weight:normal;text-align:right;margin:0;padding:6px 6px 6px 28px;z-index:-1000;}#bed_logo:hover #bed_info{height:auto;z-index:1000;}#bed_file{float:right;margin-bottom:3px;}#bed_area{position:absolute;top:24px;right:0;bottom:36px;left:0;width:99%;margin:0;padding:0;}#bed_text{position:absolute;top:0;right:0;bottom:0;left:0;width:99%;height:100%;overflow:auto;background-color:#009;color:#fff;font-family:"Courier New",Courier,monospace;font-size:100%;margin:0;padding:3px 6px 3px 6px;}#bed_foot{position:absolute;right:0;bottom:0;left:0;padding:1px 2px 1px 2px;}.bed_edit{background-color:#ccc;color:#000;font-size:75%;font-weight:bold;border:1px outset #999;margin:-3px 3px 2px 3px;padding:1px 3px 1px 3px;}.bed_edit:hover{background-color:#fff;color:#000;border:1px inset #999;}</style>
  </head>
  <body>
    <form action="" method="POST" id="bed_form">
      <div id="bed_head">
        <span id="bed_logo">
          <label for="bed_text">&ni;&isin; Browser Edit</label>
          <span id="bed_info"><?php echo $bed_make; ?><br><a href="http://phclaus.com/php-scripts/browser-edit/" title="Visit Browser Edit homepage">www</a></span>
        </span>
        <span id="bed_file">File: <?php echo $bed_file; ?></span>
      </div>
      <div id="bed_area">
        <textarea rows="24" cols="80" name="bed_text" id="bed_text"><?php echo "\n" . $bed_body; ?></textarea>
      </div>
      <div id="bed_foot">
        <input type="reset" value="Undo" title="Undo changes" class="bed_edit">
        <input type="submit" value="Save" title="Save changes" class="bed_edit" name="bed_post">
      </div>
    </form>
  </body>
</html>
