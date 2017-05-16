<?php
//** load config
include ($_SERVER['DOCUMENT_ROOT'] . "/site/bed/conf.php");

//** form posted
if (isset ($_POST['bed_post'])) {
  $bed_login = $_POST['bed_pass'];

  //** check login password
  if ($bed_login === $bed_pass) {
    header("Location: " . $bed_edit . "?f=" . $_SERVER['QUERY_STRING']);
    exit;
  } else {
    echo "<p>Invalid login!</p>\n";
  }
}
?>
<form action="#" method=POST accept-charset=UTF-8>
  <div>
    <label for=bed_pass>Password</label>
    <input name=bed_pass id=bed_pass size=12 maxlength=32 title="Please enter your password" type=password />
    <input name=bed_post value=Login title="Click here to login" type=submit/>
  </div>
</form>
