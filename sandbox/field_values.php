<?php

//$db = mysqli_connect('localhost', '');
$x = 'a';
echo "Present Value ({$x}): ";
echo (has_presence($x)) ? "TRUE" : "false";




function has_presence($value) {
    return ((isset($value) && $value !== "") || is_numeric($value));
}

?>
