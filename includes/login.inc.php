<?php

$AD = new AD;

if (isset($_GET["logout"])){ $logout = $_GET["logout"]; }
if (isset($_POST["user"])){ $user = $_POST["user"]; }
if (isset($_POST["pass"])){ $pass = $_POST["pass"]; }

#fnDebug("session-user", $_SESSION["user"]);

if (isset($logout)) {
  $userinfo = [];
  $AD->logout();
  header("Location: /");
  die();
} else {
  if (isset($user) && isset($pass)) {
    $login = $AD->login($user, $pass);
    if ($login == TRUE) {
      $_SESSION["user"] = $AD->get_user_info();
    } else {
      $error = "Incorrect username and/or password";
    }
  }
}

if (!isset($_SESSION["user"])) {
  require("includes/loginform.inc.php");
}

?>


