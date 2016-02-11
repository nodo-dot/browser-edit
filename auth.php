<?php
// load config
include ($_SERVER['DOCUMENT_ROOT'] . '/bedit/conf.php');

// form submitted
if (isset ($_POST['bed_submit'])) {
  $bed_login = $_POST['bed_login'];

  // check values and pass file to editor
  if ($bed_login == $bed_pass) {
    header('Location: ' . $bed_edit . '?f=' . $_SERVER['QUERY_STRING']);
    exit;
  } else {
    echo '<p>' . $bed_lang['auth'] . '</p>';
  }
}
?>
<form action="" method="POST">
  <input name="bed_login" size="12" maxlength="32" 
         title="<?php echo $bed_lang['pass']; ?>" type="password">
  <input name="bed_submit" value="<?php echo $bed_lang['ok']; ?>" 
         title="<?php echo $bed_lang['post']; ?>" type="submit">
</form>
<?php echo $bed_file; ?>
