<?php
// load config
include ($_SERVER['DOCUMENT_ROOT'] . '/browser-edit/conf.php');

// form submitted
if (isset ($_POST['bed_submit'])) {
  $bed_login = $_POST['bed_login'];

  // check values and pass file to editor
  if ($bed_login == $bed_pass) {
    header('Location: ' . $bed_edit . '?f=' . $_SERVER['QUERY_STRING']);
    exit;
  } else {
    // invalid login
    echo '<p>Not authorised!</p>';
  }
}
?>
<form action="" method="POST">
  <input name="bed_login" size="12" maxlength="32" title="Enter password" type="password">
  <input name="bed_submit" value="Login" title="Login to edit" type="submit">
</form>
