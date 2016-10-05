<?php
include ('/path/to/bed/conf.php');

if (isset ($_POST['bed_post'])) {
  $bed_login = $_POST['bed_pass'];

  if ($bed_login == $bed_pass) {
    header('Location: ' . $bed_edit . '?f=' . $_SERVER['QUERY_STRING']);
    exit;
  } else {
    echo '<p>Invalid login!</p>';
  }
}
?>
<form action="" method="POST">
  <div>
    <label for="bed_pass">Password</label>
    <input type="password" name="bed_pass" id="bed_pass" size="12" maxlength="32" title="Please enter your password">
    <input type="submit" value="Login" title="Click here to login" name="bed_post">
  </div>
</form>
