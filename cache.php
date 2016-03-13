<?php

echo "Testing APC cache<br/>";

#phpinfo();

$plugin = "df";

$shit[$plugin] = apc_fetch("shit[$plugin]");
echo $shit[$plugin];
if (!$shit[$plugin]) {
  apc_add("shit[$plugin]", time(), 10);
}
echo $shit[$plugin];
echo $shit["df"];


?>

