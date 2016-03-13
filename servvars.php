cloud-001 - servvars.php

<?php
foreach($_SERVER as $key_name => $key_value) {
print $key_name . " = " . $key_value . "<br>";
}
?>
