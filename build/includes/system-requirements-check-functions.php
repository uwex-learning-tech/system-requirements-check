<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

function prep($arg) {

    if (empty($arg)) return '0';
    
    $arg = trim($arg);
    $arg = htmlentities($arg, ENT_QUOTES);
    return $arg;

}

?>