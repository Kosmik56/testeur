<?php
session_start();
header("refresh: 5;");

function id($t) {
    $ID = str_split($t);
    return $ID[0] . $ID[1];
}





?>