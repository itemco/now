<?php

# auto include classes as they are called
function __autoload($class_name)
{
    include_once "../classes/class.".$class_name.".inc.php";
}

#debug function
function fnDebug($title, $data = "")
{
  if (isset($_GET["debug"])) {
    echo "<pre>";
    if ($title != "") {
      echo "<b>=== $title ===</b><br/>";
    }
    print_r($data);
    echo "</pre>";
  }
}

#global variables that we set here for now. Should be set elsewhere later on!
$domain = "pop.nu";
#$domain = "ppm.nu";

fnDebug("domain (global.inc)", $domain);

?>
